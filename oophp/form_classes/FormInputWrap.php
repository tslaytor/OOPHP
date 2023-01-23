<?php  

class FormInputWrap
{
    private string $cssClass;
    private array $content;

    public function __construct(string $cssClass)
    {
        $this->cssClass = $cssClass;
    }
    
    public function InputElements(array $elements): void
    { 
        foreach($elements as $element){
            $this->content[] = $element->generate();
        }
    }

    public function generate(): string
    {
        return sprintf('<div class="%s">%s</div>', $this->cssClass, implode($this->content));
    }
}
