<?php

namespace App\Http\Controllers\Admin;

use App\Events\AddPostEvent;
use App\Http\Controllers\Controller;
use App\Models\PostData;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $data['posts'] = Post::with('data')->paginate(5);
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
        $request->validate($this->rules());

        $post = Post::create([
            'alias' => Str::slug($request->input('title.ua'), '-'),
        ]);
        $post_id = $post->id;

        foreach (['ua', 'ru'] as $key => $lang) {
            $postData = new PostData;
            $postData::create([
                'post_id' => $post_id,
                'lang' => $lang,
                'title' => $request->input('title.' . $lang),
                'short_description' => $request->input('short_description.' . $lang),
                'content' => $request->input('content.' . $lang),
            ]);
        }

        if ($request->hasFile('imageBig')) {
            $file = $request->file('imageBig');
            $fileName = 'post_' . $post_id . '_big_image';
            Storage::disk('public')->putFileAs('image_big', $file, $fileName);
            Post::where('id', $post_id)->update(['image_big' => $fileName]);
        }

        if ($request->hasFile('imageSmall')) {
            $file = $request->file('imageSmall');
            $fileName = 'post_' . $post_id . '_small_image';
            Storage::disk('public')->putFileAs('image_small', $file, $fileName);
            Post::where('id', $post_id)->update(['image_small' => $fileName]);
        }

        //Используем событие. Просто для практики
        AddPostEvent::dispatch($post);

        //Очистка кеша находится в Observer (PostObserver, PostDataObserver)

        return redirect(url('admin/posts'));
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
        $request->validate($this->rules());

        $post = Post::find($id);
        $post->alias = Str::slug($request->input('title.ua'), '-');
        $post->save();

        foreach (['ua', 'ru'] as $key => $lang) {
            $postData = PostData::where('post_id', $id)->where('lang', $lang)->first();
            $postData->content = $request->input('content.' . $lang);
            $postData->short_description = $request->input('short_description.' . $lang);
            $postData->title = $request->input('title.' . $lang);
            $postData->save();
        }

        if ($request->hasFile('imageBig')) {
            $file = $request->file('imageBig');
            $fileName = 'post_' . $id . '_big_image';
            Storage::disk('public')->putFileAs('image_big', $file, $fileName);
            Post::where('id', $id)->update(['image_big' => $fileName]);
        }

        if ($request->hasFile('imageSmall')) {
            $file = $request->file('imageSmall');
            $fileName = 'post_' . $id . '_small_image';
            Storage::disk('public')->putFileAs('image_small', $file, $fileName);
            Post::where('id', $id)->update(['image_small' => $fileName]);
        }

        //Используем событие. Просто для практики
        AddPostEvent::dispatch($post);

        //Очистка кеша находится в Observer (PostObserver, PostDataObserver)

        return redirect(url('admin/posts'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Post::where('id', $id)->delete();
        PostData::where('post_id', $id)->delete();
        Storage::disk('public')->delete('image_big/post_' . $id . '_big_image');
        Storage::disk('public')->delete('image_small/post_' . $id . '_small_image');

        return redirect(url('admin/posts'));
    }

    private function rules()
    {
        return [
            'alias' => 'alpha_dash|max:255',
            'title.*' => ['required', 'regex:/^[0-9A-Za-zА-Яа-яґҐЁёІіЇїЄє\'’ʼ.,:;-_\s\ ]+$/u'],
            'content.*' => ['required', 'regex:/^[0-9A-Za-zА-Яа-яґҐЁёІіЇїЄє\'’ʼ.,:;-_\s\ ]+$/u'],
            'short_description.*' => ['required', 'max:400', 'regex:/^[0-9A-Za-zА-Яа-яґҐЁёІіЇїЄє\'’ʼ.,:;-_\s\ ]+$/u'],
            'imageBig' => 'image|mimes:jpeg,png,jpg,gif,svg',
            'imageSmall' => 'image|mimes:jpeg,png,jpg,gif,svg',
        ];
    }
}
