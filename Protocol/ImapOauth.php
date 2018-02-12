<?php

namespace Ialert\Mail\Protocol;

use Zend\Mail\Protocol\Imap;

class ImapOauth extends Imap implements ImapOauthInterface
{

    /**
     * @inheritdoc
     * @throws \Zend\Mail\Protocol\Exception\RuntimeException
     */
    public function loginOauth($email, $accessToken)
    {
        $authenticateParams = $this->getAuthenticateParams($email, $accessToken);

        $this->sendRequest('AUTHENTICATE', $authenticateParams);

        while (true) {
            $response = '';
            $isPlus = $this->readLine($response, '+', true);
            if ($isPlus) {
                // Send empty client response.
                $this->sendRequest('');
            } else {
                if (preg_match('/^NO /i', $response) ||
                    preg_match('/^BAD /i', $response)) {
                    return false;
                }
                if (preg_match("/^OK /i", $response)) {
                    return true;
                }

            }
        }

        return false;
    }

    /**
     * Get XOAUTH2 authentication params
     * @param string $email
     * @param string $accessToken
     * @return array
     */
    private function getAuthenticateParams($email, $accessToken)
    {
        $authenticateString = base64_encode(sprintf("user=%s\1auth=Bearer %s\1\1", $email, $accessToken));

        return [
            'XOAUTH2',
            $authenticateString,
        ];
    }

}