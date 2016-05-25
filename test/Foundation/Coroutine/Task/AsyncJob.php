<?php
/*
 *    Copyright 2012-2016 Youzan, Inc.
 *
 *    Licensed under the Apache License, Version 2.0 (the "License");
 *    you may not use this file except in compliance with the License.
 *    You may obtain a copy of the License at
 *
 *        http://www.apache.org/licenses/LICENSE-2.0
 *
 *    Unless required by applicable law or agreed to in writing, software
 *    distributed under the License is distributed on an "AS IS" BASIS,
 *    WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 *    See the License for the specific language governing permissions and
 *    limitations under the License.
 */
namespace Zan\Framework\Test\Foundation\Coroutine\Task;


class AsyncJob extends Job {
    private $rpc = null;
    public function run() {
        $response = (yield $this->call());

        $this->context->set('response', $response);

        yield $response;
    }

    public function fakeResponse() {
        return $this->rpc->fakeResponse();
    }

    private function call() {
        $this->context->set('call()','call');
        $this->rpc = new AsyncTest();

        yield $this->rpc;
    }
}