<?php

namespace App\Http\Controllers\Transaksi;

use App\Helpers\ConstantsHelper;
use App\Helpers\ResponseHelpers;
use App\Http\Controllers\Controller;
use App\Models\PeminjamanT;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class PeminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $peminjamans = PeminjamanT::with(
                'book',
                'pegawai',
                'pengunjung'
            )->get();
            return ResponseHelpers::success(
                ConstantsHelper::STATUS_SUCCESS,
                ConstantsHelper::MSG_SUCCESS_GET,
                $peminjamans
            );
        } catch (QueryException $e) {
            return ResponseHelpers::error(
                ConstantsHelper::STATUS_ERR_SERVER,
                ConstantsHelper::MSG_ERR_GET,
                $e->getMessage()
            );
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'no_peminjaman' => 'required',
            'books_id' => 'required',
            'pengunjung_id' => 'required',
            'pegawai_id' => 'required',
        ]);
        if ($validator->fails()) {
            return ResponseHelpers::error(
                ConstantsHelper::STATUS_ERR_VALIDATION,
                ConstantsHelper::MSG_ERR_VALIDATION,
                $validator->errors(),
            );
        }

        try {
            $input_data =
                // status default 0 ketika insert
                $request->all() + ['status' => ConstantsHelper::BLM_APPROVE];

            PeminjamanT::create($input_data);

            return ResponseHelpers::success(
                ConstantsHelper::STATUS_SUCCESS,
                ConstantsHelper::MSG_SUCCESS_SAVE,
                $input_data
            );
        } catch (QueryException $e) {
            return ResponseHelpers::error(
                ConstantsHelper::STATUS_ERR_SERVER,
                ConstantsHelper::MSG_ERR_SAVE,
                $input_data
            );
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $peminjaman = PeminjamanT::with(
                'book',
                'pegawai',
                'pengunjung'
            )->findOrFail($id);

            return ResponseHelpers::success(
                ConstantsHelper::STATUS_SUCCESS,
                ConstantsHelper::MSG_SUCCESS_GET,
                $peminjaman
            );
        } catch (ModelNotFoundException $e) {
            return ResponseHelpers::error(
                ConstantsHelper::STATUS_ERR_UNAUTHORIZED,
                ConstantsHelper::MSG_ERR_GET,
                $e->getMessage()
            );
        } catch (QueryException $e) {
            return ResponseHelpers::error(
                ConstantsHelper::STATUS_ERR_SERVER,
                ConstantsHelper::MSG_ERR_GET,
                $e->getMessage()
            );
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $peminjaman = PeminjamanT::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return ResponseHelpers::error(
                ConstantsHelper::STATUS_ERR_UNAUTHORIZED,
                ConstantsHelper::MSG_ERR_GET,
                $e->getMessage()
            );
        }

        $validator = Validator::make($request->all(), [
            'no_peminjaman' => 'required',
            'books_id' => 'required',
            'pengunjung_id' => 'required',
            'pegawai_id' => 'required',
            // untuk ubah status
            'status' => 'required'
        ]);

        if ($validator->fails()) {
            return ResponseHelpers::error(
                ConstantsHelper::STATUS_ERR_VALIDATION,
                ConstantsHelper::MSG_ERR_VALIDATION,
                $validator->errors(),
            );
        }

        try {
            $peminjaman->update($request->all());
            return ResponseHelpers::success(
                ConstantsHelper::STATUS_SUCCESS,
                ConstantsHelper::MSG_SUCCESS_SAVE,
                $request->all()
            );
        } catch (QueryException $e) {
            return ResponseHelpers::error(
                ConstantsHelper::STATUS_ERR_SERVER,
                ConstantsHelper::MSG_ERR_SAVE,
                $request->all()
            );
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $peminjaman = PeminjamanT::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return ResponseHelpers::error(
                ConstantsHelper::STATUS_ERR_UNAUTHORIZED,
                ConstantsHelper::MSG_ERR_GET,
                $e->getMessage()
            );
        }

        try {
            $peminjaman->delete();
            return ResponseHelpers::success(
                ConstantsHelper::STATUS_SUCCESS,
                ConstantsHelper::MSG_SUCCESS_DELETE,
                true
            );
        } catch (QueryException $e) {
            return ResponseHelpers::error(
                ConstantsHelper::STATUS_ERR_SERVER,
                ConstantsHelper::MSG_ERR_DELETE,
                $e->getMessage()
            );
        }
    }
}
