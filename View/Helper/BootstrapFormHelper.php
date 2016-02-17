<?php
App::uses('AppHelper', 'View/Helper');
class BootstrapFormHelper extends AppHelper {

  public function hidden($modelname,$columnname){
    $tagid = $modelname.str_replace(' ', '', ucwords(str_replace('_', ' ', $columnname)));
    $tagname = sprintf('data[%s][%s]',$modelname,$columnname);
    $tagvalue = @$this->request->data[$modelname][$columnname];
    return sprintf('<input type="hidden" id="%s" name="%s" value="%s">',$tagid, $tagname, $tagvalue);
  }

  public function hidden2($modelname,$columnname,$value){
    $tagid = $modelname.str_replace(' ', '', ucwords(str_replace('_', ' ', $columnname)));
    $tagname = sprintf('data[%s][%s]',$modelname,$columnname);
    return sprintf('<input type="hidden" id="%s" name="%s" value="%s">',$tagid, $tagname, $value);
  }

  public function hidden3($modelname,$columnname,$tagid='',$tagclass="form-control",$multipleid=null){
    if(empty($tagid)){
      $tagid = $modelname.str_replace(' ', '', ucwords(str_replace('_', ' ', $columnname)));
    }
    $tagname = sprintf('data[%s][%s][%s]',$modelname,$multipleid,$columnname);
    $tagvalue = @$this->request->data[$modelname][$multipleid][$columnname];
    return sprintf('<input type="hidden" class="%s" id="%s" name="%s" value="%s">',$tagclass, $tagid, $tagname, $tagvalue);
  }

  public function input($modelname,$columnname,$tagclass="form-control"){
    $tagid = $modelname.str_replace(' ', '', ucwords(str_replace('_', ' ', $columnname)));
    $tagname = sprintf('data[%s][%s]',$modelname,$columnname);
    $tagvalue = @$this->request->data[$modelname][$columnname];
    return sprintf('<input type="text" class="%s" id="%s" name="%s" value="%s">',$tagclass, $tagid, $tagname, $tagvalue);
  }

  public function input2($modelname,$columnname,$tagid='',$tagclass="form-control",$multipleid=null){
    if(empty($tagid)){
      $tagid = $modelname.str_replace(' ', '', ucwords(str_replace('_', ' ', $columnname)));
    }
    $tagname = sprintf('data[%s][%s][%s]',$modelname,$multipleid,$columnname);
    $tagvalue = @$this->request->data[$modelname][$multipleid][$columnname];
    return sprintf('<input type="text" class="%s" id="%s" name="%s" value="%s">',$tagclass, $tagid, $tagname, $tagvalue);
  }

  public function input3($modelname,$columnname,$tagclass="form-control"){
    $tagid = $modelname.str_replace(' ', '', ucwords(str_replace('_', ' ', $columnname)));
    $tagname = sprintf('data[%s][%s]',$modelname,$columnname);
    $tagvalue = @$this->request->data[$modelname][$columnname];
    return sprintf('<input type="text" class="%s" id="%s" name="%s" value="%s" readonly="readonly">',$tagclass, $tagid, $tagname, $tagvalue);
  }

  public function select($modelname,$columnname,$tagid='',$tagfirst=false,$tagclass="form-control",$checkdata=null,$multipleid=null,$multipledata=false){
    if(empty($tagid)){
      $tagid = $modelname.str_replace(' ', '', ucwords(str_replace('_', ' ', $columnname)));
    }
    if(is_null($multipleid)){
      $tagname = sprintf('data[%s][%s]',$modelname,$columnname);
    }else{
      $tagname = sprintf('data[%s][%s][%s]',$modelname,$multipleid,$columnname);
    }
    if(!empty($checkdata)){
      $tagvalue = $checkdata;
    } elseif($multipledata){
      $tagvalue = @$this->request->data[$modelname][$multipleid][$columnname];
    } else {
      $tagvalue = @$this->request->data[$modelname][$columnname];
    }
    $htmltext = sprintf('<select class="%s" id="%s" name="%s">',$tagclass, $tagid, $tagname);
    if($tagfirst){
      $htmltext .= sprintf('<option value="%s">%s</option>',"", "------------");
    }
    if(stristr($columnname, 'account_type') !== false){
      foreach($this->_View->viewVars['account_type'] as $k=>$v){
        if( $k == $tagvalue ){
          $htmltext .= sprintf('<option value="%s" selected >%s</option>',$k, $v);
        }else{
          $htmltext .= sprintf('<option value="%s">%s</option>',$k, $v);
        }
      }
    }else{
      foreach($this->_View->viewVars[$columnname] as $k=>$v){
        if( $k == $tagvalue ){
          $htmltext .= sprintf('<option value="%s" selected >%s</option>',$k, $v);
        }else{
          $htmltext .= sprintf('<option value="%s">%s</option>',$k, $v);
        }
      }
    }
    $htmltext .= '</select>';
    return $htmltext;
  }

  public function select2($modelname,$columnname,$tagid,$tagfirst=false,$tagclass="form-control",$checkdata=null,$multipleid=null,$multipledata=false){
    if(is_null($multipleid)){
      $tagname = sprintf('data[%s][%s]',$modelname,$columnname);
    }else{
      $tagname = sprintf('data[%s][%s][%s]',$modelname,$multipleid,$columnname);
    }
    if(!empty($checkdata)){
      $tagvalue = $checkdata;
    } elseif($multipledata){
      $tagvalue = @$this->request->data[$modelname][$multipleid][$columnname];
    } else {
      $tagvalue = @$this->request->data[$modelname][$columnname];
    }
    if(empty($tagvalue)){
      $disabled = 'disabled="disabled"';
    }else{
      $disabled = '';
    }
    $htmltext = sprintf('<select class="%s" id="%s" name="%s" %s>',$tagclass, $tagid, $tagname, $disabled);
    if($tagfirst){
      $htmltext .= sprintf('<option value="%s">%s</option>',"", "------------");
    }
    foreach($this->_View->viewVars[$columnname] as $k=>$data){
      if($tagfirst){
        $htmltext .= sprintf('<option value="%s" class="p%s" >%s</option>',"", $k, "------------");
      }
      foreach($data as $k2=>$v2)
      if( $k2 == $tagvalue ){
        $htmltext .= sprintf('<option value="%s" class="p%s" selected >%s</option>',$k2, $k ,$v2);
      }else{
        $htmltext .= sprintf('<option value="%s" class="p%s" >%s</option>',$k2, $k ,$v2);
      }
    }
    $htmltext .= '</select>';
    return $htmltext;
  }

  public function radio($modelname,$columnname,$tagclass="radio"){
    $tagid = $modelname.str_replace(' ', '', ucwords(str_replace('_', ' ', $columnname)));
    $tagname = sprintf('data[%s][%s]',$modelname,$columnname);
    $tagvalue = @$this->request->data[$modelname][$columnname];
    $htmltext = '<div class="">';
    foreach($this->_View->viewVars[$columnname] as $k=>$v){
      if( $k == $tagvalue ){
        $htmltext .= sprintf('<div class="%s"><label><input type="radio" name="%s" id="%s" value="%s" checked >&nbsp;%s</label></div>',$tagclass, $tagname, $tagid, $k, $v);
      }else{
        $htmltext .= sprintf('<div class="%s"><label><input type="radio" name="%s" id="%s" value="%s" >&nbsp;%s</label></div>',$tagclass, $tagname, $tagid, $k, $v);
      }
    }
    $htmltext .= '</div>';
    return $htmltext;
  }

  public function checkbox($modelname,$columnname,$tagclass="checkbox"){
    $tagid = $modelname.str_replace(' ', '', ucwords(str_replace('_', ' ', $columnname)));
    $tagname = sprintf('data[%s][%s]',$modelname,$columnname);
    $tagvalue = @$this->request->data[$modelname][$columnname];
    $htmltext = '<div class="">';
    foreach($this->_View->viewVars[$columnname] as $k=>$v){
      if( $k == $tagvalue ){
        $htmltext .= sprintf('<div class="%s"><label><input type="checkbox" name="%s" id="%s" value="%s" checked >&nbsp;%s</label></div>',$tagclass,$tagname, $tagid, $k, $v);
      }else{
        $htmltext .= sprintf('<div class="%s"><label><input type="checkbox" name="%s" id="%s" value="%s" >&nbsp;%s</label></div>',$tagclass, $tagname, $tagid, $k, $v);
      }
    }
    $htmltext .= '</div>';
    return $htmltext;
  }

  public function checkbox2($modelname,$columnname,$tagclass="checkbox",$divclass=""){
    $tagid = $modelname.str_replace(' ', '', ucwords(str_replace('_', ' ', $columnname)));
    $tagname = sprintf('data[%s][%s][]',$modelname,$columnname);
    $tagvalue = @$this->request->data[$modelname][$columnname];
    $htmltext = '<div class="'.$divclass.'"><div class="'.$tagclass.'">';
    foreach($this->_View->viewVars[$columnname] as $k=>$v){
      if( !empty($tagvalue) && in_array($k,$tagvalue) ){
        $htmltext .= sprintf('<label><input type="checkbox" name="%s" id="%s" value="%s" checked >&nbsp;%s</label>',$tagname, $tagid, $k, $v);
      }else{
        $htmltext .= sprintf('<label><input type="checkbox" name="%s" id="%s" value="%s" >&nbsp;%s</label>', $tagname, $tagid, $k, $v);
      }
    }
    $htmltext .= '</div></div>';
    return $htmltext;
  }

  public function checkbox3($modelname,$columnname,$tagclass="checkbox"){
    $tagid = $modelname.str_replace(' ', '', ucwords(str_replace('_', ' ', $columnname)));
    $tagname = sprintf('data[%s][%s][]',$modelname,$columnname);
    $tagvalue = @$this->request->data[$modelname][$columnname];
    $htmltext = '<div class="">';
    foreach($this->_View->viewVars[$columnname] as $k=>$v){
      if( !empty($tagvalue) && in_array($k,$tagvalue) ){
        $htmltext .= sprintf('<div class="%s"><label><input type="checkbox" name="%s" id="%s" value="%s" checked >&nbsp;%s</label></div>',$tagclass,$tagname, $tagid, $k, $v);
      }else{
        $htmltext .= sprintf('<div class="%s"><label><input type="checkbox" name="%s" id="%s" value="%s" >&nbsp;%s</label></div>',$tagclass, $tagname, $tagid, $k, $v);
      }
    }
    $htmltext .= '</div>';
    return $htmltext;
  }

  public function textarea($modelname,$columnname,$tagclass="form-control"){
    $tagid = $modelname.str_replace(' ', '', ucwords(str_replace('_', ' ', $columnname)));
    $tagname = sprintf('data[%s][%s]',$modelname,$columnname);
    $tagvalue = @$this->request->data[$modelname][$columnname];
    $htmltext = '<div class="">';
    $htmltext .= sprintf('<textarea class="%s" name="%s" id="%s" rows="5">%s</textarea>',$tagclass, $tagname, $tagid, $tagvalue);
    $htmltext .= '</div>';
    return $htmltext;
  }

  public function date($modelname,$columnname,$tagclass="form-control",$divclass=""){
    $tagid = $modelname.str_replace(' ', '', ucwords(str_replace('_', ' ', $columnname)));
    $tagname = sprintf('data[%s][%s]',$modelname,$columnname);
    $tagvalue = @$this->request->data[$modelname][$columnname];
    $htmltext = sprintf('<div class="%s"><div class="input-group date datepicker">',$divclass);
    $htmltext .= sprintf('<input type="text" class="%s" id="%s" name="%s" value="%s">',$tagclass, $tagid, $tagname, $tagvalue);
    $htmltext .= '<span class="input-group-addon glyphicon glyphicon-calendar"></span></div></div>';
    return $htmltext;
  }

  public function date2($modelname,$columnname,$tagclass="form-control",$divclass=""){
    $tagid = $modelname.str_replace(' ', '', ucwords(str_replace('_', ' ', $columnname)));
    $tagname = sprintf('data[%s][%s]',$modelname,$columnname);
    $tagvalue = @$this->request->data[$modelname][$columnname];
    $htmltext = '<div class="input-group date datepicker">';
    $htmltext .= sprintf('<input type="text" class="%s" id="%s" name="%s" value="%s">',$tagclass, $tagid, $tagname, $tagvalue);
    $htmltext .= '<span class="input-group-addon glyphicon glyphicon-calendar"></span></div>';
    return $htmltext;
  }

  public function date3($modelname,$columnname,$tagclass="form-control datepicker",$divclass="",$placeholder=""){
    $tagid = $modelname.str_replace(' ', '', ucwords(str_replace('_', ' ', $columnname)));
    $tagname = sprintf('data[%s][%s]',$modelname,$columnname);
    $tagvalue = @$this->request->data[$modelname][$columnname];
    $htmltext = sprintf('<input type="text" class="%s" id="%s" name="%s" value="%s" placeholder="%s">',$tagclass, $tagid, $tagname, $tagvalue, $placeholder);
    return $htmltext;
  }

  public function date4($modelname,$columnname,$tagclass="form-control datepicker",$multipleid=""){
    $tagid = $modelname.str_replace(' ', '', ucwords(str_replace('_', ' ', $columnname)));
    $tagname = sprintf('data[%s][%s][%s]',$modelname,$multipleid,$columnname);
    $tagvalue = @$this->request->data[$modelname][$columnname];
    $htmltext = sprintf('<input type="text" class="%s" id="%s" name="%s" value="%s">',$tagclass, $tagid, $tagname, $tagvalue);
    return $htmltext;
  }
}
