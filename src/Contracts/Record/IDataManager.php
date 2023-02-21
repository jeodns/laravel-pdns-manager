<?php

namespace Jeodns\PDNSManager\Contracts\Record;

use Jeodns\PDNSManager\Contracts\Record\Data\Status;

/**
 * @phpstan-import-type Content from IData
 */
interface IDataManager
{
    public function getByID(int $id): IData;

    /**
     * @param Content $content
     */
    public function add(int $recordID, array $content, Status $status, ?int $weight, ?int $priority, ?int $locationID): IData;

    /**
     * @param array{weight?:int|null,priority?:int|null,location_id?:int|null,content?:Content,status?:Status} $changes
     */
    public function update(int $id, array $changes = []): IData;

    public function delete(int $id): IData;
}
