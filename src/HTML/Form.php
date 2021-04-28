<?php 
namespace App\HTML;




class Form {

  private $data;
  private $errors;
  

  public function __construct($data, array $errors)
  {
    $this->data = $data;
    $this->errors = $errors;
  }

  public function input(string $key, string $label): string
  {
    $value = $this->getValue($key);
    $type = $key === 'password' ? 'password' : 'text';
    
    /* (..., bool $placeholder): string
    $addLabel
    $placeholder === false;
    if($placeholder === true) {}*/

    return <<<HTML
      <div class="form-group w-100">
        <label class="mt-3 mb-1" for="field{$key}">{$label}</label>
        <input type="{$type}" id="field{$key}" placeholder="Your {$label}" name="{$key}" value="{$value}" class="{$this->getInputClass($key)}" required>
        {$this->getErrorFeedback($key)}
      </div>
HTML;
}

public function file(string $key, string $label): string
{
  return <<<HTML
    <div class="form-group w-50">
      <label class="mt-3 mb-1" for="field{$key}">{$label}</label>
      <input type="file" id="field{$key}" placeholder="Your {$label}" name="{$key}" class="{$this->getInputClass($key)}">
      {$this->getErrorFeedback($key)}
    </div>
HTML;
}

public function textarea(string $key, string $label): string
{
  $value = $this->getValue($key);

  return <<<HTML
    <div class="form-group w-100">
      <label class="mt-4 mb-2" for="field{$key}">{$label}</label>
      <textarea type="text" id="field{$key}" name="{$key}" rows="15" class="{$this->getInputClass($key)}" required>
      {$value}
      </textarea>
      {$this->getErrorFeedback($key)}
    </div>
HTML;  
  }

  public function select(string $key, string $label, array $options = []): string
{
  $optionsHTML = [];
  $value = $this->getValue($key);

  foreach($options as $k => $v) {
    $selected = in_array($k, $value) ? " selected" : "";
    $optionsHTML[] = "<option class=\"my-1\" value=\"$k\" $selected>$v</option>";
  }
  $optionsHTML = implode('', $optionsHTML);


  return <<<HTML
    <div class="form-group w-100">
      <label class="mt-3 mb-1" for="field{$key}">{$label}</label>
      <select id="field{$key}" name="{$key}[]" class="{$this->getInputClass($key)}" required multiple>{$optionsHTML}</select>
      {$this->getErrorFeedback($key)}
    </div>
HTML;  
  }

  private function getValue(string $key)
  {
    if(is_array($this->data)) {
      return $this->data[$key] ?? null;
    }

    $method = 'get' . str_replace(' ', '', ucwords(str_replace('_', ' ', $key)));
    $value = $this->data->$method();
    if($value instanceof \DateTimeInterface) {
      return $value->format('Y-m-d H:i:s');
    }
    return $value;
  }

  private function getInputClass(string $key): string 
  {
    $inputClass = 'form-control rounded-0';
    if(isset($this->errors[$key])) {
      $inputClass .= ' is-invalid';
    }

    return $inputClass;
  }

  private function getErrorFeedback(string $key): string 
  {
    if(isset($this->errors[$key])) {
      if (is_array($this->errors[$key])) {
        $error = implode('<br>', $this->errors[$key]);
      } else {
        $error = $this->errors[$key];
      }
      return '  <div class="invalid-feedback">' . $error . ' </div> ';
    }

    return '';
  }

}