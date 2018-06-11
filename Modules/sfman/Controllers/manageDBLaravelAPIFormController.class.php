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
        $UCFormName = ucfirst($FormName);
        $FormNames = $FormName . "s";
        $ModuleNames = $ModuleName . "s";
        $C = "<?php
namespace App;

use Illuminate\\Database\\Eloquent\\Model;

class $ModuleName" . "_" . "$FormName extends Model
{
    protected \$table = \"$ModuleName" . "_" . "$FormName\";
    protected \$fillable = [";
        $fieldSetCode = '';
        for ($i = 0; $i < count($this->getCurrentTableFields()); $i++) {
            if (FieldType::getFieldType($this->getCurrentTableFields()[$i]) != FieldType::$LARAVELMETAINF && FieldType::getFieldType($this->getCurrentTableFields()[$i]) != FieldType::$ID) {
                $UCField = $this->getCurrentTableFields()[$i];
                $Field = trim(strtolower($UCField));
                $UCField = ucfirst($Field);
                if ($Field != "deletetime") {

                    if ($fieldSetCode != "")
                        $fieldSetCode .= ",";
                    $fieldSetCode .= "'$Field'";
                }
            }
        }
        $C .= $fieldSetCode . "];";
        $C .= "\n}";
        $DesignFile = $this->getLaravelCodeModuleDir() . "/" . $ModuleName . "/app/$ModuleName" . "_$FormName" . ".php";
        $this->SaveFile($DesignFile, $C);
    }

    protected function makeLaravelAPIRoutes($formInfo)
    {

        $ModuleName = $formInfo['module']['name'];
        $FormName = $formInfo['form']['name'];
        $FormNames = $FormName . "s";
        $C = "\nRoute::get('$ModuleName/$FormNames', '$ModuleName\\\\API\\\\$FormName" . "Controller@list');";
        $C .= "\nRoute::post('$ModuleName/$FormNames', '$ModuleName\\\\API\\\\$FormName" . "Controller@add');";
        $C .= "\nRoute::get('$ModuleName/$FormNames/{id}', '$ModuleName\\\\API\\\\$FormName" . "Controller@get');";
        $C .= "\nRoute::put('$ModuleName/$FormNames/{id}', '$ModuleName\\\\API\\\\$FormName" . "Controller@update');";
        $C .= "\nRoute::delete('$ModuleName/$FormNames/{id}', '$ModuleName\\\\API\\\\$FormName" . "Controller@delete');";

        $DesignFile = $this->getLaravelCodeModuleDir() . "/" . $ModuleName . "/routes/$FormName" . ".php";
        $this->SaveFile($DesignFile, $C);
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
        $C = "<?php
namespace App\\Http\\Controllers\\API;
use App\\$ModuleName" . "_" . "$FormName;
use App\\Http\\Controllers\\Controller;
use Illuminate\\Http\\Request;

class $UCFormName" . "Controller extends Controller
{
";
        $C .= "\npublic function add(Request \$request)
    {
    ";
        $fieldSetCode = "";
        for ($i = 0; $i < count($this->getCurrentTableFields()); $i++) {
            if (FieldType::getFieldType($this->getCurrentTableFields()[$i]) != FieldType::$LARAVELMETAINF && FieldType::getFieldType($this->getCurrentTableFields()[$i]) != FieldType::$ID) {
                $UCField = $this->getCurrentTableFields()[$i];
                $Field = trim(strtolower($UCField));
                if ($Field != "deletetime") {
                    $UCField = ucfirst($Field);
                    $C .= "\n\$$UCField=\$request->input('$Field');";
                    if ($fieldSetCode != "")
                        $fieldSetCode .= ",";
                    $fieldSetCode .= "'$Field'=>\$$UCField";
                }
            }
        }
        $C .= "\n\$$UCFormName" . " = $ModuleName" . "_" . "$FormName::create([";
        $C .= $fieldSetCode . ",'deletetime'=>-1]);";
        $C .= "\nreturn response()->json(\$$UCFormName, 201);";
        $C .= "\n}";
        $C .= "\npublic function update(\$id,Request \$request)
    {
    ";
        $fieldSetCode = "";
        for ($i = 0; $i < count($this->getCurrentTableFields()); $i++) {
            if (FieldType::getFieldType($this->getCurrentTableFields()[$i]) != FieldType::$LARAVELMETAINF && FieldType::getFieldType($this->getCurrentTableFields()[$i]) != FieldType::$ID) {
                $UCField = $this->getCurrentTableFields()[$i];
                $Field = trim(strtolower($UCField));
                if ($Field != "deletetime") {
                    $UCField = ucfirst($Field);
                    $C .= "\n\$$UCField=\$request->get('$Field');";
                    $fieldSetCode .= "\n\$$UCFormName->$Field=\$$UCField;";
                }
            }
        }
        $C .= "\n\$$UCFormName" . " = new $ModuleName" . "_" . "$FormName();";
        $C .= "\n\$$UCFormName" . " = \$$UCFormName" . "->find(\$id);";
        $C .= $fieldSetCode;
        $C .= "\n\$$UCFormName" . "->save();";
        $C .= "\nreturn response()->json(\$$UCFormName, 201);";
        $C .= "\n}";
        $C .= "\npublic function list()";
        $C .= "\n{";
        $C .= "\n\$$UCFormName = $ModuleName" . "_" . "$FormName::all();";
        $C .= "\nreturn response()->json(\$$UCFormName, 201);";
        $C .= "\n}";
        $C .= "\npublic function get(\$id,Request \$request)";
        $C .= "\n{";
        $C .= "\n\$$UCFormName = $ModuleName" . "_" . "$FormName::find(\$id);";
        $C .= "\nreturn response()->json(\$$UCFormName, 201);";
        $C .= "\n}";
        $C .= "\npublic function delete(\$id,Request \$request)";
        $C .= "\n{";
        $C .= "\n\$$UCFormName = $ModuleName" . "_" . "$FormName::find(\$id);";
        $C .= "\n\$$UCFormName" . "->delete();";
        $C .= "\nreturn response()->json(['message'=>'deleted'], 201);";
        $C .= "\n}";
        $C .= "\n}";
        $DesignFile = $this->getLaravelCodeModuleDir() . "/" . $ModuleName . "/app/Http/Controllers/API/$FormName" . "Controller.php";
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
        for ($i = 0; $i < count($this->getCurrentTableFields()); $i++) {
            if (FieldType::getFieldType($this->getCurrentTableFields()[$i]) != FieldType::$LARAVELMETAINF && FieldType::getFieldType($this->getCurrentTableFields()[$i]) != FieldType::$ID) {
                $UCField = $this->getCurrentTableFields()[$i];
                $Field = trim(strtolower($UCField));
                if ($Field != "deletetime") {
                    if (FieldType::getFieldType($this->getCurrentTableFields()[$i]) == FieldType::$FID)
                        $C .= "\n\$table->integer('$Field');";
                    elseif (FieldType::getFieldType($this->getCurrentTableFields()[$i]) == FieldType::$BOOLEAN)
                        $C .= "\n\$table->boolean('$Field');";
                    elseif (FieldType::getFieldType($this->getCurrentTableFields()[$i]) == FieldType::$FILE)
                        $C .= "\n\$table->string('$Field',250);";
                    else
                        $C .= "\n\$table->string('$Field',250);";
                }
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