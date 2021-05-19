<?php

namespace OUTRAGEdns\PdnsProxy\Api;

use League\Pipeline\Pipeline;
use League\Pipeline\PipelineBuilder;
use OUTRAGEdns\PdnsProxy\Pipes;

class PipelineProvider
{
    protected $pipes = [];

    /**
     *  Get the pipeline for a particular action
     */
    public function add($operationId, $action): void
    {
        if (is_string($operationId)) {
            if (empty($this->pipes[$operationId])) {
                $this->pipes[$operationId] = [];
            }

            $this->pipes[$operationId][] = $action;
        } elseif (is_array($operationId)) {
            foreach ($operationId as $value) {
                $this->add($value, $action);
            }
        }
    }

    /**
     *  Get the pipeline for a particular action (or null if pipelines are not needed)
     */
    public function build(string $operationId): ?Pipeline
    {
        if (empty($this->pipes[$operationId])) {
            return null;
        }

        $pipelineBuilder = new PipelineBuilder();
        $pipelineBuilder->add(new Pipes\Decode());

        foreach ($this->pipes[$operationId] as $pipe) {
            if (is_string($pipe) && class_exists($pipe)) {
                $pipelineBuilder->add(new $pipe());
            } elseif (is_callable($pipe)) {
                $pipelineBuilder->add($pipe);
            }
        }

        $pipelineBuilder->add(new Pipes\Encode());

        return $pipelineBuilder->build();
    }
}
