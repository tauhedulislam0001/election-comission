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

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if (session()->has('success')) {
            toast(Session('success'), 'success');
        }

        if (session()->has('error')) {
            toast(Session('error'), 'error');
        }

        $user = Auth::guard('admin')->user();

        if($user->user_type == 1 or $user->user_type == 2) {
            $message = Message::latest()->get();
        } elseif($user->user_type == 3) {
            $message = Message::where('sender', $user->id)->latest()->get();
        }

        return view('admin.message.index', compact('message'));
    }

    public function create()
    {
        $users = AdminUser::latest()->get();
        return view('admin.message.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'receiver'    => 'required',
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
        $message->sender     = Auth::guard('admin')->user()->id;
        $message->receiver   = $request->receiver;
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
            return redirect()->back()->with('error', 'Unable to send message!');
        }
    }

    public function view($id)
    {
        $id = Crypt::decryptString($id);
        $item = Message::findOrFail($id);
        $users = AdminUser::latest()->get();

        if($item->flag == 0) {
            $item->flag = 1;
            $item->save();
        }

        return view('admin.message.edit', compact('item', 'users'));
    }

    public function update(Request $request, $id)
    {
        $id                 = Crypt::decryptString($id);
        $message            = Message::findOrFail($id);
        $message->sender    = Auth::guard('admin')->user()->id;
        $message->receiver  = $request->receiver;
        $message->message   = $request->message;
        $message->comments  = $request->comments;
        dd($request->all());
        
    }

    public function postUpdateImage(Request $request)
    {
        $request->validate([
            'image_one'   => "required",
        ]);

        $product_id = $request->id;
        $old_one    = $request->img_one;
        $old_two    = $request->img_two;
        $old_three  = $request->img_three;
        $old_four   = $request->img_four;
        $old_five   = $request->img_five;

        if ($request->has('image_one')) {

            if (file_exists($old_one)) {
                unlink($old_one);
            }

            $image_one  = $request->file('image_one');
            $name_gen   = hexdec(uniqid()) . '.' . $image_one->getClientOriginalExtension();
            Image::make($image_one)->resize(600, 600)->save('dashboard/admin/message' . $name_gen);
            $img_url    = 'dashboard/admin/message' . $name_gen;

            $productImageUpdate             = Message::findOrFail($product_id);
            $productImageUpdate->image_one  = $img_url;
            $productImageUpdate->updated_at = Carbon::now();
            $productImageUpdate->save();
        } else {
            print 'image one nai <br>';
        }

        if ($request->has('image_two')) {
            if (file_exists($old_two)) {
                unlink($old_two);
            }

            $image_two  = $request->file('image_two');
            $name_gen   = hexdec(uniqid()) . '.' . $image_two->getClientOriginalExtension();
            Image::make($image_two)->resize(600, 600)->save('dashboard/admin/message' . $name_gen);
            $img_url2   = 'dashboard/admin/message' . $name_gen;

            $productImageUpdate             = Message::findOrFail($product_id);
            $productImageUpdate->image_two  = $img_url2;
            $productImageUpdate->updated_at = Carbon::now();
            $productImageUpdate->save();
        } else {
            print 'image two nai <br>';
        }

        if ($request->has('image_three')) {
            if (file_exists($old_three)) {
                unlink($old_three);
            }
            $image_three    = $request->file('image_three');
            $name_gen       = hexdec(uniqid()) . '.' . $image_three->getClientOriginalExtension();
            Image::make($image_three)->resize(600, 600)->save('dashboard/admin/message' . $name_gen);
            $img_url3       = 'dashboard/admin/message' . $name_gen;

            $productImageUpdate                 = Message::findOrFail($product_id);
            $productImageUpdate->image_three    = $img_url3;
            $productImageUpdate->updated_at     = Carbon::now();
            $productImageUpdate->save();
        } else {
            print 'image three nai <br>';
        }

        if ($request->has('image_four')) {
            if (file_exists($old_four)) {
                unlink($old_four);
            }
            $image_four    = $request->file('image_four');
            $name_gen      = hexdec(uniqid()) . '.' . $image_four->getClientOriginalExtension();
            Image::make($image_four)->resize(600, 600)->save('dashboard/admin/message' . $name_gen);
            $img_url4      = 'dashboard/admin/message' . $name_gen;

            $productImageUpdate                = Message::findOrFail($product_id);
            $productImageUpdate->image_four    = $img_url4;
            $productImageUpdate->updated_at    = Carbon::now();
            $productImageUpdate->save();
        } else {
            print 'image four nai <br>';
        }

        if ($request->has('image_five')) {
            if (file_exists($old_five)) {
                unlink($old_five);
            }
            $image_five    = $request->file('image_five');
            $name_gen      = hexdec(uniqid()) . '.' . $image_five->getClientOriginalExtension();
            Image::make($image_five)->resize(600, 600)->save('dashboard/admin/message' . $name_gen);
            $img_url5      = 'dashboard/admin/message' . $name_gen;

            $productImageUpdate                = Message::findOrFail($product_id);
            $productImageUpdate->image_five    = $img_url5;
            $productImageUpdate->updated_at    = Carbon::now();
            $productImageUpdate->save();
        } else {
            print 'image five nai <br>';
        }

        return redirect()->route('message.index')->with('success', 'Product image has been updated successfully!');
    }

    public function destroy($id)
    {
        $image      = Message::findOrFail($id);
        $img_one    = $image->image_one;
        $img_two    = $image->image_two;
        $img_three  = $image->image_three;
        $img_four  = $image->image_four;
        $img_five  = $image->image_five;

        if (file_exists($img_one && $img_two && $img_three && $img_four && $img_five)) {
            unlink($img_one);
            unlink($img_two);
            unlink($img_three);
            unlink($img_four);
            unlink($img_five);
        } else {

            $product = Message::findOrFail($id);

            if ($product->delete()) {
                return redirect()->route('message.index')->with('success', 'Product image updated successfully!');
            } else {
                return redirect()->route('message.index')->with('error', 'Failed to update product image!');
            }
        }
    }

    //status inactive

    public function destory($id)
    {
        $id = Crypt::decryptString($id);
        Message::findOrFail($id)->delete();
        return redirect()->route('message.index')->with('success', 'Message has been deleted successfully!!');
    }

    //status inactive

    public function inActive($id)
    {
        Message::find($id)->update(['status' => 0]);
        return redirect()->route('message.index')->with('success', 'Product has been inactivated successfully!');
    }

    //status inactive

    public function active($id)
    {
        Message::find($id)->update(['status' => 1]);
        return redirect()->route('message.index')->with('success', 'Product has been activated successfully!');
    }
}
