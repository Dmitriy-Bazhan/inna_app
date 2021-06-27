<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $data['posts'] = Post::with('data')->get();
        $data['page'] = 'Posts';
        return view('admin.posts.posts', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['page'] = 'Posts';
        return view('admin.posts.posts-create-edit', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validate = $request->validate($this->rules());

        dd($validate);


        dd($request->input('alias'));
        dd('Создать новый');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['page'] = 'Posts';
        $data['post'] = Post::with('data')->find($id);
        return view('admin.posts.posts-create-edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $validate = $request->validate($this->rules());
        dd($validate);

        dd($request->input('alias'));
        dd('Изменить пост ' . $id);

//        if ($request->hasFile('imageBig')) {
//            $file = $request->file('imageBig');
//            $file->move('storage/image_big/', $lesson_id . '_' . $file->getClientOriginalName());
//            Lesson::where('id', $lesson_id)->update(['image_big' => $file->getClientOriginalName()]);
//        }
//
//        if ($request->hasFile('imageSmall')) {
//            $file = $request->file('imageSmall');
//            $file->move('storage/image_small/', $lesson_id . '_' . $file->getClientOriginalName());
//            Lesson::where('id', $lesson_id)->update(['image_small' => $file->getClientOriginalName()]);
//        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    private function rules()
    {
        return [
            'alias' => 'required|alpha_dash|max:255',
            'title.*' => ['required', 'regex:/^[0-9A-Za-zА-Яа-яґҐЁёІіЇїЄє\'’ʼ\ ]+$/u'],
            'content.*' => ['required', 'regex:/^[A-Za-zА-Яа-я0-9\ ]+$/u'],
            'imageBig' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'imageSmall' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ];
    }
}
