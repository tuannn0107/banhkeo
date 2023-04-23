<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cartArray = cartArray();
        return view('home.cart.index', compact('cartArray'));
    }

    public function store(Request $request)
    {
        $post = Post::find($request->item);

        if (!$post) {
            return response()->json([
                'status' => false,
                'message' => trans('message.error')
            ]);
        }

        $cartArray = cartArray();

        if (isset($cartArray[$post->id])) {
            $cartArray[$post->id]['quantity'] += $request->quantity ?? 1;
        } else {
            $cartArray[$post->id] = [
                'id' => $post->id,
                'image' => $post->image,
                'name' => $post->name,
                'href' => $post->href,
                'price' => $post->price_corrected,
                'quantity' => $request->quantity ?? 1
            ];
        }

        session()->put('cartArray', $cartArray);

        return response()->json(array_merge([
            'status' => true,
            'message' => trans('message.added')
        ], $this->view()));
    }

    public function update(Request $request)
    {
        $cartArray = cartArray();
        if (isset($cartArray[$request->item])) {
            if ($request->quantity && $request->quantity > 0) {
                $cartArray[$request->item]['quantity'] = $request->quantity;
            } else {
                unset($cartArray[$request->item]);
            }
            session()->put('cartArray', $cartArray);
        }

        return response()->json(array_merge([
            'status' => true,
            'message' => trans('message.updated')
        ], $this->view()));
    }

    public function destroy(Request $request)
    {
        if (!$request->has('item')) {
            session()->forget('cartArray');
        } else {
            $cartArray = cartArray();
            if (isset($cartArray[$request->item])) {
                unset($cartArray[$request->item]);
                session()->put('cartArray', $cartArray);
            }
        }

        return response()->json(array_merge([
            'status' => true,
            'message' => trans('message.deleted')
        ], $this->view()));
    }

    private function view()
    {
        return [
            'navigation' => view('home.cart.navigation')->render(),
            'mini' => view('home.cart.mini')->render(),
            'large' => view('home.cart.large')->render()
        ];
    }
}
