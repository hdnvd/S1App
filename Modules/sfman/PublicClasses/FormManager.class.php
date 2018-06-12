<?php
namespace Modules\sfman\PublicClasses;

use Modules\sfman\Controllers\pcFormManagerController;
/**
 *
 * @author nahavandi
 *
 */
class FormManager
{
   public function isModuleExists($ModuleName)
   {
       $Cont=new pcFormManagerController("sfman");
       $result=$Cont->FindModule($ModuleName);
       return $result['isfound'];
   }
   public function isModuleEnabled($ModuleName)
   {
       $Cont=new pcFormManagerController("sfman");
       $result=$Cont->FindModule($ModuleName);
       if($result['isfound'])
           return $result['isenabled'];
       return false;
   }
   public function isFormExists($ModuleName,$FormName)
   {
       $Cont=new pcFormManagerController("sfman");
       $result=$Cont->FindForm($ModuleName,$FormName);
       return $result['isfound'];
   }
   public function isFormEnabled($ModuleName,$FormName)
   {
       $Cont=new pcFormManagerController("sfman");
       $result=$Cont->FindForm($ModuleName,$FormName);
       if($result['isfound'])
           return $result['isenabled'];
       return false;
   }     
}

?>