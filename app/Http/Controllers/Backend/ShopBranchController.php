<?php

namespace App\Http\Controllers\Backend;


use App\Http\Requests\Backend\ShopBranch\UpdateShopBranchRequest;
use App\Http\Requests\Backend\ShopBranch\StoreShopBranchRequest;
use App\Http\Requests\Request;
use App\Repositories\Shop\ShopRepository;
use App\Repositories\ShopBranch\ShopBranchRepository;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ShopBranchController extends Controller
{

    protected $repository;
    protected $shopRepository;

    public function __construct(ShopBranchRepository $repository, ShopRepository $shopRepository)
    {
        $this->repository = $repository;
        $this->shopRepository = $shopRepository;
    }

    public function index()
    {
        if(Auth::user()->hasRole('Super Admin')){
            $shopBranches = $this->repository->getAll();
        }elseif(Auth()->user()->hasRole('Store Admin')){
            $shopBranches = $this->repository->getShopBranchesAll();
        }
        return view('backend.pages.shop_branch.index', compact('shopBranches'));
    }

    public function create()
    {
        $shops = $this->shopRepository->getAll();
        return view('backend.pages.shop_branch.create', compact('shops'));
    }

    public function store(StoreShopBranchRequest $request)
    {
        $this->repository->create($request->all());
        return redirect('admin/shop_branch');
    }


    public function show($branch_id)
    {
        $shop_branch = $this->repository->getBranchById($branch_id);
        return view('backend.pages.shop_branch.show', compact('shop_branch'));
    }

    public function edit($branch_id)
    {
        $shop_branch = $this->repository->getBranchById($branch_id);
        $shops = $this->shopRepository->getAll();
        return view('backend.pages.shop_branch.edit', compact('shops', 'shop_branch'));
    }

    public function update($branch_id, UpdateShopBranchRequest $request)
    {
        $this->repository->update($branch_id, $request->except('_method','_token'));
        return redirect('admin/shop_branch');
    }

    public function destroy($branch_id)
    {
        $this->repository->delete($branch_id);
        return redirect('admin/shop_branch');
    }

}
