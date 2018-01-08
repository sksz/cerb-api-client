<?php
namespace Cerb\Model;

class AttachementModel extends BaseModel
{
	/**
     * @param stdClass $result
     * @return Result
     */
    public function processResult($result)
    {
        if ($result->output) {
            throw new \RuntimeException('No result found');
        }

        return new Result($result->output);
    }

    /**
     * @param stdClass $result
     * @return array
     */
    private function convertToModel($result)
    {
        return (array) $result;
    }
}
