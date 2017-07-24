<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\CreateImagesRequest;
use App\Http\Requests\UpdateImagesRequest;
use App\Repositories\ImagesRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class ImagesController extends AppBaseController
{
    /** @var  ImagesRepository */
    private $imagesRepository;

    public function __construct(ImagesRepository $imagesRepo)
    {
        $this->imagesRepository = $imagesRepo;
    }

    /**
     * Display a listing of the Images.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->imagesRepository->pushCriteria(new RequestCriteria($request));
        $images = $this->imagesRepository->all();

        return view('backend.images.index')
            ->with('images', $images);
    }

    /**
     * Show the form for creating a new Images.
     *
     * @return Response
     */
    public function create()
    {
        return view('backend.images.create');
    }

    /**
     * Store a newly created Images in storage.
     *
     * @param CreateImagesRequest $request
     *
     * @return Response
     */
    public function store(CreateImagesRequest $request)
    {
        $input = $request->all();
        // dd($input);
        if ($request->hasFile('image')) {
            
            $images = $request->file('image');
            dd($images);
            $number = 0;
            foreach($images as $image){
                $imagename=time() .'_'.$number. '.'. $image->getClientOriginalExtension();
                $urlStorage = "/var/www/html/chatdemo/public/backend/images/upload";
                $image->move($urlStorage, $imagename);
                $url = '<img src="/backend/images/upload/'.$imagename.'">';

                $data = array('key' => $request->key ,'name' => $imagename, 'url' => $url);

                $image = $this->imagesRepository->create($data);
                $number++;
            }
        }
        // $images = $this->imagesRepository->create($input);

        Flash::success('Images saved successfully.');

        return redirect(route('images.index'));
    }

    /**
     * Display the specified Images.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $images = $this->imagesRepository->findWithoutFail($id);

        if (empty($images)) {
            Flash::error('Images not found');

            return redirect(route('images.index'));
        }

        return view('backend.images.show')->with('images', $images);
    }

    /**
     * Show the form for editing the specified Images.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $images = $this->imagesRepository->findWithoutFail($id);

        if (empty($images)) {
            Flash::error('Images not found');

            return redirect(route('images.index'));
        }

        return view('backend.images.edit')->with('images', $images);
    }

    /**
     * Update the specified Images in storage.
     *
     * @param  int              $id
     * @param UpdateImagesRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateImagesRequest $request)
    {
        $images = $this->imagesRepository->findWithoutFail($id);

        if (empty($images)) {
            Flash::error('Images not found');

            return redirect(route('images.index'));
        }

        $images = $this->imagesRepository->update($request->all(), $id);

        Flash::success('Images updated successfully.');

        return redirect(route('images.index'));
    }

    /**
     * Remove the specified Images from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $images = $this->imagesRepository->findWithoutFail($id);

        if (empty($images)) {
            Flash::error('Images not found');

            return redirect(route('images.index'));
        }

        $this->imagesRepository->delete($id);

        Flash::success('Images deleted successfully.');

        return redirect(route('images.index'));
    }
}
