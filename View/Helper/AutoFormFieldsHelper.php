<?php
App::uses('AppHelper', 'View/Helper');
class AutoFormFieldsHelper extends AppHelper {

  var $helpers = array('BootstrapForm');

  public function table($modelname,$fields){
    $htmltext = '';
    foreach( $fields as $columnname => $column ){
      $fromtag = '';
      if($columnname == 'id' || $columnname == 'sites_id' || $columnname == 'sort'){
        $htmltext .= $this->BootstrapForm->hidden($modelname,$columnname);
      } else {
        $fromtag = $this->fromtag($column,$modelname,$columnname);
      }
      if(!empty($fromtag)){
        $htmltext .= '<tr><th class="active" style="vertical-align:middle;" width="20%">'.$column['Comment'].'</th><td>'.$fromtag.'</td></tr>';
      }
    }
    return $htmltext;
  }

  public function table_reserves($modelname,$fields){
    $htmltext = '';
    $count = 0;
    $unset_fields=array('offices_id','sites_admins_id','cruisers_id','sales','no','payoff','services_id','plans_name','adult','child','infant','coupon','free_price','sort','discount_adult_price','discount_child_price','discount_infant_price','adult_price','child_price','infant_price');
    foreach($unset_fields as $v){
      unset($fields[$v]);
    }
    foreach( $fields as $columnname => $column ){
      $fromtag = '';
      if($columnname == 'adult' || $columnname == 'child' || $columnname == 'infant' || $columnname == 'sort'){
      }elseif($columnname == 'id' || $columnname == 'sites_id' || $columnname == 'no' ){
        $htmltext .= $this->BootstrapForm->hidden($modelname,$columnname);
      } else {
        if($columnname=='places_details_id'){
          $fromtag = '<div class="">'.$this->BootstrapForm->select2($modelname,$columnname,'ReservePlacesIdlv2',true).'</div>';
        }elseif($columnname=='plans_id'){
          $fromtag = '<div class="">'.$this->BootstrapForm->select2($modelname,'partners_plan','ReservePartnersId2',true,'form-control',@$this->request->data[$modelname][$columnname]).'</div>';
        }else{
          $fromtag = $this->fromtag($column,$modelname,$columnname);
        }
      }
      if(!empty($fromtag)){
        $count++;
        if(($count%2)!=0){
          $htmltext .= '<tr>';
        }
        $htmltext .= '<th class="active">'.$column['Comment'].'</th><td class="col-md-5">'.$fromtag.'</td>';
        if(($count%2)==0){
          $htmltext .= '</tr>';
        }
      }
    }
    return $htmltext;
  }

  private function fromtag($column,$modelname,$columnname){
    $invisiblelist = array('created','modified','accessed');
    if(in_array($columnname,$invisiblelist)){
      $fromtag = '';
    }else if($column['Type']=='tinyint(2)'){
      $fromtag = '<div class="">'.$this->BootstrapForm->radio($modelname,$columnname).'</div>';
    }else if($column['Type']=='tinyint(4)'){
      $fromtag = '<div class="">'.$this->BootstrapForm->select($modelname,$columnname,'',false).'</div>';
    }elseif($column['Type']=='date'){
      $fromtag = '<div class="">'.$this->BootstrapForm->date($modelname,$columnname,'form-control','col-md-5').'</div>';
    }elseif($column['Type']=='text'){
      $fromtag = '<div class="">'.$this->BootstrapForm->textarea($modelname,$columnname).'</div>';
    }elseif(isset($this->_View->viewVars[$columnname])) {
      if($column['Null']=='YES'){
        $fromtag = '<div class="">'.$this->BootstrapForm->select($modelname,$columnname,'',true).'</div>';
      }else{
        $fromtag = '<div class="">'.$this->BootstrapForm->select($modelname,$columnname,'',false).'</div>';
      }
    }elseif($columnname=='lat'){
      $fromtag = '<div class="">'.$this->BootstrapForm->input($modelname,$columnname).'</div>';
      $fromtag .= '<div class="">'.$this->BootstrapForm->input($modelname,'lon').'</div>';
    }else{
      $fromtag = '<div class="">'.$this->BootstrapForm->input($modelname,$columnname).'</div>';
    }
    return $fromtag;
  }

}
