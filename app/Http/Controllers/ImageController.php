<?php

namespace App\Http\Controllers;

use App\Image;
use App\Transformer\ImageTransformer;
use Illuminate\Http\Request;

use App\Http\Requests\CreateImageRequest;
use Illuminate\Support\Facades\Input;

class ImageController extends APIController
{
    /**
     * @var ImageTransformer
     */
    private $transformer;


    /**
     * @param ImageTransformer $transformer
     */
    public function __construct(ImageTransformer $transformer)
    {
        $this->transformer = $transformer;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $images = Image::orderBy('created_at')->get();

        $data = $this->transformer->transformCollection($images->toArray());

        return $this->respond($data);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(CreateImageRequest $request)
    {

        $label = $request->get('label');
        $image = Input::file('image');

        $fileName =  time().$image->getClientOriginalName();

        $image->move(public_path().'/images/', $fileName);

        $image = Image::create([
            'label' => $label,
            'image' => '/images/'.$fileName
        ]);

        $data = $this->transformer->transform($image);

        return $this->respond($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $image = Image::find($id);

        if(! $image)
        {
            return $this->respondNotFound('The requested image does\'t exist.');
        }

        $data = $this->transformer->transform($image);

        return $this->respond($data);
    }

        /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $image = Image::find($id);
        $image->delete();
        return true;

    }
}
