<?php  

require_once 'FormInput.php';

class TypedInput extends FormInput
{
    protected string $id;
    protected string $label;
    protected string $type;
    // protected string $name;
    private string $required = '';
    private string $autocomplete = 'off';

    public function __construct(string $id, string $label, string $type, bool $required=false, bool $autocomplete=false)
    {
        parent::__construct($id, $label);
        $this->type = $type;
        if ($required){
            $this->required = 'required';
        }
        if ($autocomplete){
            $this->autocomplete = 'on';
        }
    }
    
    public function generate(): string
    {
        return sprintf('<label for="%s">%s</label>
                        <input type="%s" id="%s" name="%s" %s autocomplete="%s">', 
                        $this->id, $this->label, $this->type, $this->id, $this->id, $this->required, $this->autocomplete);
    }
}
