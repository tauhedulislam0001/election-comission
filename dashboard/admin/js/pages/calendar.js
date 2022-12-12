//[calendar Javascript]

//Project:	Riday - Responsive Admin Template
//Primary use:   Used only for the event calendar


!function($) {
    "use strict";

    var CalendarApp = function() {
        this.$body = $("body")
        this.$calendar = $('#calendar'),
        this.$event = ('#external-events div.external-event'),
        this.$categoryForm = $('#add-new-events form'),
        this.$extEvents = $('#external-events'),
        this.$modal = $('#my-event'),
        this.$saveCategoryBtn = $('.save-category'),
        this.$calendarObj = null
    };


    /* on drop */
    CalendarApp.prototype.onDrop = function (eventObj, date) { 
        var $this = this;
            // retrieve the dropped element's stored Event Object
            var originalEventObject = eventObj.data('eventObject');
            var $categoryClass = eventObj.attr('data-class');
            // we need to copy it, so that multiple events don't have a reference to the same object
            var copiedEventObject = $.extend({}, originalEventObject);
            // assign it the date that was reported
            copiedEventObject.start = date;
            if ($categoryClass)
                copiedEventObject['className'] = [$categoryClass];
            // render the event on the calendar
            $this.$calendar.fullCalendar('renderEvent', copiedEventObject, true);
            // is the "remove after drop" checkbox checked?
            if ($('#drop-remove').is(':checked')) {
                // if so, remove the element from the "Draggable Events" list
                eventObj.remove();
            }
    },
    /* on click on event */
    CalendarApp.prototype.onEventClick =  function (calEvent, jsEvent, view) {
        var $this = this;
            var form = $("<form></form>");
            form.append("<label>Change event name</label>");
            form.append("<div class='input-group'><input class='form-control' type=text value='" + calEvent.title + "' /><span class='input-group-btn'><button type='submit' class='btn btn-success waves-effect waves-light'><i class='fa fa-check'></i> Save</button></span></div>");
            $this.$modal.modal({
                backdrop: 'static'
            });
            $this.$modal.find('.delete-event').show().end().find('.save-event').hide().end().find('.modal-body').empty().prepend(form).end().find('.delete-event').unbind('click').click(function () {
                $this.$calendarObj.fullCalendar('removeEvents', function (ev) {
                    return (ev._id == calEvent._id);
                });
                $this.$modal.modal('hide');
            });
            $this.$modal.find('form').on('submit', function () {
                calEvent.title = form.find("input[type=text]").val();
                $this.$calendarObj.fullCalendar('updateEvent', calEvent);
                $this.$modal.modal('hide');
                return false;
            });
    },
    /* on select */
    CalendarApp.prototype.onSelect = function (start, end, allDay) {
        var $this = this;
            $this.$modal.modal({
                backdrop: 'static'
            });
            var form = $("<form></form>");
            form.append("<div class='row'></div>");
            form.find(".row")
                .append("<div class='col-md-6'><div class='form-group'><label class='control-label'>Event Name</label><input class='form-control' placeholder='Insert Event Name' type='text' name='title'/></div></div>")
                .append("<div class='col-md-6'><div class='form-group'><label class='control-label'>Category</label><select class='form-control' name='category'></select></div></div>")
                .find("select[name='category']")
                .append("<option value='bg-danger'>Danger</option>")
                .append("<option value='bg-success'>Success</option>")
                .append("<option value='bg-purple'>Purple</option>")
                .append("<option value='bg-primary'>Primary</option>")
                .append("<option value='bg-pink'>Pink</option>")
                .append("<option value='bg-info'>Info</option>")
                .append("<option value='bg-warning'>Warning</option></div></div>");
            $this.$modal.find('.delete-event').hide().end().find('.save-event').show().end().find('.modal-body').empty().prepend(form).end().find('.save-event').unbind('click').click(function () {
                form.submit();
            });
            $this.$modal.find('form').on('submit', function () {
                var title = form.find("input[name='title']").val();
                var beginning = form.find("input[name='beginning']").val();
                var ending = form.find("input[name='ending']").val();
                var categoryClass = form.find("select[name='category'] option:checked").val();
                if (title !== null && title.length != 0) {
                    $this.$calendarObj.fullCalendar('renderEvent', {
                        title: title,
                        start:start,
                        end: end,
                        allDay: false,
                        className: categoryClass
                    }, true);  
                    $this.$modal.modal('hide');
                }
                else{
                    alert('You have to give a title to your event');
                }
                return false;
                
            });
            $this.$calendarObj.fullCalendar('unselect');
    },
    CalendarApp.prototype.enableDrag = function() {
        //init events
        $(this.$event).each(function () {
            // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
            // it doesn't need to have a start or end
            var eventObject = {
                title: $.trim($(this).text()) // use the element's text as the event title
            };
            
            // store the Event Object in the DOM element so we can get to it later
            $(this).data('eventObject', eventObject);
            // make the event draggable using jQuery UI
            $(this).draggable({
                zIndex: 999999,
                revert: true,      // will cause the event to go back to its
                revertDuration: 0  //  original position after the drag
            });
        });
    }
  
    /* Initializing */
    CalendarApp.prototype.init = function(alldata) {
        this.enableDrag();
        var data = alldata;
        // var data1 = [{"title":"#GB002937","start":"2021-12-01","className":"bg-info"},{"title":"#GB007334","start":"2021-12-08","className":"bg-info"},{"title":"#GB004944","start":"2021-12-16","className":"bg-info"},{"title":"#GB006586","start":"2021-12-16","className":"bg-info"},{"title":"#GB004560","start":"2021-12-16","className":"bg-info"},{"title":"#GB001499","start":"2021-12-16","className":"bg-info"},{"title":"#GB008703","start":"2021-12-16","className":"bg-info"},{"title":"#GB003945","start":"2021-12-16","className":"bg-info"},{"title":"#GB004771","start":"2021-12-16","className":"bg-info"},{"title":"#GB005189","start":"2021-12-24","className":"bg-info"}];
        
        var defaultEvents =  JSON.parse(data);
        // alert(defaultEvents)
       
        // var defaultEvents =  [{
        //         title: 'Released Ample Admin!',                
        //         start: '2017-08-08',
		// 		end: '2017-08-08',
        //         className: 'bg-info'
        //     }, {
        //         title: 'This is today check date',
        //         start: today,
        //         end: today,
        //         className: 'bg-danger'
        //     }, {
        //         title: 'This is your birthday',                
        //         start: '2017-09-08',
		// 		end: '2017-09-08',
        //         className: 'bg-info'
        //     },
        //       {
        //         title: 'Hanns birthday',                
        //         start: '2017-10-08',
		// 		end: '2017-10-08',
        //         className: 'bg-danger'
        //     },{
        //         title: 'Like it?',
        //         start: new Date($.now() + 784800000),
        //         className: 'bg-success'
        //     }];

        var $this = this;
        var $data = data;
        $this.$calendarObj = $this.$calendar.fullCalendar({
            slotDuration: '00:15:00', /* If we want to split day time each 15minutes */
            minTime: '08:00:00',
            maxTime: '19:00:00',  
            defaultView: 'month',  
            handleWindowResize: true,   
             
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            events: defaultEvents,
            editable: false,
            droppable: false, // this allows things to be dropped onto the calendar !!!
            eventLimit: true, // allow "more" link when too many events
            selectable: true,
            // drop: function(date) { $this.onDrop($(this), date); },
            select: function (start, end, allDay) { $this.onSelect(start, end, allDay); },
            eventClick: function(calEvent, jsEvent, view, resourceObj){
                // window.location.href = "http://localhost/garibook/home";
                $('span').click(function(){
                    var t = $(this).text();
                   
                });

                let booking_id =$(this).text();
            // alert(sd_id);

            //  window.location.href = "http://localhost/garibook/home/booking/id="+url;
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            
            $.ajax({
                    url: "bookingId",
                    type: 'post',
                    data: {booking_id: booking_id},
                    success: function(data) {
                        //alert(data);
                     window.location.href = "http://garibook-vue.xyz/booking/details/"+data;

                    }
                    
                }); 
            }

        });

        //on new event
        this.$saveCategoryBtn.on('click', function(){
            var categoryName = $this.$categoryForm.find("input[name='category-name']").val();
            var categoryColor = $this.$categoryForm.find("select[name='category-color']").val();
            if (categoryName !== null && categoryName.length != 0) {
                $this.$extEvents.append('<div class="m-15 external-event bg-' + categoryColor + '" data-class="bg-' + categoryColor + '" style="position: relative;"><i class="fa fa-hand-o-right"></i>' + categoryName + '</div>')
                $this.enableDrag();
            }

        });
    },

   //init CalendarApp
    $.CalendarApp = new CalendarApp, $.CalendarApp.Constructor = CalendarApp
    
}(window.jQuery),// End of use strict

//initializing CalendarApp
function($) {
    "use strict";
    $.ajax({
            url: "home/bc",
            type: 'get',
        
            success: function(data) {
                //  alert(data);
               var  alldata = data;
                //  alert(alldata);
             $.CalendarApp.init(alldata)

            }
            
        });
   	
}(window.jQuery);// End of use strict
