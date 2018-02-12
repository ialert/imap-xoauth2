<?php

namespace Ialert\Mail\Protocol;

interface ImapOauthInterface
{

    /**
     * @param string $email
     * @param string $accessToken
     * @return boolean
     */
    public function loginOauth($email, $accessToken);

}