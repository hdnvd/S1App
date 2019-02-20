<?php

namespace Modules\sfman\Controllers;

use core\CoreClasses\html\CheckBox;
use core\CoreClasses\services\Controller;
use core\CoreClasses\db\dbaccess;
use core\CoreClasses\SweetDate;
use Modules\common\PublicClasses\AppDate;
use Modules\languages\PublicClasses\CurrentLanguageManager;
use Modules\sfman\Entity\sfman_formelementEntity;
use Modules\sfman\Entity\sfman_formelementtypeEntity;
use Modules\sfman\Entity\sfman_formEntity;
use Modules\sfman\Entity\sfman_moduleEntity;
use Modules\sfman\Entity\sfman_tableEntity;


/**
 * @author Hadi AmirNahavandi
 * @creationDate 1395/10/9 - 2016/12/29 19:36:38
 * @lastUpdate 1395/10/9 - 2016/12/29 19:36:38
 * @SweetFrameworkHelperVersion 1.112
 */
abstract class manageDBLaravelAPIFormController extends manageDBSenchaFormController
{

    protected function makeLaravelAPIModel($formInfo)
    {

        $ModuleName = $formInfo['module']['name'];
        $FormName = $formInfo['form']['name'];

        $AllFields=$this->getAllFormsOfFields();
        $Fields=$AllFields['fields'];
        $PureFields=$AllFields['purefields'];
        $C = "<?php
namespace App\\models\\$ModuleName;

use Illuminate\\Database\\Eloquent\\Model;

class $ModuleName" . "_" . "$FormName extends Model
{
    protected \$table = \"$ModuleName" . "_" . "$FormName\";
    protected \$fillable = [";
        $fieldSetCode = '';
        for ($i = 0; $i < count($Fields); $i++) {
                $UCField = $Fields[$i];
                $Field = trim(strtolower($UCField));
                $UCField = ucfirst($Field);
                if ($Field != "deletetime") {

                    if ($fieldSetCode != "")
                        $fieldSetCode .= ",";
                    $fieldSetCode .= "'$Field'";
                }
        }
        $C .= $fieldSetCode . "];";
        for ($i = 0; $i < count($Fields); $i++) {
            $Field = trim(strtolower($Fields[$i]));

            if (FieldType::getFieldType($Fields[$i]) == FieldType::$FID){
                $C .= "\tpublic function $PureFields[$i]()
    {
        return \$this->belongsTo($ModuleName"."_".$PureFields[$i]."::class,'$Field')->first();
    }";
            }

        }

            $C .= "\n}";
        $DesignFile = $this->getLaravelCodeModuleDir() . "/" . $ModuleName . "/app/models/$ModuleName/$ModuleName" . "_$FormName" . ".php";
        $this->SaveFile($DesignFile, $C);
    }

    protected function makeLaravelAPIRoutes($formInfo)
    {

        $ModuleName = $formInfo['module']['name'];
        $FormName = $formInfo['form']['name'];
        $FormNames = $FormName . "s";
        $C = "\nRoute::get('$ModuleName/$FormName', '$ModuleName\\\\API\\\\$FormName" . "Controller@list');";
        $C .= "\nRoute::post('$ModuleName/$FormName', '$ModuleName\\\\API\\\\$FormName" . "Controller@add');";
        $C .= "\nRoute::get('$ModuleName/$FormName/{id}', '$ModuleName\\\\API\\\\$FormName" . "Controller@get');";
        $C .= "\nRoute::put('$ModuleName/$FormName/{id}', '$ModuleName\\\\API\\\\$FormName" . "Controller@update');";
        $C .= "\nRoute::delete('$ModuleName/$FormName/{id}', '$ModuleName\\\\API\\\\$FormName" . "Controller@delete');";

        $DesignFile = $this->getLaravelCodeModuleDir() . "/" . $ModuleName . "/routes" . ".php";
        $this->SaveFile($DesignFile, $C,true);
    }

    protected function makeLaravelWebRoutes($formInfo)
    {

        $ModuleName = $formInfo['module']['name'];
        $FormName = $formInfo['form']['name'];
        $FormNames = $FormName . "s";
        $C = "\nRoute::get('$ModuleName/management/$FormNames', '$ModuleName\\\\Web\\\\$FormName" . "Controller@managelist')->name('$FormName" . "manlist');";
        $C .= "\nRoute::post('$ModuleName/management/$FormNames/manage', '$ModuleName\\\\Web\\\\$FormName" . "Controller@managesave');";
        $C .= "\nRoute::get('$ModuleName/management/$FormNames/manage', '$ModuleName\\\\Web\\\\$FormName" . "Controller@manageload')->name('$FormName" . "manlist');";
        $C .= "\nRoute::get('$ModuleName/management/$FormNames/delete', '$ModuleName\\\\Web\\\\$FormName" . "Controller@delete');";


        $DesignFile = $this->getLaravelCodeModuleDir() . "/" . $ModuleName . "/routes/$FormName" . "-web.php";
        $this->SaveFile($DesignFile, $C);
    }
    protected function makeLaravelRoutes($formInfo)
    {

        $this->makeLaravelAPIRoutes($formInfo);
        $this->makeLaravelWebRoutes($formInfo);
    }
    protected function makeLaravelAPIController($formInfo)
    {

        $this->makeLaravelAPIModel($formInfo);
        $this->makeLaravelRoutes($formInfo);
        $this->makeLaravelMigrations($formInfo);
        $ModuleName = $formInfo['module']['name'];
        $FormName = $formInfo['form']['name'];
        $UCFormName = ucfirst($FormName);
        $FormNames = $FormName . "s";
        $ModuleNames = $ModuleName . "s";

        $AllFields=$this->getAllFormsOfFields();
        $Fields=$AllFields['fields'];
        $PersianFields=$AllFields['persianfields'];
        $PureFields=$AllFields['purefields'];
        $C = "<?php
namespace App\\Http\\Controllers\\$ModuleName\\API;
use App\\models\\$ModuleName\\$ModuleName" . "_" . "$FormName;
use App\\Http\\Controllers\\Controller;
use App\\Sweet\\SweetQueryBuilder;
use App\\Sweet\\SweetController;
use Illuminate\\Http\\Request;
use Bouncer;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class $UCFormName" . "Controller extends SweetController
{
";
        $C .= "\npublic function add(Request \$request)
    {
        if(!Bouncer::can('$ModuleName" . "." . "$FormName.insert'))
            throw new AccessDeniedHttpException();
    ";
        $fieldSetCode = "";
        for ($i = 0; $i < count($Fields); $i++) {

            $TheFieldType=FieldType::getFieldType($Fields[$i]);
                $UCField = $Fields[$i];
                $Field = trim(strtolower($UCField));
                if ($Field != "deletetime") {
                    $PureField=$PureFields[$i];
                    $UCField = ucfirst($PureField);
                    if($TheFieldType==FieldType::$FILE)
                    {
                        $C .= "\n\$$UCField=\$request->file('$PureField');";
                        $C .= "\nif(\$$UCField!=null){
                                    \$$UCField"."->move('img/',\$$UCField" . "->getClientOriginalName());
                                    \$$UCField='img/'.\$$UCField" . "->getClientOriginalName();
                                    }
                                    else
                                    { 
                                        \$$UCField='';
                                    }";
                    }
                    else
                    {
                        $C .= "\n\$$UCField=\$request->input('$PureField');";
                    }
                    if ($fieldSetCode != "")
                        $fieldSetCode .= ",";
                    $fieldSetCode .= "'$Field'=>\$$UCField";
                }

        }
        $C .= "\n\$$UCFormName" . " = $ModuleName" . "_" . "$FormName::create([";
        $C .= $fieldSetCode . ",'deletetime'=>-1]);";
        $C .= "\nreturn response()->json(['Data'=>\$$UCFormName], 201);";
        $C .= "\n}";
        $C .= "\npublic function update(\$id,Request \$request)
    {
        if(!Bouncer::can('$ModuleName" . "." . "$FormName.edit'))
            throw new AccessDeniedHttpException();
    ";
        $fieldSetCode = "";
        for ($i = 0; $i < count($this->getCurrentTableFields()); $i++) {
            $TheFieldType=FieldType::getFieldType($this->getCurrentTableFields()[$i]);
            if ($TheFieldType != FieldType::$LARAVELMETAINF && $TheFieldType != FieldType::$ID) {
                $UCField = $this->getCurrentTableFields()[$i];
                $Field = trim(strtolower($UCField));
                if ($Field != "deletetime") {
                    $PureField=$this->getPureFieldName($Field);
                    $UCField = ucfirst($PureField);
                    if($TheFieldType==FieldType::$FILE)
                    {
                        $C .= "\n\$$UCField=\$request->file('$PureField');";
                        $C .= "\nif(\$$UCField!=null){
                                    \$$UCField"."->move('img/',\$$UCField" . "->getClientOriginalName());
                                    \$$UCField='img/'.\$$UCField" . "->getClientOriginalName();
                                    }
                                    else
                                    { 
                                        \$$UCField='';
                                    }";
                        $fieldSetCode .= "\nif(\$$UCField!=null)
                            \$$UCFormName->$Field=\$$UCField;";
                    }
                    else
                    {
                        $C .= "\n\$$UCField=\$request->get('$PureField');";
                        $fieldSetCode .= "\n\$$UCFormName->$Field=\$$UCField;";
                    }

                }
            }
        }
        $C .= "\n\$$UCFormName" . " = new $ModuleName" . "_" . "$FormName();";
        $C .= "\n\$$UCFormName" . " = \$$UCFormName" . "->find(\$id);";
        $C .= $fieldSetCode;
        $C .= "\n\$$UCFormName" . "->save();";
        $C .= "\nreturn response()->json(['Data'=>\$$UCFormName], 202);";
        $C .= "\n}";
        $C .= "\n                public function list(Request \$request)";
        $C .= "\n                {
                    Bouncer::allow('admin')->to('$ModuleName" . "." . "$FormName.insert');
                    Bouncer::allow('admin')->to('$ModuleName" . "." . "$FormName.edit');
                    Bouncer::allow('admin')->to('$ModuleName" . "." . "$FormName.list');
                    Bouncer::allow('admin')->to('$ModuleName" . "." . "$FormName.view');
                    Bouncer::allow('admin')->to('$ModuleName" . "." . "$FormName.delete');
                    
                    //if(!Bouncer::can('$ModuleName" . "." . "$FormName.list'))
                        //throw new AccessDeniedHttpException();";

        $C .= "\n                    \$$UCFormName"."Query = $ModuleName" . "_" . "$FormName::where('id','>=','0');";
        for ($i = 0; $i < count($this->getCurrentTableFields()); $i++) {
            $TheFieldType=FieldType::getFieldType($this->getCurrentTableFields()[$i]);
            if ($TheFieldType != FieldType::$LARAVELMETAINF && $TheFieldType != FieldType::$ID && $TheFieldType!=FieldType::$FILE) {
                $UCField = $this->getCurrentTableFields()[$i];
                $Field = trim(strtolower($UCField));
                if ($Field != "deletetime") {
                    $PureField=$this->getPureFieldName($Field);
                    $UCField = ucfirst($PureField);
                    $C .= "\n                    \$$UCFormName"."Query =SweetQueryBuilder::WhereLikeIfNotNull(\$$UCFormName"."Query,'$Field',\$request->get('$PureField'));";


                }
            }
        }
        $C .= "\n                    \$$UCFormName"."s=\$$UCFormName"."Query->get();";
        $C .= "\n                    \$$UCFormName"."sArray=[];";
        $C .= "\n                    for(\$i=0;\$i<count(\$$UCFormName" . "s);\$i++)";
        $C .= "\n                    {";
        $C .= "\n                        \$$UCFormName"."sArray[\$i]=" . "\$$UCFormName" . "s[\$i]->toArray();";
        for ($i = 0; $i < count($Fields); $i++) {
            if(FieldType::getFieldType($Fields[$i])==FieldType::$FID)
            {
                $PureFieldsUC=ucfirst($PureFields[$i]);
                $C .= "\n                        \$$PureFieldsUC=\$$UCFormName" . "s[\$i]->$PureFields[$i]();";
                $C .= "\n                        \$$UCFormName" . "sArray[\$i]['$PureFields[$i]content']=\$$PureFieldsUC==null?'':\$$PureFieldsUC"."->name;";
            }

            }
        $C .= "\n                    }";
        $C .= "\n                    \$$UCFormName = \$this->getNormalizedList(\$$UCFormName" . "sArray);";
        $C .= "\n                    return response()->json(['Data'=>\$$UCFormName,'RecordCount'=>count(\$$UCFormName)], 200);";
        $C .= "\n                }";
        $C .= "\n                public function get(\$id,Request \$request)";
        $C .= "\n                {
                    //if(!Bouncer::can('$ModuleName" . "." . "$FormName.view'))
                        //throw new AccessDeniedHttpException();";
        $C .= "\n\$$UCFormName = \$this->getNormalizedItem($ModuleName" . "_" . "$FormName::find(\$id)->toArray());";
        $C .= "\nreturn response()->json(['Data'=>\$$UCFormName], 200);";
        $C .= "\n}";
        $C .= "\npublic function delete(\$id,Request \$request)";
        $C .= "\n{
                    if(!Bouncer::can('$ModuleName" . "." . "$FormName.delete'))
                        throw new AccessDeniedHttpException();";
        $C .= "\n\$$UCFormName = $ModuleName" . "_" . "$FormName::find(\$id);";
        $C .= "\n\$$UCFormName" . "->delete();";
        $C .= "\nreturn response()->json(['message'=>'deleted','Data'=>[]], 202);";
        $C .= "\n}";
        $C .= "\n}";
        $DesignFile = $this->getLaravelCodeModuleDir() . "/" . $ModuleName . "/app/Http/Controllers/$ModuleName/API/$FormName" . "Controller.php";
        $this->SaveFile($DesignFile, $C);
    }

    protected function makeLaravelMigrations($formInfo)
    {
        $this->makeLaravelAPIModel($formInfo);
        $this->makeLaravelRoutes($formInfo);
        $ModuleName = $formInfo['module']['name'];
        $UModuleName = ucfirst($ModuleName);
        $FormName = $formInfo['form']['name'];
        $UCFormName = ucfirst($FormName);
        $FormNames = $FormName . "s";
        $ModuleNames = $ModuleName . "s";

        $AllFields=$this->getAllFormsOfFields();
        $Fields=$AllFields['fields'];
        $PersianFields=$AllFields['persianfields'];
        $PureFields=$AllFields['purefields'];
        $C = "<?php
use Illuminate\\Support\\Facades\\Schema;
use Illuminate\\Database\Schema\\Blueprint;
use Illuminate\\Database\\Migrations\\Migration;

class Create$UModuleName$UCFormName" . "Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('$ModuleName" . "_$FormName', function (Blueprint \$table) {
            \$table->increments('id');
            ";
        for ($i = 0; $i < count($Fields); $i++) {
                $UCField = $Fields[$i];
                $Field = trim(strtolower($UCField));
                if ($Field != "deletetime") {
                    if (FieldType::getFieldType($Fields[$i]) == FieldType::$FID){

                        $C .= "\n\$table->integer('$Field')->unsigned()->index();";
                        $C .= "\n\$table->foreign('$Field')->references('id')->on('$ModuleName"."_".$PureFields[$i]."');";
                    }
                    elseif (FieldType::getFieldType($Fields[$i]) == FieldType::$BOOLEAN)
                        $C .= "\n\$table->boolean('$Field');";
                    elseif (FieldType::getFieldType($Fields[$i]) == FieldType::$FILE)
                        $C .= "\n\$table->string('$Field',250);";
                    else
                        $C .= "\n\$table->string('$Field',250);";
                }

        }
        $C .= "
            \$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('$FormNames');
    }
}
";
        $DesignFile = $this->getLaravelCodeModuleDir() . "/" . $ModuleName . "/database/migrations/2014_10_12_000000_create_$ModuleName" . "_$FormName" . "_table.php";
        $this->SaveFile($DesignFile, $C);
    }
}

?>