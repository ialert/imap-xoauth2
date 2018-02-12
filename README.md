# Imap XOAuth2 PHP library
## Description
Extends [Zend Mail](https://github.com/zendframework/zend-mail "Zend Mail") component and supports XOAuth2 authentication method.

## Install
Install using composer:

`composer require ialert/imap-xoauth2`

## Usage

Use ImapOauth class instead of Zend\Mail\Protocol\Imap:

     $imapProtocol = new Ialert\Mail\Protocol\ImapOauth('ssl://imap.yandex.ru', 993, true);
     $imapProtocol->loginOauth($email, $accessToken);

