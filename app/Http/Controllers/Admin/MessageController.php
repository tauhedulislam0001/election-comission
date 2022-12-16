<?php

namespace App\Http\Controllers\Admin;

use App\AdminUser;
use App\Http\Controllers\Controller;
use App\Message;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Intervention\Image\Facades\Image;

class MessageController extends Controller
{
    public $user;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('admin')->user();
            return $next($request);
        });
    }

    public function index()
    {
        if (session()->has('success')) {
            toast(Session('success'), 'success');
        }

        if (session()->has('error')) {
            toast(Session('error'), 'error');
        }
        
        if (is_null($this->user) || !$this->user->can('message.view')) {
            abort(403, 'You are Unauthorized to access this page!');
        }

        $user = Auth::guard('admin')->user();

        if($user->user_type == 1 or $user->user_type == 2) {
            $message = Message::latest()->get();
        } elseif($user->user_type == 3) {
            $message = Message::where('status', 1)->latest()->get();
        }

        return view('admin.message.index', compact('message'));
    }

    public function create()
    {
        if (is_null($this->user) || !$this->user->can('message.create')) {
            abort(403, 'You are Unauthorized to access this page!');
        }

        $users = AdminUser::latest()->get();
        return view('admin.message.create', compact('users'));
    }

    public function store(Request $request)
    {
        if (is_null($this->user) || !$this->user->can('message.store')) {
            abort(403, 'You are Unauthorized to access this page!');
        }

        $request->validate([
            'message'     => 'required',
            'image_one'   => 'mimes:jpeg,png,jpg,gif',
            'image_two'   => 'mimes:jpeg,png,jpg,gif',
            'image_three' => 'mimes:jpeg,png,jpg,gif'
        ]);

        if ($request->image_one != null) {
            $image_one  = $request->file('image_one');
            $name_gen   = hexdec(uniqid()) . '.' . $image_one->getClientOriginalExtension();
            Image::make($image_one)->resize(600, 600)->save('dashboard/admin/message/' .Auth::guard('admin')->user()->id.'message'. $name_gen);
            $img_url    = 'dashboard/admin/message/' .Auth::guard('admin')->user()->id.'message'. $name_gen;
        }

        if ($request->image_two != null) {
            $image_two  = $request->file('image_two');
            $name_gen   = hexdec(uniqid()) . '.' . $image_two->getClientOriginalExtension();
            Image::make($image_two)->resize(600, 600)->save('dashboard/admin/message/' .Auth::guard('admin')->user()->id.'message'. $name_gen);
            $img_url2   = 'dashboard/admin/message/' .Auth::guard('admin')->user()->id.'message'. $name_gen;
        }

        if ($request->image_three != null) {
            $image_three    = $request->file('image_three');
            $name_gen       = hexdec(uniqid()) . '.' . $image_three->getClientOriginalExtension();
            Image::make($image_three)->resize(600, 600)->save('dashboard/admin/message/' .Auth::guard('admin')->user()->id.'message'. $name_gen);
            $img_url3       = 'dashboard/admin/message/' .Auth::guard('admin')->user()->id.'message'. $name_gen;
        }

        $message             = new Message();
        $message->sender_id  = Auth::guard('admin')->user()->id;
        $message->message    = $request->message;
        $message->flag       = 0;
        $message->status     = 1;

        if ($request->image_one != null) {
            $message->image_one = $img_url;
        }

        if ($request->image_two != null) {
            $message->image_two = $img_url2;
        }

        if ($request->image_three != null) {
            $message->image_three = $img_url3;
        }

        $message->created_at = Carbon::now();

        if ($message->save()) {
            return redirect()->route('message.index')->with('success', 'Message has been sent successfully!');
        } else {
            return redirect()->back()->with('error', 'Unable to send message! Please contact to your administrator');
        }
    }

    public function view($id)
    {
        if (is_null($this->user) || !$this->user->can('message.edit')) {
            abort(403, 'You are Unauthorized to access this page!');
        }

        if (session()->has('success')) {
            toast(Session('success'), 'success');
        }

        if (session()->has('error')) {
            toast(Session('error'), 'error');
        }

        $id = Crypt::decryptString($id);
        $item = Message::findOrFail($id);
        $users = AdminUser::latest()->get();

        if(Auth::guard('admin')->user()->id != $item->sender_id) {
            if($item->flag == 0) {
                $item->flag = 1;
                $item->save();
            }
        }

        return view('admin.message.edit', compact('item', 'users'));
    }

    public function update(Request $request, $id)
    {
        if (is_null($this->user) || !$this->user->can('message.update')) {
            abort(403, 'You are Unauthorized to access this page!');
        }

        $request->validate([
            'image_one'   => 'mimes:jpeg,png,jpg,gif',
            'image_two'   => 'mimes:jpeg,png,jpg,gif',
            'image_three' => 'mimes:jpeg,png,jpg,gif'
        ]);

        $id      = Crypt::decryptString($id);
        $message = Message::findOrFail($id);

        $oldImageOne    = $message->image_one;
        $oldImageTwo    = $message->image_two;
        $oldImageThree  = $message->image_three;

        if($request->image_one) {
            if (file_exists($oldImageOne)) {
                unlink($oldImageOne);
            }
            $image_one  = $request->file('image_one');
            $name_gen   = hexdec(uniqid()) . '.' . $image_one->getClientOriginalExtension();
            Image::make($image_one)->resize(600, 600)->save('dashboard/admin/message/' .Auth::guard('admin')->user()->id.'message'. $name_gen);
            $img_url    = 'dashboard/admin/message/' .Auth::guard('admin')->user()->id.'message'. $name_gen;

            $message->image_one  = $img_url;
            $message->save();
        }

        if($request->image_two) {
            if (file_exists($oldImageTwo)) {
                unlink($oldImageTwo);
            }
            $image_two  = $request->file('image_two');
            $name_gen   = hexdec(uniqid()) . '.' . $image_two->getClientOriginalExtension();
            Image::make($image_two)->resize(600, 600)->save('dashboard/admin/message/' .Auth::guard('admin')->user()->id.'message'. $name_gen);
            $img_url2   = 'dashboard/admin/message/' .Auth::guard('admin')->user()->id.'message'. $name_gen;

            $message->image_two  = $img_url2;
            $message->save();
        }

        if($request->image_three) {
            if (file_exists($oldImageThree)) {
                unlink($oldImageThree);
            }
            $image_three    = $request->file('image_three');
            $name_gen       = hexdec(uniqid()) . '.' . $image_three->getClientOriginalExtension();
            Image::make($image_three)->resize(600, 600)->save('dashboard/admin/message/' .Auth::guard('admin')->user()->id.'message'. $name_gen);
            $img_url3       = 'dashboard/admin/message/' .Auth::guard('admin')->user()->id.'message'. $name_gen;

            $message->image_three  = $img_url3;
            $message->save();
        }

        $message->sender_id = Auth::guard('admin')->user()->id;
        $message->reply_id  = Auth::guard('admin')->user()->id;
        $message->message   = $request->message;
        $message->reply     = $request->reply;
        
        if($message->save()) {
            return redirect()->route('message.index')->with('success', "Message replied successfully!");
        } else {
            return redirect()->route('message.index')->with('error', "Unable to reply!");
        }
    }

    public function destroy($id)
    {
        if (is_null($this->user) || !$this->user->can('message.delete')) {
            abort(403, 'You are Unauthorized to access this page!');
        }

        $msgID      = Crypt::decryptString($id);
        $image      = Message::findOrFail($msgID);
        $img_one    = $image->image_one;
        $img_two    = $image->image_two;
        $img_three  = $image->image_three;

        if (file_exists($img_one && $img_two && $img_three)) {
            unlink($img_one);
            unlink($img_two);
            unlink($img_three);
        } else {
            $msgID   = Crypt::decryptString($id);
            $message = Message::findOrFail($msgID);

            if ($message->delete()) {
                return redirect()->route('message.index')->with('success', 'Message deleted successfully!');
            } else {
                return redirect()->route('message.index')->with('error', 'Failed to delete message!');
            }
        }
    }

    //status inactive

    public function inActive($id)
    {
        if (is_null($this->user) || !$this->user->can('message.status')) {
            abort(403, 'You are Unauthorized to access this page!');
        }

        $msgID = Crypt::decryptString($id);
        Message::findOrFail($msgID)->update(['status' => 0]);
        return redirect()->route('message.index')->with('success', 'Message has been inactivated successfully!');
    }

    //status inactive

    public function active($id)
    {
        if (is_null($this->user) || !$this->user->can('message.status')) {
            abort(403, 'You are Unauthorized to access this page!');
        }

        $msgID = Crypt::decryptString($id);
        Message::findOrFail($msgID)->update(['status' => 1]);
        return redirect()->route('message.index')->with('success', 'Message has been activated successfully!');
    }
}
