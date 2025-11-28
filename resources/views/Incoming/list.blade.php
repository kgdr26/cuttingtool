@extends('main')
@section('content')

<section>
    <div class="group-flow">
        <div class="flow-identify">
            <div class="flow-header">
                IDENTIFY
            </div>
            <div class="flow-body">

                <a href="{{route('imarkingholder')}}" class="btn card-menu-grup d-flex align-items-center justify-content-end">
                    <div class="flex-shrink-0 me-3">
                        <i class="icon-marking-inc"></i>
                    </div>
                    <div class="flex-grow-1">
                        <div class="d-flex justify-content-start">
                            <span class="text-name-menu d-block">MARKING</span>
                        </div>
                        
                        <div class="d-flex justify-content-start">
                            <small class="text-name-des">Marking Holder & Cutting Tool</small>
                        </div>
                    </div>
                </a>

                <a href="{{route('iinspectionrecord')}}" class="btn card-menu-grup d-flex align-items-center justify-content-end">
                    <div class="flex-shrink-0 me-3">
                        <i class="icon-inspection-inc"></i>
                    </div>
                    <div class="flex-grow-1">
                        <div class="d-flex justify-content-start">
                            <span class="text-name-menu d-block">INSPECTION RECORD</span>
                        </div>
                        
                        <div class="d-flex justify-content-start">
                            <small class="text-name-des">Setting value start inspection record</small>
                        </div>
                    </div>
                    <div class="notif-count">
                        10
                    </div>
                </a>

                <a href="{{route('igoodstockholder')}}" class="btn card-menu-grup d-flex align-items-center justify-content-end">
                    <div class="flex-shrink-0 me-3">
                        <i class="icon-goods-inc"></i>
                    </div>
                    <div class="flex-grow-1">
                        <div class="d-flex justify-content-start">
                            <span class="text-name-menu d-block">GOODS STOCK</span>
                        </div>
                        
                        <div class="d-flex justify-content-start">
                            <small class="text-name-des">Holder, Cutting Tool, Accessories</small>
                        </div>
                    </div>
                </a>

                <a href="{{route('iassy')}}" class="btn card-menu-grup d-flex align-items-center justify-content-end">
                    <div class="flex-shrink-0 me-3">
                        <i class="icon-assy-inc"></i>
                    </div>
                    <div class="flex-grow-1">
                        <div class="d-flex justify-content-start">
                            <span class="text-name-menu d-block">ASSY</span>
                        </div>
                        
                        <div class="d-flex justify-content-start">
                            <small class="text-name-des">Holder + CuttingTool + Accessories</small>
                        </div>
                    </div>
                </a>

                <a href="{{route('imeasure')}}" class="btn card-menu-grup d-flex align-items-center justify-content-end">
                    <div class="flex-shrink-0 me-3">
                        <i class="icon-measure-inc"></i>
                    </div>
                    <div class="flex-grow-1">
                        <div class="d-flex justify-content-start">
                            <span class="text-name-menu d-block">MEASURE</span>
                        </div>
                        
                        <div class="d-flex justify-content-start">
                            <small class="text-name-des">Measure Assy Tool</small>
                        </div>
                    </div>
                    <div class="notif-count">
                        10
                    </div>
                </a>

                <a href="{{route('iassystock')}}" class="btn card-menu-grup d-flex align-items-center justify-content-end">
                    <div class="flex-shrink-0 me-3">
                        <i class="icon-assy-stock-inc"></i>
                    </div>
                    <div class="flex-grow-1">
                        <div class="d-flex justify-content-start">
                            <span class="text-name-menu d-block">ASSY STOCK</span>
                        </div>
                        
                        <div class="d-flex justify-content-start">
                            <small class="text-name-des">Assy Tool Stock</small>
                        </div>
                    </div>
                </a>


            </div>
        </div>

        <div class="flow-transaction">
            <div class="flow-header">
                TRANSACTION
            </div>
            <div class="flow-body">

                <a href="{{route('tgate')}}" class="btn card-menu-grup d-flex align-items-center justify-content-end">
                    <div class="flex-shrink-0 me-3">
                        <i class="icon-gate-inc"></i>
                    </div>
                    <div class="flex-grow-1">
                        <div class="d-flex justify-content-start">
                            <span class="text-name-menu d-block">GATE TRANSACTION</span>
                        </div>
                        
                        <div class="d-flex justify-content-start">
                            <small class="text-name-des">RTU Center & RTU Line</small>
                        </div>
                    </div>
                </a>

                <a href="{{route('tabnormality')}}" class="btn card-menu-grup d-flex align-items-center justify-content-end">
                    <div class="flex-shrink-0 me-3">
                        <i class="icon-abnormality-inc"></i>
                    </div>
                    <div class="flex-grow-1">
                        <div class="d-flex justify-content-start">
                            <span class="text-name-menu d-block">ABNORMALITY</span>
                        </div>
                        
                        <div class="d-flex justify-content-start">
                            <small class="text-name-des">Abnormal Tool Center</small>
                        </div>
                    </div>
                </a>

                <a href="{{route('tassytortuline')}}" class="btn card-menu-grup d-flex align-items-center justify-content-end">
                    <div class="flex-shrink-0 me-3">
                        <i class="icon-gate-inc"></i>
                    </div>
                    <div class="flex-grow-1">
                        <div class="d-flex justify-content-start">
                            <span class="text-name-menu d-block">Send RTU LINE</span>
                        </div>
                        
                        <div class="d-flex justify-content-start">
                            <small class="text-name-des">Send Assy Tool To RTU LINE</small>
                        </div>
                    </div>
                </a>

                <a href="{{route('tfirstpokayokestep1')}}" class="btn card-menu-grup d-flex align-items-center justify-content-end">
                    <div class="flex-shrink-0 me-3">
                        <i class="icon-gate-inc"></i>
                    </div>
                    <div class="flex-grow-1">
                        <div class="d-flex justify-content-start">
                            <span class="text-name-menu d-block">First Time Install Assy</span>
                        </div>
                        
                        <div class="d-flex justify-content-start">
                            <small class="text-name-des">First Time Install To Machine</small>
                        </div>
                    </div>
                </a>

            </div>
        </div>

        <div class="flow-return">
            <div class="flow-header">
                TOOL RETURN
            </div>
            <div class="flow-body">

                <a href="{{route('rtoolanalyze')}}" class="btn card-menu-grup d-flex align-items-center justify-content-end">
                    <div class="flex-shrink-0 me-3">
                        <i class="icon-analyze-inc"></i>
                    </div>
                    <div class="flex-grow-1">
                        <div class="d-flex justify-content-start">
                            <span class="text-name-menu d-block">TOOL ANALYZE</span>
                        </div>
                        
                        <div class="d-flex justify-content-start">
                            <small class="text-name-des">Normal/ Abnormal</small>
                        </div>
                    </div>
                    <div class="notif-count">
                        10
                    </div>
                </a>

                <a href="{{route('rregrind')}}" class="btn card-menu-grup d-flex align-items-center justify-content-end">
                    <div class="flex-shrink-0 me-3">
                        <i class="icon-regrind-inc"></i>
                    </div>
                    <div class="flex-grow-1">
                        <div class="d-flex justify-content-start">
                            <span class="text-name-menu d-block">REGRINDING</span>
                        </div>
                        
                        <div class="d-flex justify-content-start">
                            <small class="text-name-des">Regrind Tool</small>
                        </div>
                    </div>
                    <div class="notif-count">
                        10
                    </div>
                </a>
                
            </div>
        </div>
    </div>

</section>

@stop