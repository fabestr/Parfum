<?php

namespace App\TraitApp;

trait TraitReferer {
    private function getRefererParams() {
        $request = $request->server->get();
        $referer = $request->headers->get('referer');

        var_dump($referer);

        return $referer;
    }
}