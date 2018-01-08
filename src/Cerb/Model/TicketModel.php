<?php
namespace Cerb\Model;

class TicketModel extends BaseModel
{
	/**
     * @param stdClass $result
     * @return Result
     */
    public function processResult($result)
    {
        $models = [];
        $total = 0;
        if ($result->results) {
            $total = $result->total;
            foreach ($result->results as $result) {
                $models[] = $this->convertToModel($result);
            }
        }

        return new Result($models, $total);
    }

    /**
     * @param stdClass $result
     * @return static
     */
    private function convertToModel($result)
    {
        return (array) $result;
    }
}
