<?php

namespace CXEngine\ExpertStats\Requests\ConfigAudit;

use Saloon\Contracts\Body\HasBody;
use Saloon\Data\MultipartValue;
use Saloon\Enums\Method;
use Saloon\Http\PendingRequest;
use Saloon\Traits\Body\HasMultipartBody;

/**
 * Uploads a file for the audit of the host: `files/backup` (backup XML, the
 * audit is re-run on it), `files/call-flows` (Call Flow Designer sources of
 * one Call Flow App, ZIP; fields app and uploaded_by) or `files/prompts`
 * (ZIP of .wav prompts). The server checks the file and answers 422 with
 * an `error` message when it refuses it.
 */
class UploadFileRequest extends ConfigAuditRequest implements HasBody
{
    use HasMultipartBody;

    public const KINDS = ['backup' => 'files/backup', 'call_flow' => 'files/call-flows', 'prompts' => 'files/prompts'];

    protected Method $method = Method::POST;

    /**
     * @param  array<string, string|null>  $fields
     */
    public function __construct(
        string $hostName,
        protected readonly string $kind,
        protected readonly string $filePath,
        protected readonly string $fileName,
        protected readonly array $fields = [],
    ) {
        if (! isset(self::KINDS[$kind])) {
            throw new \InvalidArgumentException("Unknown audit file kind: {$kind}");
        }
        parent::__construct($hostName);
    }

    protected function path(): string
    {
        return self::KINDS[$this->kind];
    }

    /**
     * The connector's default `Content-Type: application/json` is merged
     * after HasMultipartBody sets its header, which would make the server
     * read the body as JSON and miss the file: restore the multipart one.
     */
    public function boot(PendingRequest $pendingRequest): void
    {
        $pendingRequest->headers()->add('Content-Type', 'multipart/form-data; boundary='.$this->body()->getBoundary());
    }

    protected function defaultBody(): array
    {
        $parts = [new MultipartValue(name: 'file', value: fopen($this->filePath, 'r'), filename: $this->fileName)];
        foreach (array_filter($this->fields, fn ($v) => $v !== null && $v !== '') as $name => $value) {
            $parts[] = new MultipartValue(name: $name, value: (string) $value);
        }

        return $parts;
    }
}
