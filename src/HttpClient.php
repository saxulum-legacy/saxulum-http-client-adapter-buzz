<?php

namespace Saxulum\HttpClient\Buzz;

use Buzz\Browser;
use Buzz\Message\Request as BuzzRequest;
use Buzz\Message\Response as BuzzResponse;
use Saxulum\HttpClient\HeaderConverter;
use Saxulum\HttpClient\HttpClientInterface;
use Saxulum\HttpClient\Request;
use Saxulum\HttpClient\Response;

class HttpClient implements HttpClientInterface
{
    /**
     * @var Browser
     */
    protected $browser;

    /**
     * @param Browser $browser
     */
    public function __construct(Browser $browser = null)
    {
        $this->browser = null !== $browser ? $browser : new Browser();
    }

    /**
     * @param  Request  $request
     * @return Response
     */
    public function request(Request $request)
    {
        $buzzRequest = new BuzzRequest(
            $request->getMethod(),
            $request->getUrl()->getResource(),
            $request->getUrl()->getHost()
        );

        $buzzRequest->setProtocolVersion($request->getProtocolVersion());
        $buzzRequest->setHeaders(
            HeaderConverter::convertAssociativeToRaw(
                $this->prepareHeaders($request)
            )
        );
        $buzzRequest->setContent($request->getContent());

        /** @var BuzzResponse $buzzResponse */
        $buzzResponse = $this->browser->send($buzzRequest);

        return new Response(
            (string) $buzzResponse->getProtocolVersion(),
            $buzzResponse->getStatusCode(),
            $buzzResponse->getReasonPhrase(),
            HeaderConverter::convertRawToAssociative($buzzResponse->getHeaders()),
            $buzzResponse->getContent()
        );
    }

    /**
     * @param  Request $request
     * @return array
     */
    protected function prepareHeaders(Request $request)
    {
        $headers = $request->getHeaders();

        if (null !== $request->getContent() && !isset($headers['Content-Type'])) {
            $headers['Content-Type'] = 'application/x-www-form-urlencoded';
        }

        return $headers;
    }
}
