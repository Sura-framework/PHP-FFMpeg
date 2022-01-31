<?php

namespace FFMpeg\Filters;

class FiltersCollection implements \Countable, \IteratorAggregate
{
    private $sorted;
    private $filters = array();

    /**
     * @param FilterInterface $filter
     *
     * @return FiltersCollection
     */
    public function add(FilterInterface $filter)
    {
        $this->filters[$filter->getPriority()][] = $filter;
        $this->sorted = null;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    #[\ReturnTypeWillChange]
    public function count()
    {
        if (0 === count($this->filters)) {
            return 0;
        }

        return count(call_user_func_array('array_merge', array_values($this->filters)));
    }

    /**
     * {@inheritdoc}
     */
    #[\ReturnTypeWillChange]
    public function getIterator()
    {
        if (null === $this->sorted) {
            if (0 === count($this->filters)) {
                $this->sorted = $this->filters;
            } else {
                krsort($this->filters);
                $this->sorted = call_user_func_array('array_merge', array_values($this->filters));
            }
        }

        return new \ArrayIterator($this->sorted);
    }
}