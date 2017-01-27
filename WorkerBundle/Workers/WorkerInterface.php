<?php

namespace WorkerBundle\Workers;

use WorkerBundle\Annotation\Worker;

interface WorkerInterface
{
    /**
     * Does the work
     *
     * @return NULL
     */
    public function work();
}

?>