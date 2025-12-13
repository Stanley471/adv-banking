<div>
    <div class="toolbar" id="kt_toolbar">
        <div class="container-fluid d-flex flex-stack flex-wrap flex-sm-nowrap">
            <div class="d-flex flex-column align-items-start justify-content-center flex-wrap me-2">
                <h1 class="text-dark fw-bolder my-1 fs-2">{{__('Language')}}</h1>
                <ul class="breadcrumb fw-semibold fs-base my-1">
                    <li class="breadcrumb-item text-muted">
                        <a href="{{route('admin.dashboard')}}" class="text-muted text-hover-primary">{{__('Dashboard')}}</a>
                    </li>
                    <li class="breadcrumb-item text-dark">{{__('Language')}}</li>
                </ul>
            </div>
            <div class="d-flex align-items-center flex-nowrap text-nowrap py-1">
                <button id="kt_language_button" class="btn btn-dark me-4"><i class="fal fa-plus"></i> {{__('Add a Translation')}}</button>
            </div>
        </div>
    </div>
    <div wire:ignore.self id="kt_language" class="bg-white" data-kt-drawer="true" data-kt-drawer-activate="true" data-kt-drawer-toggle="#kt_language_button" data-kt-drawer-close="#kt_language_close" data-kt-drawer-width="{'md': '500px'}">
        <div class="card w-100">
            <div class="card-header pe-5 border-0">
                <div class="card-title">
                    <div class="d-flex justify-content-center flex-column me-3">
                        <div class="fs-4 fw-bolder text-gray-900 text-hover-primary me-1 lh-1">{{__('Create a Translation')}}</div>
                    </div>
                </div>
                <div class="card-toolbar">
                    <div class="btn btn-sm btn-icon btn-icon-dark btn-active-light-primary" data-kt-drawer-dismiss="true" id="kt_language_close">
                        <span class="svg-icon svg-icon-2">
                            <i class="fal fa-times"></i>
                        </span>
                    </div>
                </div>
            </div>
            <div class="card-body text-wrap">
                <div class="btn-wrapper text-center mb-3">
                    <div class="symbol symbol-100px symbol-circle me-5 mb-10">
                        <div class="symbol-label fs-1 text-dark">
                            <i class="fal fa-language fa-2x"></i>
                        </div>
                    </div>
                </div>
                <div class="pb-5 mt-10 position-relative zindex-1">
                    <form class="form w-100 mb-10" wire:submit.prevent="addLanguage" method="post">
                        <div class="fv-row mb-6">
                            <select class="form-select form-select-solid" wire:model="name">
                                <option>{{__('Select Country')}}</option>
                                <option value="af*Afrikaans">Afrikaans</option>
                                <option value="al*Albanian">Albanian - shqip</option>
                                <option value="am*Amharic">Amharic - አማርኛ</option>
                                <option value="ar*Arabic">Arabic - العربية</option>
                                <option value="an*Aragonese">Aragonese - aragonés</option>
                                <option value="hy*Armenian">Armenian - հայերեն</option>
                                <option value="az*Azerbaijani">Azerbaijani - azərbaycan dili</option>
                                <option value="eu*Basque">Basque - euskara</option>
                                <option value="be*Belarusian">Belarusian - беларуская</option>
                                <option value="bn*Bengali">Bengali - বাংলা</option>
                                <option value="bs*Bosnian">Bosnian - bosanski</option>
                                <option value="br*Breton">Breton - brezhoneg</option>
                                <option value="bg*Bulgarian">Bulgarian - български</option>
                                <option value="ca*Catalan">Catalan - català</option>
                                <option value="ch*Chinese">Chinese - 中文</option>
                                <option value="co*Corsican">Corsican</option>
                                <option value="hr*Croatian">Croatian - hrvatski</option>
                                <option value="cz*Czech">Czech - čeština</option>
                                <option value="da*Danish">Danish - dansk</option>
                                <option value="nl*Dutch">Dutch - Nederlands</option>
                                <option value="eo*Esperanto">Esperanto - esperanto</option>
                                <option value="et*Estonian">Estonian - eesti</option>
                                <option value="fo*Faroese">Faroese - føroyskt</option>
                                <option value="fi*Finnish">Finnish - suomi</option>
                                <option value="fr*French">French - français</option>
                                <option value="gl*Galician">Galician - galego</option>
                                <option value="ka*Georgian">Georgian - ქართული</option>
                                <option value="de*German">German - Deutsch</option>
                                <option value="gr*Greek">Greek - Ελληνικά</option>
                                <option value="gn*Guarani">Guarani</option>
                                <option value="gu*Gujarati">Gujarati - ગુજરાતી</option>
                                <option value="ha*Hausa">Hausa</option>
                                <option value="he*Hebrew">Hebrew - עברית</option>
                                <option value="ie*Hindi">Hindi - हिन्दी</option>
                                <option value="hu*Hungarian">Hungarian - magyar</option>
                                <option value="is*Icelandic">Icelandic - íslenska</option>
                                <option value="id*Indonesian">Indonesian - Indonesia</option>
                                <option value="ia*Interlingua">Interlingua</option>
                                <option value="ga*Irish">Irish - Gaeilge</option>
                                <option value="it*Italian">Italian - italiano</option>
                                <option value="ja*Japanese">Japanese - 日本語</option>
                                <option value="kn*Kannada">Kannada - ಕನ್ನಡ</option>
                                <option value="kk*Kazakh">Kazakh - қазақ тілі</option>
                                <option value="km*Khmer">Khmer - ខ្មែរ</option>
                                <option value="ko*Korean">Korean - 한국어</option>
                                <option value="ku*Kurdish">Kurdish - Kurdî</option>
                                <option value="ky*Kyrgyz">Kyrgyz - кыргызча</option>
                                <option value="lo*Lao">Lao - ລາວ</option>
                                <option value="la*Latin">Latin</option>
                                <option value="lv*Latvian">Latvian - latviešu</option>
                                <option value="ln*Lingala">Lingala - lingála</option>
                                <option value="lt*Lithuanian">Lithuanian - lietuvių</option>
                                <option value="mk*Macedonian">Macedonian - македонски</option>
                                <option value="ms*Malay">Malay - Bahasa Melayu</option>
                                <option value="ml*Malayalam">Malayalam - മലയാളം</option>
                                <option value="mt*Maltese">Maltese - Malti</option>
                                <option value="mr*Marathi">Marathi - मराठी</option>
                                <option value="mn*Mongolian">Mongolian - монгол</option>
                                <option value="ne*Nepali">Nepali - नेपाली</option>
                                <option value="no*Norwegian">Norwegian - norsk</option>
                                <option value="nb*Norwegian Bokmål">Norwegian Bokmål - norsk bokmål</option>
                                <option value="nn*Norwegian Nynorsk">Norwegian Nynorsk - nynorsk</option>
                                <option value="oc*Occitan">Occitan</option>
                                <option value="or*OriyaOriya">OriyaOriya - ଓଡ଼ିଆ</option>
                                <option value="om*Oromo">Oromo - Oromoo</option>
                                <option value="ps*Pashto">Pashto - پښتو</option>
                                <option value="fa*Persian">Persian - فارسی</option>
                                <option value="pl*Polish">Polish - polski</option>
                                <option value="pt*Portuguese">Portuguese - português</option>
                                <option value="pa*Punjabi">Punjabi - ਪੰਜਾਬੀ</option>
                                <option value="qu*Quechua">Quechua</option>
                                <option value="ro*">RomanianRomanian - română</option>
                                <option value="mo*Romanian">Romanian (Moldova) - română (Moldova)</option>
                                <option value="rm*Romansh">Romansh - rumantsch</option>
                                <option value="ru*Russian">Russian - русский</option>
                                <option value="gd*Scottish">Scottish Gaelic</option>
                                <option value="sr*Serbian">Serbian - српски</option>
                                <option value="sh*Serbo-Croatian">Serbo-Croatian - Srpskohrvatski</option>
                                <option value="sn*Shona">Shona - chiShona</option>
                                <option value="sd*Sindhi">Sindhi</option>
                                <option value="si*Sinhala">Sinhala - සිංහල</option>
                                <option value="sk*Slovak">Slovak - slovenčina</option>
                                <option value="sl*Slovenian">Slovenian - slovenščina</option>
                                <option value="so*Somali">Somali - Soomaali</option>
                                <option value="st*Southern Sotho">Southern Sotho</option>
                                <option value="es*Spanish">Spanish - español</option>
                                <option value="su*Sundanese">Sundanese</option>
                                <option value="sw*Swahili">Swahili - Kiswahili</option>
                                <option value="sv*Swedish">Swedish - svenska</option>
                                <option value="tg*Tajik">Tajik - тоҷикӣ</option>
                                <option value="ta*Tamil">Tamil - தமிழ்</option>
                                <option value="tt*Tatar">Tatar</option>
                                <option value="te*Telugu">Telugu - తెలుగు</option>
                                <option value="th*Thai">Thai - ไทย</option>
                                <option value="ti*Tigrinya">Tigrinya - ትግርኛ</option>
                                <option value="to*Tongan">Tongan - lea fakatonga</option>
                                <option value="tr*Turkish">Turkish - Türkçe</option>
                                <option value="tk*Turkmen">Turkmen</option>
                                <option value="tw*Twi">Twi</option>
                                <option value="uk*Ukrainian">Ukrainian - українська</option>
                                <option value="ur*Urdu">Urdu - اردو</option>
                                <option value="ug*Uyghur">Uyghur</option>
                                <option value="uz*Uzbek">Uzbek - o‘zbek</option>
                                <option value="vi*Vietnamese">Vietnamese - Tiếng Việt</option>
                                <option value="wa*Walloon">Walloon - wa</option>
                                <option value="cy*Welsh">Welsh - Cymraeg</option>
                                <option value="fy*Western Frisian">Western Frisian</option>
                                <option value="xh*Xhosa">Xhosa</option>
                                <option value="yi*">YiddishYiddish</option>
                                <option value="yo*Yoruba">Yoruba - Èdè Yorùbá</option>
                                <option value="zu*Zulu">Zulu - isiZulu</option>
                            </select>
                            @error('name')
                            <span class="form-text">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="text-center mt-10">
                            <button type="submit" class="btn btn-lg btn-info btn-block fw-bolder me-3 my-2">
                                <span wire:loading.remove wire:target="addLanguage">{{__('Submit Request')}}</span>
                                <span wire:loading wire:target="addLanguage">{{__('Processing Request...')}}</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="post fs-6 d-flex flex-column-fluid min-vh-100" id="kt_post">
        <div class="container">
            <div class="row g-xl-8">
                <div class="col-lg-12 col-md-12">
                    @if($language->count() > 0)
                    <div class="table-responsive">
                        <table id="kt_datatable_zero_configuration" class="table table-row-bordered gy-5" wire:loading.class.delay="opacity-50" wire:target="search, status, sortBy, orderBy, perPage, loadMore">
                            <thead>
                                <tr class="fw-semibold fs-6 text-muted">
                                    <th class="min-w-20px">{{__('S/N')}}</th>
                                    <th class="min-w-100px">{{__('Name')}}</th>
                                    <th class="min-w-100px">{{__('Code')}}</th>
                                    <th class="50px">{{__('Status')}}</th>
                                    <th class="min-w-50px">{{__('Created')}}</th>
                                    <th class="scope"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($language as $val)
                                <tr>
                                    <td>{{$loop->iteration}}.</td>
                                    <td><span class="fi fi-{{$val->code}} me-2 fis fs-5 rounded-4 text-dark"></span> {{$val->name}}</td>
                                    <td>{{$val->code}}</td>
                                    <td>
                                        @if($val->status==0)
                                        <span class="badge badge-pill badge-info">{{__('Active')}}</span>
                                        @elseif($val->status==1)
                                        <span class="badge badge-pill badge-danger">{{__('Blocked')}}</span>
                                        @endif
                                    </td>
                                    <td>{{date("Y/m/d h:i:A", strtotime($val->created_at))}}</td>
                                    <td class="text-center">
                                        @if($val->id != 1)
                                        <a href="{{route('admin.edit.language', ['lang' => $val->id])}}" class="btn btn-sm btn-light-info">Edit keywords</a>
                                        @if($val->status==0)
                                        <a wire:click="block('{{$val->id}}')" class="btn btn-sm btn-secondary">Block</a>
                                        @else
                                        <a wire:click="unblock('{{$val->id}}')" class="btn btn-sm btn-secondary">Unblock</a>
                                        @endif
                                        <button data-bs-toggle="modal" data-bs-target="#delete{{$val->id}}" class="btn btn-sm btn-danger">Delete</button>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <div class="text-center mt-20">
                        <img src="{{asset('asset/images/beneficiary.png')}}" style="height:auto; max-width:250px;" class="mb-6">
                        <h3 class="text-dark">{{__('No Translation Found')}}</h3>
                        <p class="text-dark">{{__('We couldn\'t find any staff, create your first translation')}}</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @foreach($language as $val)
    <livewire:admin.language.delete :val=$val :wire:key="'kt_language_'. $val->id">
        @endforeach
</div>
@push('scripts')
<script>
    window.livewire.on('closeDrawer', function() {
        KTDrawer.hideAll();
        KTDrawer.createInstances();
    });
    window.livewire.on('drawer', data => {
        KTDrawer.hideAll();
        KTDrawer.createInstances();
    });
    window.livewire.on('closeModal', function(data) {
        var myModal = $(`#delete${data}`);
        myModal.modal('hide');
    });
</script>
@endpush