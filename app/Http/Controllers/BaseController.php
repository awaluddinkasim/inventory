<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use InvalidArgumentException;

class BaseController extends Controller
{
    protected function redirect(string $redirectTo, array $response): RedirectResponse
    {
        if (!isset($response['status']) || !isset($response['message'])) {
            throw new InvalidArgumentException("Array response harus memiliki key 'status' dan 'message'");
        }

        return redirect($redirectTo)->with($response['status'], $response['message']);
    }

    protected function redirectBack(array $response, bool $withInput = false): RedirectResponse
    {
        if (!isset($response['status']) || !isset($response['message'])) {
            throw new InvalidArgumentException("Array response harus memiliki key 'status' dan 'message'");
        }

        if ($withInput) {
            return redirect()->back()->withInput()->with($response['status'], $response['message']);
        }
        return redirect()->back()->with($response['status'], $response['message']);
    }
}
