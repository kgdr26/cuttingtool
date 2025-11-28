<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\RegisController;
use App\Http\Controllers\CreateMachineController;
use App\Http\Controllers\IncomingController;
use App\Http\Controllers\PokayokeController;

Route::get('/', [AuthController::class, 'ShowFormLogin'])->name('login');
Route::post('login', [AuthController::class, 'login'])->name('login_post');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {

    Route::get('home', [MainController::class, 'index'])->name('home');
    Route::get('tesregis', [RegisController::class, 'tesRegis'])->name('tesregis');
    Route::get('test', [IncomingController::class, 'test'])->name('test');
    Route::get('tespok', [PokayokeController::class, 'tespok'])->name('tespok');
    Route::get('testincoming', [IncomingController::class, 'testincoming'])->name('testincoming');

    // Master Data

    // plant
    Route::middleware(['auth', 'role:admin'])->group(function () {
        Route::get('mplant', [MainController::class, 'mplant'])->name('mplant');
        Route::post('add_plant', [MainController::class, 'addPlant'])->name('add_plant');
        Route::post('get_all_plant', [MainController::class, 'getPlant'])->name('get_all_plant');
        Route::post('edit_plant', [MainController::class, 'editPlant'])->name('edit_plant');
        Route::post('delete_plant', [MainController::class, 'deletePlant'])->name('delete_plant');

        // line
        Route::get('mline', [MainController::class, 'mline'])->name('mline');
        Route::post('get_all_line', [MainController::class, 'getAllLine'])->name('get_all_line');
        Route::post('add_line', [MainController::class, 'addLine'])->name('add_line');
        Route::post('edit_line', [MainController::class, 'editLine'])->name('edit_line');
        Route::post('delete_line', [MainController::class, 'deleteLine'])->name('delete_line');

        // model
        Route::get('mmodel', [MainController::class, 'mmodel'])->name('mmodel');
        Route::post('get_all_model', [MainController::class, 'getAllModel'])->name('get_all_model');
        Route::post('add_model', [MainController::class, 'addModel'])->name('add_model');
        Route::post('edit_model', [MainController::class, 'editModel'])->name('edit_model');
        Route::post('delete_model', [MainController::class, 'deleteModel'])->name('delete_model');

        // part
        Route::get('mpart', [MainController::class, 'mpart'])->name('mpart');
        Route::post('get_all_part', [MainController::class, 'getAllPart'])->name('get_all_part');
        Route::post('add_part', [MainController::class, 'addPart'])->name('add_part');
        Route::post('edit_part', [MainController::class, 'editPart'])->name('edit_part');
        Route::post('delete_part', [MainController::class, 'deletePart'])->name('delete_part');

        // holder
        Route::get('mholder', [MainController::class, 'mholder'])->name('mholder');
        Route::post('get_all_holder', [MainController::class, 'getAllHolder'])->name('get_all_holder');
        Route::post('add_holder', [MainController::class, 'addHolder'])->name('add_holder');
        Route::post('edit_holder', [MainController::class, 'editHolder'])->name('edit_holder');
        Route::post('delete_holder', [MainController::class, 'deleteHolder'])->name('delete_holder');

        // tool
        Route::get('mtool', [MainController::class, 'mtool'])->name('mtool');
        Route::post('get_all_tool', [MainController::class, 'getAllTool'])->name('get_all_tool');
        Route::post('add_tool', [MainController::class, 'addTool'])->name('add_tool');
        Route::post('edit_tool', [MainController::class, 'editTool'])->name('edit_tool');
        Route::post('delete_tool', [MainController::class, 'deleteTool'])->name('delete_tool');

        // material
        Route::get('mmaterial', [MainController::class, 'mmaterial'])->name('mmaterial');
        Route::post('get_all_material', [MainController::class, 'getAllMaterial'])->name('get_all_material');
        Route::post('add_material', [MainController::class, 'addMaterial'])->name('add_material');
        Route::post('edit_material', [MainController::class, 'editMaterial'])->name('edit_material');
        Route::post('delete_material', [MainController::class, 'deleteMaterial'])->name('delete_material');

        // accessories
        Route::get('maccessories', [MainController::class, 'maccessories'])->name('maccessories');
        Route::post('get_all_acc', [MainController::class, 'getAllAcc'])->name('get_all_acc');
        Route::post('add_acc', [MainController::class, 'addAcc'])->name('add_acc');
        Route::post('edit_acc', [MainController::class, 'editAcc'])->name('edit_acc');
        Route::post('delete_acc', [MainController::class, 'deleteAcc'])->name('delete_acc');

        // bat
        Route::get('mbat', [MainController::class, 'mbat'])->name('mbat');
        Route::post('get_all_bat', [MainController::class, 'getAllBat'])->name('get_all_bat');
        Route::post('add_bat', [MainController::class, 'addBat'])->name('add_bat');
        Route::post('edit_bat', [MainController::class, 'editBat'])->name('edit_bat');
        Route::post('delete_bat', [MainController::class, 'deleteBat'])->name('delete_bat');

        // tolerance
        Route::get('mtolerance', [MainController::class, 'mtolerance'])->name('mtolerance');
        Route::post('get_all_tol', [MainController::class, 'getAllTol'])->name('get_all_tol');
        Route::post('add_tol', [MainController::class, 'addTol'])->name('add_tol');
        Route::post('edit_tol', [MainController::class, 'editTol'])->name('edit_tol');
        Route::post('delete_tol', [MainController::class, 'deleteTol'])->name('delete_tol');

        // maker tool
        Route::get('mmakertool', [MainController::class, 'mmakertool'])->name('mmakertool');
        Route::post('get_all_maker', [MainController::class, 'getAllMaker'])->name('get_all_maker');
        Route::post('crud_maker', [MainController::class, 'crudMaker'])->name('crud_maker');

        // maker machine
        Route::get('mmakermachine', [MainController::class, 'mmakermachine'])->name('mmakermachine');
        Route::post('getAllMakerMachine', [MainController::class, 'getAllMakerMachine'])->name('getAllMakerMachine');
        Route::post('crudMakerMachine', [MainController::class, 'crudMakerMachine'])->name('crudMakerMachine');

        // machine regrind
        Route::get('mmachineregrind', [MainController::class, 'mmachineregrind'])->name('mmachineregrind');
        Route::post('getAllMachineRegrind', [MainController::class, 'getAllMachineRegrind'])->name('getAllMachineRegrind');
        Route::post('crudMachineRegrind', [MainController::class, 'crudMachineRegrind'])->name('crudMachineRegrind');

        // machine marking program
        Route::get('mmarkingprogram', [MainController::class, 'mmarkingprogram'])->name('mmarkingprogram');
        Route::post('getallmarkingprogram', [MainController::class, 'getAllMarkingProgram'])->name('getallmarkingprogram');
        Route::post('crudmarkingprogram', [MainController::class, 'crudMarkingProgram'])->name('crudmarkingprogram');

        // unit
        Route::get('munit', [MainController::class, 'munit'])->name('munit');
        Route::post('getallunit', [MainController::class, 'getAllUnit'])->name('getallunit');
        Route::post('crudunit', [MainController::class, 'crudUnit'])->name('crudunit');

        // registrasi holder
        Route::get('rholder', [RegisController::class, 'rholder'])->name('rholder');
        Route::post('getallholderregis', [RegisController::class, 'getAllHolderRegis'])->name('getallholderregis');
        Route::post('crudholderregis', [RegisController::class, 'crudHolderRegis'])->name('crudholderregis');

        // registrasi tool
        Route::get('rtool', [RegisController::class, 'rtool'])->name('rtool');
        Route::post('getalltoolregis', [RegisController::class, 'getAllToolRegis'])->name('getalltoolregis');
        Route::post('crudtoolregis', [RegisController::class, 'crudToolRegis'])->name('crudtoolregis');

        // registrasi accessories
        Route::get('raccessories', [RegisController::class, 'raccessories'])->name('raccessories');
        Route::post('getaccregis', [RegisController::class, 'getAccRegis'])->name('getaccregis');
        Route::post('crudaccregis', [RegisController::class, 'crudAccRegis'])->name('crudaccregis');

        // registrasi machine
        Route::get('rmachine', [RegisController::class, 'rmachine'])->name('rmachine');
        Route::post('crudmachineregis', [RegisController::class, 'crudMachineRegis'])->name('crudmachineregis');
        Route::post('getallmachineregis', [RegisController::class, 'getAllMachineRegis'])->name('getallmachineregis');
        Route::post('getassytoolport', [RegisController::class, 'getAssyToolPort'])->name('getassytoolport');
        Route::post('crudassytoolport', [RegisController::class, 'crudAssyToolPort'])->name('crudassytoolport');
        Route::post('getassytoolportdetail', [RegisController::class, 'getAssyToolPortDetail'])->name('getassytoolportdetail');
        Route::post('uploadImage', [RegisController::class, 'uploadImage'])->name('uploadImage');
        Route::post('getallregrindinspectionrecord', [RegisController::class, 'getAllRegrindInspectionRecord'])->name('getallregrindinspectionrecord');

        // create machine
        Route::get('createmachine', [CreateMachineController::class, 'createMachine'])->name('createmachine');
        Route::post('getwctbyplant', [CreateMachineController::class, 'getWctByPlant'])->name('getwctbyplant');
        Route::post('getopbywct', [CreateMachineController::class, 'getOpByWct'])->name('getopbywct');
        Route::post('crudmachinelist', [CreateMachineController::class, 'crudMachineList'])->name('crudmachinelist');
        Route::post('getmachinelist', [CreateMachineController::class, 'getMachineList'])->name('getmachinelist');


    });

    Route::middleware(['auth'],'role:admin|user')->group(function () {
        // incoming holder
        Route::get('imarkingholder', [IncomingController::class, 'imarkingholder'])->name('imarkingholder');
        Route::post('getallmarkingholder', [IncomingController::class, 'getAllMarkingHolder'])->name('getallmarkingholder');
        Route::post('getholderregisbyid', [IncomingController::class, 'getHolderRegisById'])->name('getholderregisbyid');
        Route::post('getmachineregisterbyidwct', [IncomingController::class, 'getMachineRegisterByIdWct'])->name('getmachineregisterbyidwct');
        Route::post('gettoolportbyidmachineregister', [IncomingController::class, 'getToolPortByIdmachineRegister'])->name('gettoolportbyidmachineregister');
        Route::post('startmarking', [IncomingController::class, 'startMarking'])->name('startmarking');
        Route::post('getqrholder', [IncomingController::class, 'getQrHolder'])->name('getqrholder');
        Route::post('verifyholdermarking', [IncomingController::class, 'verifyHolderMarking'])->name('verifyholdermarking');

        // incoming tool
        Route::get('imarkingtool', [IncomingController::class, 'imarkingtool'])->name('imarkingtool');
        Route::post('getallmarkingtool', [IncomingController::class, 'getAllMarkingTool'])->name('getallmarkingtool');
        Route::post('gettoolregisbyid', [IncomingController::class, 'getToolRegisById'])->name('gettoolregisbyid');
        Route::post('getqrtool', [IncomingController::class, 'getQrTool'])->name('getqrtool');
        Route::post('startmarkingtool', [IncomingController::class, 'startMarkingTool'])->name('startmarkingtool');
        Route::post('verifymarkingtool', [IncomingController::class, 'verifyMarkingTool'])->name('verifymarkingtool');

        // incoming inspection record
        Route::get('iinspectionrecord', [IncomingController::class, 'iinspectionrecord'])->name('iinspectionrecord');
        Route::post('getinspectionrecord', [IncomingController::class, 'getInspectionRecord'])->name('getinspectionrecord');
        Route::post('searchinspectionrecord', [IncomingController::class, 'searchInspectionRecord'])->name('searchinspectionrecord');
        Route::post('updateinspectionrecord', [IncomingController::class, 'updateInspectionRecord'])->name('updateinspectionrecord');

        // good stock holder
        Route::get('igoodstockholder', [IncomingController::class, 'igoodstockholder'])->name('igoodstockholder');
        Route::post('getstokmarkingholder', [IncomingController::class, 'getStokMarkingHolder'])->name('getstokmarkingholder');
        Route::post('getdetailmarkingholder', [IncomingController::class, 'getDetailMarkingHolder'])->name('getdetailmarkingholder');

        // good stock tool
        Route::get('igoodstocktool', [IncomingController::class, 'igoodstocktool'])->name('igoodstocktool');
        Route::post('getmarkingtoolstock', [IncomingController::class, 'getMarkingToolStock'])->name('getmarkingtoolstock');
        Route::post('getdetailgoodstock', [IncomingController::class, 'getDetailGoodStock'])->name('getdetailgoodstock');

        // good stock accessories
        Route::get('igoodstocaccessories', [IncomingController::class, 'igoodstocaccessories'])->name('igoodstocaccessories');
        Route::post('getaccstock', [IncomingController::class, 'getAccStock'])->name('getaccstock');
        Route::post('addaccstock', [IncomingController::class, 'addAccStock'])->name('addaccstock');

        // assy tool
        Route::get('iassy', [IncomingController::class, 'iassy'])->name('iassy');
        Route::post('getopnamebywct', [IncomingController::class, 'getOpNameByWct'])->name('getopnamebywct');
        Route::post('gettoolportbyopname', [IncomingController::class, 'getToolPortByOpname'])->name('gettoolportbyopname');
        Route::post('fetchhtmlassy', [IncomingController::class, 'fetchHtmlAssy'])->name('fetchhtmlassy');
        Route::post('checkqrassy', [IncomingController::class, 'checkQrAssy'])->name('checkqrassy');
        Route::post('createassy', [IncomingController::class, 'createAssy'])->name('createassy');

        // measure
        Route::get('imeasure', [IncomingController::class, 'imeasure'])->name('imeasure');
        Route::post('getassymeasure', [IncomingController::class, 'getAssyMeasure'])->name('getassymeasure');
        Route::post('trxassybyqrholder', [IncomingController::class, 'trxAssyByQrHolder'])->name('trxassybyqrholder');
        Route::post('savezoller', [IncomingController::class, 'saveZoller'])->name('savezoller');

        // tgate
        Route::get('tgate', [IncomingController::class, 'tgate'])->name('tgate');
        Route::post('gettortuline', [IncomingController::class, 'getToRtuLine'])->name('gettortuline');
        Route::post('sendrtuline', [IncomingController::class, 'sendRtuLine'])->name('sendrtuline');
        // Route::post('getassybyqr', [IncomingController::class, 'getAssyByQr'])->name('getassybyqr');

        // assy stock
        Route::get('iassystock', [IncomingController::class, 'iassystock'])->name('iassystock');
        Route::post('getassystock', [IncomingController::class, 'getAssyStock'])->name('getassystock');

        Route::post('machinebyqr', [PokayokeController::class, 'machineByQr'])->name('machinebyqr');
        Route::post('gettrxassybyqr', [PokayokeController::class, 'getTrxAssyByQr'])->name('gettrxassybyqr');
        Route::post('gettrxassytoolbyqr', [PokayokeController::class, 'getTrxAssyToolByQr'])->name('gettrxassytoolbyqr');
        Route::post('machinelistbyid', [PokayokeController::class, 'machineListById'])->name('machinelistbyid');
        Route::post('trxassybyassyid', [PokayokeController::class, 'trxAssyByAssyId'])->name('trxassybyassyid');
        Route::post('pokayokestep5check', [PokayokeController::class, 'pokayokeStep5check'])->name('pokayokestep5check');

        // Pokayoke
        Route::get('pokayokestep1', [PokayokeController::class, 'pokayokestep1'])->name('pokayokestep1');
        Route::get('pokayokestep2', [PokayokeController::class, 'pokayokestep2'])->name('pokayokestep2');
        Route::get('pokayokestep3', [PokayokeController::class, 'pokayokestep3'])->name('pokayokestep3');
        Route::get('pokayokestep4', [PokayokeController::class, 'pokayokestep4'])->name('pokayokestep4');
        Route::get('pokayokestep5', [PokayokeController::class, 'pokayokestep5'])->name('pokayokestep5');

        // Tool Analyze
        Route::get('rtoolanalyze', [IncomingController::class, 'rtoolanalyze'])->name('rtoolanalyze');
        Route::post('gettoolanalyze', [IncomingController::class, 'getToolAnalyze'])->name('gettoolanalyze');
        Route::get('rdetailtoolanalyze', [IncomingController::class, 'rdetailtoolanalyze'])->name('rdetailtoolanalyze');
        Route::post('getassyinformation', [IncomingController::class, 'getAssyInformation'])->name('getassyinformation');
        Route::post('detailtoolanalyze', [IncomingController::class, 'detailToolAnalyze'])->name('detailtoolanalyze');
        Route::post('dismantle', [IncomingController::class, 'dismantle'])->name('dismantle');

        // Regrind
        Route::get('rregrind', [IncomingController::class, 'rregrind'])->name('rregrind');
        Route::post('getregrind', [IncomingController::class, 'getRegrind'])->name('getregrind');
        Route::post('checkregrindstatus', [IncomingController::class, 'checkRegrindStatus'])->name('checkregrindstatus');
        Route::post('toolbyqr', [IncomingController::class, 'toolByQr'])->name('toolbyqr');
        Route::post('startregrind', [IncomingController::class, 'startRegrind'])->name('startregrind');
        Route::post('inspectionrecordbyqr', [IncomingController::class, 'inspectionRecordByQr'])->name('inspectionrecordbyqr');
        Route::post('stopregrind', [IncomingController::class, 'stopRegrind'])->name('stopregrind');
        Route::post('qcregrind', [IncomingController::class, 'qcRegrind'])->name('qcregrind');

        // user
        Route::get('users', [IncomingController::class, 'users'])->name('users');
        Route::post('getuser', [IncomingController::class, 'getUser'])->name('getuser');
        Route::post('cruduser', [IncomingController::class, 'crudUser'])->name('cruduser');


    });

    //Incoming
    Route::get('incoming', [MainController::class, 'incoming'])->name('incoming');
    Route::get('tgate', [MainController::class, 'tgate'])->name('tgate');
    Route::get('tabnormality', [MainController::class, 'tabnormality'])->name('tabnormality');
    Route::get('tassytortuline', [MainController::class, 'tassytortuline'])->name('tassytortuline');

    //End Incoming


    // End Pokayoke

    // Pokayoke First
    Route::get('tfirstpokayokestep1', [MainController::class, 'tfirstpokayokestep1'])->name('tfirstpokayokestep1');
    Route::get('tfirstpokayokestep2', [MainController::class, 'tfirstpokayokestep2'])->name('tfirstpokayokestep2');
    Route::get('tfirstpokayokestep3', [MainController::class, 'tfirstpokayokestep3'])->name('tfirstpokayokestep3');
    Route::get('tfirstpokayokestep4', [MainController::class, 'tfirstpokayokestep4'])->name('tfirstpokayokestep4');
    
    // End Pokayoke First

    //Configuration
    //End Configuration

    //Report
    Route::get('report', [MainController::class, 'report'])->name('report');
    //End Report

    Route::get('admin', [MainController::class, 'admin'])->name('admin');
    Route::get('user', [MainController::class, 'user'])->name('user');

    Route::get('changetool', [MainController::class, 'changetool'])->name('changetool');
    Route::get('sampleqrzoller', [MainController::class, 'sampleqrzoller'])->name('sampleqrzoller');
});


