<?php  

abstract class FormInput
{
    protected string $id;
    protected string $label;
    
    protected function __construct($id, $label)
    {
        $this->id = $id;
        $this->label = $label;
    }
    abstract public function generate(): string;
}
