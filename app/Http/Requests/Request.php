<?php

namespace App\Http\Requests;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;

/**
 * Class Request.
 */
abstract class Request extends FormRequest
{
    /**
     * @var string
     */
    protected $error = '';

    /**
     * @var string
     */

    /**
     * @return $this
     */
    public function forbiddenResponse()
    {
        if (empty($error)) {
            $this->error = trans('auth.general_error');
        }
        return $this->response($this->error);
        //        return redirect()->back()->withErrors($this->error);
    }

    protected function failedAuthorization()
    {

        return $this->response(['This action is unauthorized.']);
    }

    public function response(array $errors)
    {
        // Optionally, send a custom response on authorize failure
        // (default is to just redirect to initial page with errors)
        //
        // Can return a response, a view, a redirect, or whatever else

        return new JsonResponse($errors, 422);
    }
}
