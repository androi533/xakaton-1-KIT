unit main;

interface

uses
  Winapi.Windows, Winapi.Messages, System.SysUtils, System.Variants,
  System.Classes, Vcl.Graphics, System.NetEncoding,
  Vcl.Controls, Vcl.Forms, Vcl.Dialogs, Vcl.StdCtrls, Vcl.ExtCtrls,
  Vcl.Imaging.pngimage, cefvcl, ceflib, ActiveX, ComObj, shellapi,
  System.ImageList, Vcl.ImgList, Vcl.Grids,
  ZAbstractTable, ZDataset, Data.DB, ZAbstractRODataset, ZAbstractDataset,
  ZAbstractConnection, ZConnection, Clipbrd, Vcl.MPlayer, MMsystem,
  Vcl.ComCtrls, VirtualTrees, Math, IdBaseComponent, IdComponent,
  IdTCPConnection, IdTCPClient, IdHTTP, DateUtils, jpeg, EncdDecd, Vcl.Buttons,
  WinInet, JSON, System.Generics.Collections;

type
  TForm1 = class(TForm)
    LoadSheet: TPanel;
    LoginE: TEdit;
    LoginI: TImage;
    PassE: TEdit;
    MinimizeB: TPanel;
    BRReg: TChromium;
    HideInjection: TButton;
    HideMemo: TMemo;
    ErrorL: TLabel;
    HelpB: TPanel;
    HideInjection2: TButton;
    LoggedSheet: TPanel;
    Loading: TTimer;
    ExitB: TPanel;
    ControlPanel: TPanel;
    header: TPanel;
    InfoSheet: TPanel;
    Edit: TEdit;
    InfoL: TLabel;
    InfoI: TImage;
    City: TEdit;
    Input: TPanel;
    Panel2: TPanel;
    Panel3: TPanel;
    imya: TEdit;
    Label1: TLabel;
    familiya: TEdit;
    otchestvo: TEdit;
    Ulica: TEdit;
    dom: TEdit;
    korpus: TEdit;
    ofice: TEdit;
    Phone: TEdit;
    Kompaniya: TEdit;
    KontEmail: TEdit;
    ogrn: TEdit;
    HelpInput: TPanel;
    ZConnection1: TZConnection;
    ZQuery1: TZQuery;
    DataSource1: TDataSource;
    Addi: TMemo;
    ThreeSheet: TPanel;
    CodeName: TComboBox;
    ThreeInput: TPanel;
    SellPhraseMemo: TMemo;
    Panel4: TPanel;
    wordstat: TPanel;
    ThreeHelp: TPanel;
    FindSites: TPanel;
    Panel8: TPanel;
    SiteList: TMemo;
    RekMemo: TMemo;
    ThreeTimer: TTimer;
    KonkurentP: TPanel;
    Panel7: TPanel;
    KonkurentHelp: TPanel;
    HelpZoneP: TPanel;
    HelpZone: TMemo;
    HintP: TPanel;
    HintDblClick: TPanel;
    HintAim: TPanel;
    HintClick: TPanel;
    HintL: TPanel;
    Panel5: TPanel;
    AimPNG: TImage;
    ClickPNG: TImage;
    Panel9: TPanel;
    DblClickPNG: TImage;
    Panel10: TPanel;
    Panel11: TPanel;
    KonkurentL: TPanel;
    ZagMemo: TMemo;
    AdsMemo: TMemo;
    BrowserP: TPanel;
    SeeBrowser: TPanel;
    eyePNG: TImage;
    eye: TPanel;
    keyplanner: TPanel;
    Later: TTimer;
    AdsPreview: TPanel;
    AdsZag: TLabel;
    AdsZag2: TLabel;
    AdsText: TLabel;
    AdsMarket: TLabel;
    AdsFast1: TLabel;
    AdsFast2: TLabel;
    AdsFast3: TLabel;
    AdsFast4: TLabel;
    AdsUrl: TLabel;
    AdsDesc: TLabel;
    AdsUrlDesc: TLabel;
    AdsKontakt: TLabel;
    AdsPhone: TLabel;
    AdsTimeWork: TLabel;
    GoogleHelp: TMemo;
    radarPNG: TImage;
    Panel1: TPanel;
    ThreeHelpInfo: TPanel;
    PreKeySheet: TPanel;
    HidePreKeyP: TPanel;
    PreKey: TMemo;
    HidePreKeyR: TPanel;
    PreKeyHelpP: TPanel;
    PreKeyHelp: TMemo;
    PreKeyLoad: TPanel;
    HideMinusP: TPanel;
    HideMinusR: TPanel;
    HideMinusZ: TPanel;
    ClearingL: TPanel;
    ClearingWord: TPanel;
    Panel19: TPanel;
    ClearingHelp: TPanel;
    ClearinP: TPanel;
    ClearingYesPNG: TImage;
    ClearingFullPNG: TImage;
    ClearingNoPNG: TImage;
    ChoiseP: TPanel;
    GoClear: TPanel;
    GoNext: TPanel;
    PreKeyLoadB: TPanel;
    DokeySheet: TPanel;
    KeysP: TPanel;
    Keys: TMemo;
    Panel16: TPanel;
    Panel17: TPanel;
    KeysHelp: TPanel;
    KeysB: TPanel;
    KeysC: TPanel;
    KeyParse: TPanel;
    GoClear2: TPanel;
    GoNext2: TPanel;
    Parser: TTimer;
    KeyCollector: TMemo;
    Panel6: TPanel;
    ChoiseD: TPanel;
    YaLogin: TEdit;
    YaPassword: TEdit;
    YaHideClick: TButton;
    YaHideClick2: TButton;
    YaEntryB: TPanel;
    YaEntry: TTimer;
    Sheet1: TPanel;
    Sheet2: TPanel;
    Sheet3: TPanel;
    Sheet4: TPanel;
    Sheet5: TPanel;
    SheetList: TPanel;
    HandClearP: TPanel;
    HandClear: TPanel;
    Panel22: TPanel;
    Panel23: TPanel;
    CheckBox1: TCheckBox;
    CheckBox2: TCheckBox;
    CheckBox3: TCheckBox;
    CheckBox4: TCheckBox;
    CheckBox5: TCheckBox;
    CheckBox6: TCheckBox;
    CheckBox7: TCheckBox;
    Panel21: TPanel;
    AdsSheet: TPanel;
    KeyParseP: TPanel;
    Panel14: TPanel;
    NextWordB: TPanel;
    Panel25: TPanel;
    keysPNG: TImage;
    ClearClose: TPanel;
    DokeyHelp: TPanel;
    Panel24: TPanel;
    DoErr: TPanel;
    PreKeyErr: TPanel;
    AdsManager: TPanel;
    AdsRight: TMemo;
    AdsRightErr: TPanel;
    AdsRightB: TPanel;
    AdsRightControl: TPanel;
    AdsRightNext: TPanel;
    AdsRightHelp: TPanel;
    AdsRightClose: TPanel;
    Panel32: TPanel;
    AdsRightE: TEdit;
    AdsRightL: TPanel;
    AdsRightZagE: TEdit;
    AdsRightZags: TMemo;
    hrefdesc: TEdit;
    Panel18: TPanel;
    HotPNG: TImage;
    HeatPNG: TImage;
    ColdPNG: TImage;
    teplota: TMemo;
    KeyPhraze: TMemo;
    InfoP: TPanel;
    AdsSet: TPanel;
    AdsHref: TEdit;
    StavkaP: TPanel;
    Stavka: TLabel;
    Label2: TLabel;
    SrChek: TEdit;
    Panel33: TPanel;
    marzha: TEdit;
    k1: TEdit;
    k2: TEdit;
    prmarzhi: TEdit;
    AdsDescs: TMemo;
    AdsFasts: TMemo;
    Label3: TLabel;
    Label4: TLabel;
    AdsFastCounter: TLabel;
    AdsDescCounter: TLabel;
    AdsZagShape: TShape;
    AdsFastsShape: TShape;
    AdsHrefShape: TShape;
    AdsHrefDescShape: TShape;
    AdsTextShape: TShape;
    AdsDescsShape: TShape;
    AdsHrefDescCounter: TLabel;
    AdsRightZags2: TMemo;
    AdsErr: TPanel;
    Sheet6: TPanel;
    StavkaHelp: TPanel;
    StavkaClose: TPanel;
    Panel20: TPanel;
    AdsHelp: TPanel;
    AdsClose: TPanel;
    AdsControlP: TPanel;
    CtrPNG: TImage;
    PriblPNG: TImage;
    stavkaPNG: TImage;
    nextPNG: TImage;
    FinishSheet: TPanel;
    FinishPNG: TImage;
    Panel34: TPanel;
    AdsRightZag2E: TEdit;
    SrChekPNG: TImage;
    MarzhaPNG: TImage;
    K1PNG: TImage;
    K2PNG: TImage;
    PrMarzhiPNG: TImage;
    TeplotaShape: TShape;
    Cities: TMemo;
    InCities: TMemo;
    Times: TMemo;
    UTPs: TMemo;
    CTAs: TMemo;
    ShemeAds: TMemo;
    TimeSetP: TPanel;
    Panel36: TPanel;
    CitySetP: TPanel;
    Panel38: TPanel;
    Panel39: TPanel;
    Panel40: TPanel;
    Panel41: TPanel;
    Panel42: TPanel;
    Panel43: TPanel;
    Panel44: TPanel;
    Panel45: TPanel;
    Panel46: TPanel;
    Panel47: TPanel;
    Panel48: TPanel;
    Panel49: TPanel;
    Panel50: TPanel;
    Panel51: TPanel;
    Panel52: TPanel;
    WorkTimesP: TPanel;
    Panel53: TPanel;
    ComboBox1: TComboBox;
    ComboBox2: TComboBox;
    ComboBox3: TComboBox;
    ComboBox4: TComboBox;
    Panel54: TPanel;
    plusPNG: TImage;
    Panel55: TPanel;
    WorkTime: TMemo;
    clearPNG: TImage;
    UTPSetP: TPanel;
    finisherr: TPanel;
    ActsHelp: TPanel;
    CTAsHelp: TPanel;
    DedlineHelp: TPanel;
    MarginsLeft: TPanel;
    MarginsRight: TPanel;
    Panel56: TPanel;
    MediaPlayer1: TMediaPlayer;
    Panel57: TPanel;
    Panel58: TPanel;
    YandexParseP: TPanel;
    soundPNG: TImage;
    Sheet7: TPanel;
    SiteSheet: TPanel;
    FieldParam: TPanel;
    SiteControl: TPanel;
    Panel62: TPanel;
    Panel63: TPanel;
    Panel64: TPanel;
    BR: TChromium;
    Button1: TButton;
    LoadImg: TPanel;
    Panel60: TPanel;
    Button2: TButton;
    NameFile: TPanel;
    reclick: TTimer;
    Panel61: TPanel;
    SG: TStringGrid;
    separator: TMemo;
    CheckZag2: TCheckBox;
    FilesCSV: TMemo;
    LoadScreen: TPanel;
    addprodPNG: TImage;
    SaveChanges: TPanel;
    ShowInfoP: TPanel;
    RusToEn: TPanel;
    HideMinusB: TPanel;
    MinusPNG: TImage;
    MinusAllPNG: TImage;
    ClearingAllPNG: TImage;
    Panel37: TPanel;
    Kbrd3PNG: TImage;
    Kbrd2PNG: TImage;
    Kbrd1PNG: TImage;
    HintK: TPanel;
    Zagotovki: TMemo;
    Panel59: TPanel;
    rsy: TStringGrid;
    Memo1: TMemo;
    ParserRSY: TTimer;
    FindControl: TPanel;
    Memo2: TMemo;
    PrClearE: TEdit;
    PrClear: TTrackBar;
    Panel65: TPanel;
    AdsCreater: TTimer;
    AdsBR: TChromium;
    Memo3: TMemo;
    Panel66: TPanel;
    LoadProg: TTimer;
    ZagotovkiT: TStringGrid;
    AdsSettings: TPanel;
    AdsSettingsP: TPanel;
    AdsC: TCheckBox;
    Button3: TButton;
    AdsZagC: TCheckBox;
    AdsZag2C: TCheckBox;
    AdsTextC: TCheckBox;
    ThreeNext: TPanel;
    Finality: TTimer;
    SheetDo: TPanel;
    DoRKP: TPanel;
    Panel70: TPanel;
    DoHelp: TPanel;
    Panel72: TPanel;
    DoRK1: TPanel;
    DoSP: TMemo;
    DoOptions: TPanel;
    DoYaLogin: TEdit;
    Panel67: TPanel;
    DoYaPass: TEdit;
    Panel69: TPanel;
    DoError: TPanel;
    YaTimer: TTimer;
    PageCode: TMemo;
    rsy2: TStringGrid;
    DoSetB: TImage;
    DoST: TComboBox;
    LocalMinus: TMemo;
    LocalText: TMemo;
    LocalZag: TMemo;
    RegionsP: TPanel;
    TreeView2: TTreeView;
    GlobalPNG: TImage;
    Memo5: TMemo;
    RegionsM: TMemo;
    RegionsI: TMemo;
    TreeView1: TTreeView;
    Panel73: TPanel;
    RegionsMI: TMemo;
    HideP: TPanel;
    HideOnOff: TPanel;
    HideCont: TPanel;
    poisk: TStringGrid;
    HidePaddingBottomP: TPanel;
    IdHTTP: TIdHTTP;
    AutoSave: TTimer;
    SPP: TPanel;
    DoSR: TMemo;
    Panel74: TPanel;
    Numbers: TMemo;
    Minuss: TMemo;
    MyMinuss: TMemo;
    AdsFastUrls: TMemo;
    FastHideP: TPanel;
    FastP: TPanel;
    FastUrlBut: TPanel;
    Label5: TLabel;
    SettingsPNG: TImage;
    HideContentP: TPanel;
    HideControls: TPanel;
    HidePreKeyL: TPanel;
    HideMinusL: TPanel;
    HideMinusM: TPanel;
    HidePreKeyI: TImage;
    HideMinusAll: TPanel;
    HideMinusMy: TPanel;
    HideMinusI: TImage;
    HideKeyP: TPanel;
    HideKeyR: TPanel;
    HideKeyL: TPanel;
    HideKeyI: TImage;
    HideKeyM: TPanel;
    HideKeyB: TPanel;
    HideKeyAddP: TPanel;
    HideKeyMyP: TPanel;
    HideKeyZ: TPanel;
    HidePreKeyM: TPanel;
    HidePreKeyB: TPanel;
    HidePreKeyPoisk: TPanel;
    HidePreKeyRSY: TPanel;
    HidePreKeyZ: TPanel;
    PreKeyRSY: TMemo;
    HideAdsP: TPanel;
    HideAdsR: TPanel;
    HideAdsL: TPanel;
    HideAdsI: TImage;
    HideAdsM: TPanel;
    HideAdsB: TPanel;
    HideAdsAdd: TPanel;
    HideAdsMy: TPanel;
    HideAdsZ: TPanel;
    MyKey: TMemo;
    HideMenu: TPanel;
    SettingsP: TPanel;
    Settings: TPanel;
    OtsevC: TCheckBox;
    OtsevE: TEdit;
    OtsevT: TTrackBar;
    Label6: TLabel;
    SovE: TEdit;
    SovT: TTrackBar;
    Label7: TLabel;
    DlSovE: TEdit;
    DlSovT: TTrackBar;
    Label8: TLabel;
    MinDlSlovT: TTrackBar;
    MinDlSlovE: TEdit;
    Label9: TLabel;
    FormListClearC: TCheckBox;
    ListClear: TMemo;
    ClearingP: TPanel;
    NoListClear: TMemo;
    LoadBarP: TPanel;
    LoadBar: TProgressBar;
    LoadI: TImage;
    Loader: TTimer;
    Label10: TLabel;
    Label11: TLabel;
    ProcClearT: TTrackBar;
    ProcClearE: TEdit;
    CampaignCreator: TTimer;
    metro: TEdit;
    Panel12: TPanel;
    PreMinuss: TMemo;
    Panel13: TPanel;
    Image1: TImage;
    LidsPNG: TImage;
    Lids: TEdit;
    Label14: TLabel;
    Budget: TLabel;
    Panel15: TPanel;
    Shape1: TShape;
    PoiskWord: TLabel;
    PoiskBut1: TShape;
    PoiskBut2: TShape;
    PoiskBut3: TLabel;
    Panel35: TPanel;
    ClearWord: TLabel;
    DelWord: TLabel;
    Close: TLabel;
    ClearPre: TPanel;
    ProgDohod: TLabel;
    Label13: TLabel;
    ClickSPNG: TImage;
    BudgetSPNG: TImage;
    DohodSPNG: TImage;
    HideL: TPanel;
    HideLOnOff: TPanel;
    HideLTop: TPanel;
    ScrollBox1: TScrollBox;
    Panel68: TPanel;
    Panel71: TPanel;
    Hot: TImage;
    Cold: TImage;
    Log: TImage;
    Pas: TImage;
    Panel75: TPanel;
    Panel76: TPanel;
    Rezhim: TLabel;
    DoRK: TPanel;
    HideLCont: TPanel;
    Chto: TMemo;
    Kakoe: TMemo;
    Deistvie: TMemo;
    ProdDob: TMemo;
    Mesto: TMemo;
    Konkurenty: TMemo;
    Memo25: TMemo;
    Memo17: TMemo;
    Memo18: TMemo;
    Memo19: TMemo;
    Memo20: TMemo;
    Memo10: TMemo;
    Memo11: TMemo;
    Memo12: TMemo;
    Memo13: TMemo;
    Memo14: TMemo;
    Memo15: TMemo;
    Memo16: TMemo;
    Memo21: TMemo;
    Memo22: TMemo;
    Memo23: TMemo;
    Memo24: TMemo;
    ClearChisloC: TCheckBox;
    Memo4: TMemo;
    ReplaceP: TPanel;
    ReplaceW: TEdit;
    ReplaceR: TEdit;
    ReplaceB: TSpeedButton;
    Panel77: TPanel;
    Panel78: TPanel;
    ReplaceH: TPanel;
    ReplaceOn: TLabel;
    Panel79: TPanel;
    Panel80: TPanel;
    Panel81: TPanel;
    ReplaceM: TMemo;
    Panel82: TPanel;
    Panel83: TPanel;
    Panel84: TPanel;
    Panel86: TPanel;
    proPNG: TImage;
    dataPNG: TImage;
    Panel87: TPanel;
    LoadBar2: TProgressBar;
    Panel85: TPanel;
    ReplaceT: TStringGrid;
    FinishControlP: TPanel;
    CitySlicePNG: TImage;
    UTPsetPNG: TImage;
    TimeSlicePNG: TImage;
    CTAsetPNG: TImage;
    CTASetP: TPanel;
    Panel89: TPanel;
    Panel88: TPanel;
    Panel90: TPanel;
    CTAch: TMemo;
    Panel91: TPanel;
    Panel92: TPanel;
    UTPch: TMemo;
    ADS: TMemo;
    Panel93: TPanel;
    RadioButton1: TRadioButton;
    RadioButton2: TRadioButton;
    RadioButton3: TRadioButton;
    Panel94: TPanel;
    Predpiska: TEdit;
    Label12: TLabel;
    Label15: TLabel;
    Dopiska: TEdit;
    TimeSliceRezult: TPanel;
    Days: TMemo;
    Months: TMemo;
    SliceTimeCh: TCheckBox;
    Panel95: TPanel;
    Panel96: TPanel;
    Panel97: TPanel;
    Panel98: TPanel;
    SliceCityCh: TCheckBox;
    AllCity: TSpeedButton;
    CitiesCh: TMemo;
    FastClearCh: TCheckBox;
    RefreshCounter: TSpeedButton;
    DefoltSet: TSpeedButton;
    HideMinusCity: TPanel;
    Panel99: TPanel;
    Panel100: TPanel;
    ProxyIps: TMemo;
    ProxyPorts: TMemo;
    FindProxyCh: TCheckBox;
    proxyPNG: TImage;
    ProxyEnabler: TTimer;
    FastTextAdsCh: TCheckBox;
    GetToken: TTimer;
    GetMetrika: TTimer;
    AdExtensionIds: TStringGrid;
    BudgetE: TEdit;
    BudgetT: TTrackBar;
    Label16: TLabel;
    GroupSelectorP: TPanel;
    Panel102: TPanel;
    Panel103: TPanel;
    Panel104: TPanel;
    Button4: TButton;
    ReplacerZTZP: TPanel;
    Panel101: TPanel;
    Panel105: TPanel;
    Panel106: TPanel;
    OldZTZ: TLabel;
    NewZTZ: TEdit;
    ReplaceZTZ: TPanel;
    DeleteZTZ: TPanel;
    CountControl: TStringGrid;
    Panel107: TPanel;
    GroupSelectorMI: TMemo;
    ReplaceZTZOne: TPanel;
    ProxyT: TStringGrid;
    Edit1: TEdit;
    Edit2: TEdit;
    vopros: TMemo;
    media: TMemo;
    clicks: TLabel;
    clicksSPNG: TImage;
    clicksperday: TLabel;
    clicksperdaySPNG: TImage;
    Label18: TLabel;
    BudgetPerDaySPNG: TImage;
    BudgetPerDay: TLabel;
    LoginP: TPanel;
    Panel109: TPanel;
    Panel110: TPanel;
    Panel111: TPanel;
    footer: TPanel;
    Panel108: TPanel;
    Button5: TButton;
    Memo6: TMemo;
    Shape2: TShape;
    Shape3: TShape;
    Shape4: TShape;
    Shape5: TShape;
    Shape6: TShape;
    GroupSelectorZP: TPanel;
    Panel113: TPanel;
    Panel114: TPanel;
    Panel115: TPanel;
    GroupSelectorZM: TMemo;
    Panel116: TPanel;
    GroupSelectorZMI: TMemo;
    Panel112: TPanel;
    Panel117: TPanel;
    Panel118: TPanel;
    Panel119: TPanel;
    Shape7: TShape;
    Shape8: TShape;
    Shape9: TShape;
    regio: TPanel;
    ClearListP: TPanel;
    Panel122: TPanel;
    ClearListPX: TPanel;
    ClearList: TMemo;
    ClearListB: TPanel;
    Shape10: TShape;
    Shape11: TShape;
    Button6: TButton;
    IndexList: TMemo;
    LenStr: TLabel;
    Label19: TLabel;
    MaxLenStr: TLabel;
    ErrorZP: TPanel;
    GroupSelectorM: TMemo;
    procedure SaveData(code: string);
    procedure LoadData(code: string);
    procedure SheetHide;
    procedure SaveInfo;
    procedure Parse;
    procedure checkClass;
    procedure nextPage;
    procedure clickFind;
    procedure pasteWord;
    procedure colWords;
    procedure nextWord;
    procedure checkWord;
    procedure SelLine(Memo: TMemo; Index: integer);
    procedure HideMemos;
    // procedure Next;
    procedure doRSYcol;
    procedure doRSYword;
    procedure pasteWordRSY;
    procedure clickFindRSY;
    procedure TakePageRSY;
    procedure ParseRSY;
    procedure checkWordRSY;
    procedure AssociateRSY;
    procedure KorRSY;
    procedure PasteAds;
    procedure SiteCode;
    procedure TakeAds;
    procedure Pars(Memo: TMemo);
    procedure StringVisitor(const str: ustring);
    procedure StringVisitor2(const str: ustring);
    procedure getResult(s: string; const doc: ICefDomDocument);
    procedure WMDropFiles(var Msg: TWMDropFiles); message WM_DROPFILES;
    function GetSerialMotherBoard: String;
    procedure DelStrInSG(strn: string; table: TStringGrid; stl: integer);
    // procedure Clearing(Memo: TMemo; Memo2: TMemo; table: TStringGrid; stl: integer);
    function DownloadFile(aIdHTTP: TIdHTTP; aUrl: string;
      aFileName: string): boolean;

    procedure MemoChanger(Memo: TMemo);
    procedure MemoChoiser(Memo: TMemo);
    procedure WordReplaceP(M, M2, Mr: TMemo; sov, dlsl: integer;
      T, T2: TProgressBar; SG, SG2: TStringGrid);
    function WordReplaceS(s, r: string; M: TStrings): string;
    procedure WordReplaceM(Memo: TMemo; r: string; M: TMemo; T: TProgressBar);
    function Pohozhest(fraza: string; fraza2: string; sov: integer;
      const dlsl: integer): boolean;
    function WordInStrP(w: string; s: string; sov: integer;
      dlsl: integer): boolean;
    function DelWordInStrP(const w, s: string; sov: integer;
      dlsl: integer): string;
    procedure Clearing2P(Memo: TMemo; Memo2: TMemo; ccc: boolean;
      sov, dlsl: integer; T: TProgressBar);
    procedure Clearing2Pstr(stri: string; Memo2: TMemo; ccc: boolean;
      sov, dlsl: integer; pos: integer);
    procedure Clearing2P2(Memo: TMemo; Memo2: TMemo; SG: TStringGrid;
      col: integer; ccc: boolean; sov, dlsl: integer; T: TProgressBar);
    procedure Clearing5(Memo: TMemo; Memo2: TMemo; ListClear: TMemo;
      sov, DlSov, MinDlSlov: integer; formlist: boolean);
    procedure ClearingS(Memo: array of TMemo; Memo2: TMemo; SG: TStringGrid;
      col, sov, DlSov, MinDlSlov: integer; ccc, posorcomp, cutordel, clearornot,
      formlist: boolean; TP: TProgressBar);
    procedure ReplaceToTable(ReplaceR: string; ReplaceM: TMemo;
      ReplaceT: TStringGrid);
    procedure MinusCrossMinT(Memo: TMemo; SG: TStringGrid; col: integer;
      TP: TProgressBar);
    procedure CreateNames(SG: TStringGrid);
    procedure NoDuplicate2T(Memo: TMemo; SG: TStringGrid);
    procedure ReplaceRefresh(ReplaceT, poisk: TStringGrid; TP: TProgressBar);

    procedure DoYaEntry;
    procedure TakePageCode(Memo: TMemo; Page: TChromium);
    procedure TakePageCode2(Memo: TMemo; Page: TChromium);
    procedure StringVisitor3(const str: ustring);
    procedure ParsePage(Memo: TMemo);
    function TakeInner(s: string): string;
    procedure ParseRSYA(s: string; SG: TStringGrid; b: boolean);
    procedure ParseAuto(s: string; b: boolean);
    procedure nextPageA;
    procedure MinusCrossAdd(Memo: TMemo; SG: TStringGrid; TP: TProgressBar);

    // procedure FindWord(br: TChromium; word: string);
    function Changer(s: string): string;
    procedure DeleteARow(Grid: TStringGrid; ARow: integer);
    procedure FormCreate(Sender: TObject);
    procedure MinimizeBMouseEnter(Sender: TObject);
    procedure MinimizeBMouseLeave(Sender: TObject);
    procedure MinimizeBClick(Sender: TObject);
    procedure LoginIClick(Sender: TObject);
    procedure HideInjectionClick(Sender: TObject);
    procedure FormActivate(Sender: TObject);
    procedure BRRegLoadEnd(Sender: TObject; const Browser: ICefBrowser;
      const frame: ICefFrame; httpStatusCode: integer);
    procedure HelpBClick(Sender: TObject);
    procedure HelpBMouseEnter(Sender: TObject);
    procedure HelpBMouseLeave(Sender: TObject);
    procedure HideInjection2Click(Sender: TObject);
    procedure LoadingTimer(Sender: TObject);
    procedure ExitBClick(Sender: TObject);
    procedure ExitBMouseEnter(Sender: TObject);
    procedure ExitBMouseLeave(Sender: TObject);
    procedure EditKeyPress(Sender: TObject; var Key: Char);
    procedure InfoIClick(Sender: TObject);
    procedure LoginEKeyPress(Sender: TObject; var Key: Char);
    procedure CodeNameSelect(Sender: TObject);
    procedure wordstatMouseEnter(Sender: TObject);
    procedure wordstatMouseLeave(Sender: TObject);
    procedure ThreeHelpMouseLeave(Sender: TObject);
    procedure ThreeHelpMouseEnter(Sender: TObject);
    procedure BRRegConsoleMessage(Sender: TObject; const Browser: ICefBrowser;
      const message, source: ustring; line: integer; out Result: boolean);
    procedure SiteListDblClick(Sender: TObject);
    procedure ThreeTimerTimer(Sender: TObject);
    procedure FindSitesClick(Sender: TObject);
    procedure wordstatDblClick(Sender: TObject);
    procedure ThreeHelpClick(Sender: TObject);
    procedure HelpZoneMouseEnter(Sender: TObject);
    procedure HelpZoneMouseLeave(Sender: TObject);
    procedure SellPhraseMemoDblClick(Sender: TObject);
    procedure HintPMouseEnter(Sender: TObject);
    procedure HintPMouseLeave(Sender: TObject);
    procedure eyePNGMouseEnter(Sender: TObject);
    procedure eyePNGMouseLeave(Sender: TObject);
    procedure eyePNGClick(Sender: TObject);
    procedure keyplannerClick(Sender: TObject);
    procedure keyplannerMouseLeave(Sender: TObject);
    procedure LaterTimer(Sender: TObject);
    procedure SiteListMouseMove(Sender: TObject; Shift: TShiftState;
      X, Y: integer);
    procedure SiteListMouseLeave(Sender: TObject);
    procedure KonkurentHelpMouseEnter(Sender: TObject);
    procedure GoogleHelpDblClick(Sender: TObject);
    procedure wordstatClick(Sender: TObject);
    procedure HidePreKeyMClick(Sender: TObject);
    procedure PreKeyHelpMouseEnter(Sender: TObject);
    procedure PreKeyHelpMouseLeave(Sender: TObject);
    procedure PreKeyLoadMouseEnter(Sender: TObject);
    procedure PreKeyLoadMouseLeave(Sender: TObject);
    procedure HidePreKeyRMouseEnter(Sender: TObject);
    procedure HidePreKeyRClick(Sender: TObject);
    procedure FormDestroy(Sender: TObject);
    procedure PreKeyDblClick(Sender: TObject);
    procedure GoClearClick(Sender: TObject);
    procedure KeyParseClick(Sender: TObject);
    procedure GoClear2Click(Sender: TObject);
    procedure KeyParseDblClick(Sender: TObject);
    procedure YaHideClickClick(Sender: TObject);
    procedure ParserTimer(Sender: TObject);
    procedure GoNextClick(Sender: TObject);
    procedure YaEntryBClick(Sender: TObject);
    procedure YaEntryTimer(Sender: TObject);
    procedure YaHideClick2Click(Sender: TObject);
    procedure Sheet1MouseEnter(Sender: TObject);
    procedure Sheet2MouseEnter(Sender: TObject);
    procedure Sheet3MouseEnter(Sender: TObject);
    procedure Sheet4MouseEnter(Sender: TObject);
    procedure Sheet5MouseEnter(Sender: TObject);
    procedure Sheet1MouseLeave(Sender: TObject);
    procedure Sheet2MouseLeave(Sender: TObject);
    procedure Sheet3MouseLeave(Sender: TObject);
    procedure Sheet4MouseLeave(Sender: TObject);
    procedure Sheet5MouseLeave(Sender: TObject);
    procedure Sheet1Click(Sender: TObject);
    procedure Sheet2Click(Sender: TObject);
    procedure Sheet3Click(Sender: TObject);
    procedure Sheet4Click(Sender: TObject);
    procedure Sheet5Click(Sender: TObject);
    procedure ClearingFullPNGClick(Sender: TObject);
    procedure ClearingYesPNGClick(Sender: TObject);
    procedure ClearingNoPNGClick(Sender: TObject);
    procedure HandClearClick(Sender: TObject);
    procedure GoClearDblClick(Sender: TObject);
    procedure ThreeHelpInfoClick(Sender: TObject);
    procedure Panel22Click(Sender: TObject);
    procedure ClearingHelpMouseEnter(Sender: TObject);
    procedure HideMinusRMouseLeave(Sender: TObject);
    procedure ClearCloseClick(Sender: TObject);
    procedure CodeNameChange(Sender: TObject);
    procedure DokeyHelpMouseEnter(Sender: TObject);
    procedure DokeyHelpMouseLeave(Sender: TObject);
    procedure keyplannerMouseEnter(Sender: TObject);
    procedure YaLoginKeyPress(Sender: TObject; var Key: Char);
    procedure YaPasswordKeyPress(Sender: TObject; var Key: Char);
    procedure KeysBClick(Sender: TObject);
    procedure KeysHelpMouseEnter(Sender: TObject);
    procedure keysPNGClick(Sender: TObject);
    procedure KeysHelpMouseLeave(Sender: TObject);
    procedure SiteListKeyPress(Sender: TObject; var Key: Char);
    procedure AdsRightKeyPress(Sender: TObject; var Key: Char);
    procedure AdsRightClick(Sender: TObject);
    procedure AdsRightEKeyPress(Sender: TObject; var Key: Char);
    procedure AdsRightNextClick(Sender: TObject);
    procedure AdsRightCloseClick(Sender: TObject);
    procedure AdsRightZagEKeyPress(Sender: TObject; var Key: Char);
    procedure AdsRightZagsKeyPress(Sender: TObject; var Key: Char);
    procedure AdsRightZagsClick(Sender: TObject);
    procedure HotPNGClick(Sender: TObject);
    procedure HeatPNGClick(Sender: TObject);
    procedure ColdPNGClick(Sender: TObject);
    procedure PhoneKeyPress(Sender: TObject; var Key: Char);
    procedure AdsRightZagsMouseUp(Sender: TObject; Button: TMouseButton;
      Shift: TShiftState; X, Y: integer);
    procedure AdsRightZagsKeyUp(Sender: TObject; var Key: Word;
      Shift: TShiftState);
    procedure AdsRightZagsKeyDown(Sender: TObject; var Key: Word;
      Shift: TShiftState);
    procedure AdsRightKeyDown(Sender: TObject; var Key: Word;
      Shift: TShiftState);
    procedure AdsRightKeyUp(Sender: TObject; var Key: Word; Shift: TShiftState);
    procedure AdsRightMouseUp(Sender: TObject; Button: TMouseButton;
      Shift: TShiftState; X, Y: integer);
    procedure KeyCollectorMouseUp(Sender: TObject; Button: TMouseButton;
      Shift: TShiftState; X, Y: integer);
    procedure KeyCollectorKeyUp(Sender: TObject; var Key: Word;
      Shift: TShiftState);
    procedure KeyCollectorKeyDown(Sender: TObject; var Key: Word;
      Shift: TShiftState);
    procedure PreKeyMouseUp(Sender: TObject; Button: TMouseButton;
      Shift: TShiftState; X, Y: integer);
    procedure PreKeyKeyUp(Sender: TObject; var Key: Word; Shift: TShiftState);
    procedure PreKeyKeyDown(Sender: TObject; var Key: Word; Shift: TShiftState);
    procedure AdsMemoMouseUp(Sender: TObject; Button: TMouseButton;
      Shift: TShiftState; X, Y: integer);
    procedure AdsMemoKeyUp(Sender: TObject; var Key: Word; Shift: TShiftState);
    procedure AdsMemoKeyDown(Sender: TObject; var Key: Word;
      Shift: TShiftState);
    procedure AdsFastsKeyPress(Sender: TObject; var Key: Char);
    procedure AdsDescsKeyPress(Sender: TObject; var Key: Char);
    procedure hrefdescKeyPress(Sender: TObject; var Key: Char);
    procedure Sheet6MouseLeave(Sender: TObject);
    procedure Sheet6MouseEnter(Sender: TObject);
    procedure AdsRightHelpMouseEnter(Sender: TObject);
    procedure AdsRightHelpMouseLeave(Sender: TObject);
    procedure hrefdescEnter(Sender: TObject);
    procedure hrefdescExit(Sender: TObject);
    procedure AdsFastsExit(Sender: TObject);
    procedure AdsFastsEnter(Sender: TObject);
    procedure AdsDescsEnter(Sender: TObject);
    procedure AdsDescsExit(Sender: TObject);
    procedure AdsHelpMouseEnter(Sender: TObject);
    procedure AdsHelpMouseLeave(Sender: TObject);
    procedure StavkaHelpMouseEnter(Sender: TObject);
    procedure StavkaHelpMouseLeave(Sender: TObject);
    procedure StavkaCloseClick(Sender: TObject);
    procedure AdsCloseClick(Sender: TObject);
    procedure PriblPNGClick(Sender: TObject);
    procedure CtrPNGClick(Sender: TObject);
    procedure stavkaPNGClick(Sender: TObject);
    procedure Sheet6Click(Sender: TObject);
    procedure FinishPNGClick(Sender: TObject);
    procedure AdsHrefEnter(Sender: TObject);
    procedure AdsHrefExit(Sender: TObject);
    procedure AdsRightZagEEnter(Sender: TObject);
    procedure AdsRightEEnter(Sender: TObject);
    procedure AdsRightEExit(Sender: TObject);
    procedure AdsRightZagEExit(Sender: TObject);
    procedure AdsHrefKeyPress(Sender: TObject; var Key: Char);
    procedure AdsHrefKeyUp(Sender: TObject; var Key: Word; Shift: TShiftState);
    procedure AdsRightEChange(Sender: TObject);
    procedure AdsRightZagEChange(Sender: TObject);
    procedure AdsRightZag2EChange(Sender: TObject);
    procedure AdsRightZag2EKeyPress(Sender: TObject; var Key: Char);
    procedure AdsRightZag2EEnter(Sender: TObject);
    procedure AdsRightZag2EExit(Sender: TObject);
    procedure AdsFastsChange(Sender: TObject);
    procedure AdsDescsChange(Sender: TObject);
    procedure hrefdescChange(Sender: TObject);
    procedure SrChekChange(Sender: TObject);
    procedure marzhaChange(Sender: TObject);
    procedure k1Change(Sender: TObject);
    procedure k2Change(Sender: TObject);
    procedure prmarzhiChange(Sender: TObject);
    procedure prmarzhiEnter(Sender: TObject);
    procedure SrChekEnter(Sender: TObject);
    procedure marzhaEnter(Sender: TObject);
    procedure k1Enter(Sender: TObject);
    procedure k2Enter(Sender: TObject);
    procedure k2KeyPress(Sender: TObject; var Key: Char);
    procedure k1KeyPress(Sender: TObject; var Key: Char);
    procedure SrChekKeyPress(Sender: TObject; var Key: Char);
    procedure prmarzhiKeyPress(Sender: TObject; var Key: Char);
    procedure marzhaKeyPress(Sender: TObject; var Key: Char);
    procedure WorkTimesClick(Sender: TObject);
    procedure plusPNGClick(Sender: TObject);
    procedure Panel54Click(Sender: TObject);
    procedure clearPNGClick(Sender: TObject);
    procedure UTPsClick(Sender: TObject);
    procedure CTAsClick(Sender: TObject);
    procedure InCitiesClick(Sender: TObject);
    procedure TimesClick(Sender: TObject);
    procedure Panel36Click(Sender: TObject);
    procedure CitiesClick(Sender: TObject);
    procedure ActsHelpMouseEnter(Sender: TObject);
    procedure ActsHelpMouseLeave(Sender: TObject);
    procedure CTAsHelpMouseLeave(Sender: TObject);
    procedure CTAsHelpMouseEnter(Sender: TObject);
    procedure DedlineHelpMouseEnter(Sender: TObject);
    procedure DedlineHelpMouseLeave(Sender: TObject);
    procedure GoClear2MouseEnter(Sender: TObject);
    procedure GoClear2MouseLeave(Sender: TObject);
    procedure SiteListClick(Sender: TObject);
    procedure KonkurentHelpClick(Sender: TObject);
    procedure soundPNGMouseEnter(Sender: TObject);
    procedure soundPNGMouseLeave(Sender: TObject);
    procedure soundPNGClick(Sender: TObject);
    procedure Sheet7MouseEnter(Sender: TObject);
    procedure Sheet7MouseLeave(Sender: TObject);
    procedure Sheet7Click(Sender: TObject);
    procedure Button1Click(Sender: TObject);
    procedure LoadImgClick(Sender: TObject);
    procedure Button2Click(Sender: TObject);
    procedure BRConsoleMessage(Sender: TObject; const Browser: ICefBrowser;
      const message, source: ustring; line: integer; out Result: boolean);
    procedure Panel60Click(Sender: TObject);
    procedure reclickTimer(Sender: TObject);
    procedure ClearingHelpMouseLeave(Sender: TObject);
    procedure LoginIMouseEnter(Sender: TObject);
    procedure LoginIMouseLeave(Sender: TObject);
    procedure InfoIMouseEnter(Sender: TObject);
    procedure InfoIMouseLeave(Sender: TObject);
    procedure addprodPNGClick(Sender: TObject);
    procedure SaveChangesClick(Sender: TObject);
    procedure familiyaChange(Sender: TObject);
    procedure CityChange(Sender: TObject);
    procedure UlicaChange(Sender: TObject);
    procedure domChange(Sender: TObject);
    procedure ogrnChange(Sender: TObject);
    procedure KompaniyaChange(Sender: TObject);
    procedure imyaChange(Sender: TObject);
    procedure otchestvoChange(Sender: TObject);
    procedure korpusChange(Sender: TObject);
    procedure PhoneChange(Sender: TObject);
    procedure oficeChange(Sender: TObject);
    procedure KontEmailChange(Sender: TObject);
    procedure EditEnter(Sender: TObject);
    procedure AddiChange(Sender: TObject);
    procedure CodeNameKeyPress(Sender: TObject; var Key: Char);
    procedure RusToEnDblClick(Sender: TObject);
    procedure KonkurentHelpMouseLeave(Sender: TObject);
    procedure HidePreKeyRMouseLeave(Sender: TObject);
    procedure HideMinusBClick(Sender: TObject);
    procedure KeyCollectorDblClick(Sender: TObject);
    procedure KeyCollectorClick(Sender: TObject);
    procedure MinussDblClick(Sender: TObject);
    procedure GoogleHelpMouseEnter(Sender: TObject);
    procedure GoogleHelpMouseLeave(Sender: TObject);
    procedure RusToEnMouseEnter(Sender: TObject);
    procedure RusToEnMouseLeave(Sender: TObject);
    procedure addprodPNGMouseEnter(Sender: TObject);
    procedure addprodPNGMouseLeave(Sender: TObject);
    procedure LoginEMouseEnter(Sender: TObject);
    procedure LoginEMouseLeave(Sender: TObject);
    procedure PassEMouseLeave(Sender: TObject);
    procedure PassEMouseEnter(Sender: TObject);
    procedure PassEKeyPress(Sender: TObject; var Key: Char);
    procedure ZagotovkiClick(Sender: TObject);
    procedure GoNext2Click(Sender: TObject);
    procedure Panel59Click(Sender: TObject);
    procedure rsyClick(Sender: TObject);
    procedure ParserRSYTimer(Sender: TObject);
    procedure PrClearChange(Sender: TObject);
    procedure AdsCreaterTimer(Sender: TObject);
    procedure Panel65Click(Sender: TObject);
    procedure AdsBRLoadEnd(Sender: TObject; const Browser: ICefBrowser;
      const frame: ICefFrame; httpStatusCode: integer);
    procedure Panel66Click(Sender: TObject);
    procedure LoadProgTimer(Sender: TObject);
    procedure AdsSettingsClick(Sender: TObject);
    procedure Button3Click(Sender: TObject);
    procedure SellPhraseMemoChange(Sender: TObject);
    procedure FinalityTimer(Sender: TObject);
    procedure DoSPChange(Sender: TObject);
    procedure HelpInputClick(Sender: TObject);
    procedure DoSPKeyPress(Sender: TObject; var Key: Char);
    procedure YaTimerTimer(Sender: TObject);
    procedure Memo1Click(Sender: TObject);
    procedure PageCodeClick(Sender: TObject);
    procedure DoOptionsClick(Sender: TObject);
    procedure rsy2Click(Sender: TObject);
    procedure DoSetBMouseEnter(Sender: TObject);
    procedure DoSetBMouseLeave(Sender: TObject);
    procedure OtsevTChange(Sender: TObject);
    procedure DoSTKeyPress(Sender: TObject; var Key: Char);
    procedure GlobalPNGMouseEnter(Sender: TObject);
    procedure GlobalPNGMouseLeave(Sender: TObject);
    procedure GlobalPNGClick(Sender: TObject);
    procedure DoSetBClick(Sender: TObject);
    procedure TreeView2MouseDown(Sender: TObject; Button: TMouseButton;
      Shift: TShiftState; X, Y: integer);
    procedure TreeView1MouseDown(Sender: TObject; Button: TMouseButton;
      Shift: TShiftState; X, Y: integer);
    procedure Panel73Click(Sender: TObject);
    procedure HideOnOffClick(Sender: TObject);
    procedure AutoSaveTimer(Sender: TObject);
    procedure OtsevEChange(Sender: TObject);
    procedure OtsevEKeyPress(Sender: TObject; var Key: Char);
    procedure DoSRChange(Sender: TObject);
    procedure FastUrlButClick(Sender: TObject);
    procedure SettingsPNGMouseEnter(Sender: TObject);
    procedure SettingsPNGMouseLeave(Sender: TObject);
    procedure HideMinusIMouseEnter(Sender: TObject);
    procedure HidePreKeyIMouseEnter(Sender: TObject);
    procedure HideKeyIMouseEnter(Sender: TObject);
    procedure HideAdsIMouseEnter(Sender: TObject);
    procedure HideAdsIMouseLeave(Sender: TObject);
    procedure HideKeyIMouseLeave(Sender: TObject);
    procedure HidePreKeyIMouseLeave(Sender: TObject);
    procedure HideMinusIMouseLeave(Sender: TObject);
    procedure HideMinusAllClick(Sender: TObject);
    procedure HideMinusMyClick(Sender: TObject);
    procedure HidePreKeyPoiskClick(Sender: TObject);
    procedure HidePreKeyRSYClick(Sender: TObject);
    procedure HideKeyAddPClick(Sender: TObject);
    procedure HideKeyMyPClick(Sender: TObject);
    procedure HideAdsAddClick(Sender: TObject);
    procedure HideMenuClick(Sender: TObject);
    procedure SettingsPNGClick(Sender: TObject);

    procedure SovEKeyPress(Sender: TObject; var Key: Char);
    procedure DlSovEKeyPress(Sender: TObject; var Key: Char);
    procedure OtsevCClick(Sender: TObject);

    procedure SovEChange(Sender: TObject);
    procedure DlSovEChange(Sender: TObject);
    procedure DlSovTChange(Sender: TObject);
    procedure SovTChange(Sender: TObject);
    procedure MinDlSlovEChange(Sender: TObject);
    procedure MinDlSlovTChange(Sender: TObject);
    procedure ListClearDblClick(Sender: TObject);
    procedure NoListClearDblClick(Sender: TObject);
    procedure ListClearClick(Sender: TObject);
    procedure NoListClearClick(Sender: TObject);
    procedure LoaderTimer(Sender: TObject);
    procedure ProcClearTChange(Sender: TObject);
    procedure ProcClearEChange(Sender: TObject);
    procedure CampaignCreatorTimer(Sender: TObject);
    procedure Panel13Click(Sender: TObject);
    procedure Panel12Click(Sender: TObject);
    procedure Image1Click(Sender: TObject);
    procedure SaveChangesMouseEnter(Sender: TObject);
    procedure LidsChange(Sender: TObject);
    procedure LidsEnter(Sender: TObject);
    procedure LidsKeyPress(Sender: TObject; var Key: Char);
    procedure PreKeyRSYDblClick(Sender: TObject);
    procedure PreKeyRSYKeyDown(Sender: TObject; var Key: Word;
      Shift: TShiftState);
    procedure PreKeyRSYKeyUp(Sender: TObject; var Key: Word;
      Shift: TShiftState);
    procedure PreKeyRSYMouseUp(Sender: TObject; Button: TMouseButton;
      Shift: TShiftState; X, Y: integer);
    procedure MyKeyDblClick(Sender: TObject);
    procedure MyKeyKeyDown(Sender: TObject; var Key: Word; Shift: TShiftState);
    procedure MyKeyKeyUp(Sender: TObject; var Key: Word; Shift: TShiftState);
    procedure MyKeyMouseUp(Sender: TObject; Button: TMouseButton;
      Shift: TShiftState; X, Y: integer);
    procedure MyMinussDblClick(Sender: TObject);
    procedure PreMinussDblClick(Sender: TObject);
    procedure PoiskBut3Click(Sender: TObject);
    procedure CloseClick(Sender: TObject);
    procedure ClearWordClick(Sender: TObject);
    procedure ClearPreClick(Sender: TObject);
    procedure HideLOnOffClick(Sender: TObject);
    procedure DoRKClick(Sender: TObject);
    procedure RezhimClick(Sender: TObject);
    procedure ChtoClick(Sender: TObject);
    procedure Memo25Click(Sender: TObject);
    procedure ChtoChange(Sender: TObject);
    procedure AdsRightZags2Click(Sender: TObject);
    procedure HideLTopClick(Sender: TObject);
    procedure Memo4Click(Sender: TObject);
    procedure ReplaceBClick(Sender: TObject);
    procedure ReplaceOnClick(Sender: TObject);
    procedure Panel79Click(Sender: TObject);
    procedure ReplaceMClick(Sender: TObject);
    procedure Panel84Click(Sender: TObject);
    procedure Panel85Click(Sender: TObject);
    procedure proPNGMouseEnter(Sender: TObject);
    procedure proPNGMouseLeave(Sender: TObject);
    procedure dataPNGMouseLeave(Sender: TObject);
    procedure dataPNGMouseEnter(Sender: TObject);
    procedure DoRKMouseEnter(Sender: TObject);
    procedure DoRKMouseLeave(Sender: TObject);
    procedure DoSPMouseEnter(Sender: TObject);
    procedure DoSPMouseLeave(Sender: TObject);
    procedure DoSPEnter(Sender: TObject);
    procedure DoSPExit(Sender: TObject);
    procedure DoSREnter(Sender: TObject);
    procedure DoSRExit(Sender: TObject);
    procedure DoSRMouseLeave(Sender: TObject);
    procedure DoSRMouseEnter(Sender: TObject);
    procedure ReplaceMDblClick(Sender: TObject);
    procedure CitySlicePNGClick(Sender: TObject);
    procedure TimeSlicePNGClick(Sender: TObject);
    procedure UTPsetPNGClick(Sender: TObject);
    procedure Panel88Click(Sender: TObject);
    procedure CTAchDblClick(Sender: TObject);
    procedure UTPchDblClick(Sender: TObject);
    procedure RadioButton1Click(Sender: TObject);
    procedure RadioButton2Click(Sender: TObject);
    procedure RadioButton3Click(Sender: TObject);
    procedure SliceTimeChClick(Sender: TObject);
    procedure Panel96Click(Sender: TObject);
    procedure SliceCityChClick(Sender: TObject);
    procedure AllCityClick(Sender: TObject);
    procedure CitiesChDblClick(Sender: TObject);
    procedure FastClearChClick(Sender: TObject);
    procedure DefoltSetClick(Sender: TObject);
    procedure RefreshCounterClick(Sender: TObject);
    procedure CitySlicePNGMouseLeave(Sender: TObject);
    procedure CitySlicePNGMouseEnter(Sender: TObject);
    procedure TimeSlicePNGMouseEnter(Sender: TObject);
    procedure TimeSlicePNGMouseLeave(Sender: TObject);
    procedure UTPsetPNGMouseLeave(Sender: TObject);
    procedure UTPsetPNGMouseEnter(Sender: TObject);
    procedure CTAsetPNGMouseEnter(Sender: TObject);
    procedure CTAsetPNGMouseLeave(Sender: TObject);
    procedure HideMinusCityClick(Sender: TObject);
    procedure WorkTimeDblClick(Sender: TObject);
    procedure Panel99Click(Sender: TObject);
    procedure Panel91Click(Sender: TObject);
    procedure CTAsetPNGClick(Sender: TObject);
    procedure FindProxyChClick(Sender: TObject);
    procedure ProxyEnablerTimer(Sender: TObject);
    procedure proxyPNGClick(Sender: TObject);
    procedure proxyPNGMouseEnter(Sender: TObject);
    procedure proxyPNGMouseLeave(Sender: TObject);
    procedure eyePNGDblClick(Sender: TObject);
    procedure GetTokenTimer(Sender: TObject);
    procedure GetMetrikaTimer(Sender: TObject);
    procedure BudgetTChange(Sender: TObject);
    procedure BudgetEChange(Sender: TObject);
    procedure BudgetEExit(Sender: TObject);
    procedure Button4Click(Sender: TObject);
    procedure GroupSelectorMClick(Sender: TObject);
    procedure AdsZagClick(Sender: TObject);
    procedure Panel105Click(Sender: TObject);
    procedure AdsZag2Click(Sender: TObject);
    procedure ReplaceZTZClick(Sender: TObject);
    procedure AdsTextClick(Sender: TObject);
    procedure Panel103Click(Sender: TObject);
    procedure AdsFast1Click(Sender: TObject);
    procedure AdsTimeWorkClick(Sender: TObject);
    procedure WorkTimeChange(Sender: TObject);
    procedure DeleteZTZClick(Sender: TObject);
    procedure OldZTZClick(Sender: TObject);
    procedure HideMinusIClick(Sender: TObject);
    procedure ReplaceZTZOneClick(Sender: TObject);
    procedure poiskClick(Sender: TObject);
    procedure ReplaceTSetEditText(Sender: TObject; ACol, ARow: integer;
      const Value: string);
    procedure ReplaceTExit(Sender: TObject);
    procedure ReplaceTSelectCell(Sender: TObject; ACol, ARow: integer;
      var CanSelect: boolean);
    procedure ReplaceTKeyUp(Sender: TObject; var Key: Word; Shift: TShiftState);
    procedure ReplaceTDblClick(Sender: TObject);
    procedure DaysClick(Sender: TObject);
    procedure MonthsClick(Sender: TObject);
    procedure ADSDblClick(Sender: TObject);
    procedure Panel36MouseDown(Sender: TObject; Button: TMouseButton;
      Shift: TShiftState; X, Y: integer);
    procedure Edit1Change(Sender: TObject);
    procedure Button5Click(Sender: TObject);
    procedure ReplaceTDragDrop(Sender, source: TObject; X, Y: integer);
    procedure ReplaceTMouseDown(Sender: TObject; Button: TMouseButton;
      Shift: TShiftState; X, Y: integer);
    procedure ReplaceTDragOver(Sender, source: TObject; X, Y: integer;
      State: TDragState; var Accept: boolean);
    procedure ReplaceTClick(Sender: TObject);
    procedure Panel78MouseDown(Sender: TObject; Button: TMouseButton;
      Shift: TShiftState; X, Y: integer);
    procedure Panel102MouseDown(Sender: TObject; Button: TMouseButton;
      Shift: TShiftState; X, Y: integer);
    procedure AdsRightMouseDown(Sender: TObject; Button: TMouseButton;
      Shift: TShiftState; X, Y: integer);
    procedure AdsRightContextPopup(Sender: TObject; MousePos: TPoint;
      var Handled: boolean);
    procedure GroupSelectorZMClick(Sender: TObject);
    procedure AdsRightZagsMouseDown(Sender: TObject; Button: TMouseButton;
      Shift: TShiftState; X, Y: integer);
    procedure AdsRightZags2MouseDown(Sender: TObject; Button: TMouseButton;
      Shift: TShiftState; X, Y: integer);
    procedure AdsRightZags2ContextPopup(Sender: TObject; MousePos: TPoint;
      var Handled: boolean);
    procedure AdsRightZagsContextPopup(Sender: TObject; MousePos: TPoint;
      var Handled: boolean);
    procedure Panel114Click(Sender: TObject);
    procedure Panel118Click(Sender: TObject);
    procedure regioClick(Sender: TObject);
    procedure SettingsMouseDown(Sender: TObject; Button: TMouseButton;
      Shift: TShiftState; X, Y: integer);
    procedure ReplaceTMouseMove(Sender: TObject; Shift: TShiftState;
      X, Y: integer);
    procedure ClearListPXClick(Sender: TObject);
    procedure ClearListBClick(Sender: TObject);
    procedure Button6Click(Sender: TObject);
    procedure AdsZagMouseDown(Sender: TObject; Button: TMouseButton;
      Shift: TShiftState; X, Y: integer);
    procedure AdsPreviewMouseDown(Sender: TObject; Button: TMouseButton;
      Shift: TShiftState; X, Y: integer);
    procedure AdsZag2MouseDown(Sender: TObject; Button: TMouseButton;
      Shift: TShiftState; X, Y: integer);
    procedure AdsTextMouseDown(Sender: TObject; Button: TMouseButton;
      Shift: TShiftState; X, Y: integer);
    procedure Panel116Click(Sender: TObject);
    procedure GroupSelectorZMContextPopup(Sender: TObject; MousePos: TPoint;
      var Handled: boolean);
    procedure GroupSelectorZMMouseDown(Sender: TObject; Button: TMouseButton;
      Shift: TShiftState; X, Y: integer);
    procedure Panel107Click(Sender: TObject);
    procedure GroupSelectorMContextPopup(Sender: TObject; MousePos: TPoint;
      var Handled: boolean);
    procedure GroupSelectorMMouseDown(Sender: TObject; Button: TMouseButton;
      Shift: TShiftState; X, Y: integer);
    procedure NewZTZChange(Sender: TObject);
    procedure ErrorZPClick(Sender: TObject);
    procedure CountControlClick(Sender: TObject);
    procedure DoSTChange(Sender: TObject);

  private
    { Private declarations }
    loaded, browbool, threebool, yabool, playbool, soundbool, proxybool,
      onebool, dobbool, changebool, rsybool, truepage, truefind, truenextpage, FirstT,
      rezhimautobool, closebool, fastclear, FindProxy, candocamp,
      whatdoT: boolean;
    login, password, id_user, id_prod, code, zag, zag2, yalog, yapas: string;
    client, token, imagename, metrika, fasts_id, lastprod, uniq,
      ext_id { , idsitelink, idvcard хранить в таблице } : string;
    // pagem:ustring;
    stage, iTimer, wc, w, wr, rsy_start, rsy_end, parent_start, parent_end,
      kont_end, kont_start, associate_i, k_word, lvl_start, lvl_end, perc_start,
      word_stat, { stage_camp, } strk, stlb, maxdlz1, maxdlz2, maxdltxt,
      rpls_col, rpls_row, proxy_n, XposT { , YposT } , i_metr, DelayAdd,
      AdsMaxLen, maxgroup, maxcamp, lvlentry: integer;
    base64str: AnsiString;
  public
    { Public declarations }
  end;

type
  TMyGrid = class(TCustomGrid);

const
  LineBreak = #13#10;
  ru: string = 'абвгдежзийклмнопрстуфхцчшщъыьэюя';
  en: string = 'abcdefghijklmnopqrstuvwxyz';
  zn: string = '.!?';

type
  THackStringList = class(TStringList);

type
  TElementNameVisitor = class(TCefDomVisitorOwn)
  private
    FName: string;
  protected
    procedure visit(const document: ICefDomDocument); override;
  public
    constructor Create(const AName: string); reintroduce;
  end;

type
  TObjs = class
    samozakr: boolean;
    parn: boolean;
    sloy: integer;
    name: string;
    innerTxt: string;
    param: string;
    parnI: TObjs;
    Constructor Create;
  end;

type
  TPars = class
    zakr: boolean;
    abc: array [0 .. 120] of string;
    obji: integer;
    sloy: integer;
    txt: string;
    objs: array of TObjs;
    Constructor Create(T: string);
    procedure Pars0;
    { function AddSloy(b:boolean; t:Tobjs):integer;
      function DelSloy(b:boolean; t:Tobjs):integer;
      function AddObj(b:boolean; t:Tobjs):integer;
      function DelObj(b:boolean; t:Tobjs):integer; }
  end;

var
  Form1: TForm1;
  first, nextbool, stavkabool, ctrbool, utpbool, ctabool, citybool, timebool,
    priblbool, da, auto, statControl, fastbool, Otsev, ClickLoadBool,
    SettingClickBool, newprodbool, ErrorLoadBool: boolean;
  next_i, iSp, word_i, word_ii, prekey_i, prekey_ii, adsright_i, adsright_ii,
    UTPs_i, CTAs_i, city_i, incity_i, time_i, rsy_i, sloy, sloy1, obji, objk,
    SP_i, st, rsy_np, pages_i, pre_i, ColRowsText, mca_i, mcm_i, camp_i, mod_s,
    mod_e, i_sin { ,PersClear }
    , rpls_col_count, changerI, group_i, vcard_i, ads_i: integer;
  SrCheckF, MarzhaF, K1F, K2F, K3F, LidsF, StavkaF, ClicksF, clicksperdayF,
    BudgetF, BudgetperdayF, ProgDohodF: real;
  Frst, Scnd: TMemo;
  stats: array [0 .. 50] of string;
  stats2: array [0 .. 50] of string;
  name: array [0 .. 50] of string;
  names: array [0 .. 50] of string;
  innerTxt: array [0 .. 50] of string;
  innerParam: array [0 .. 50] of string;
  Params: array [0 .. 50] of string;
  indx: array [0 .. 50] of integer;
  DecimalSeparator: Char;
  wordrsy, adstextword, rsy_parent, mResult, regions, regionsz, ext, adsurltext,
    camp_rzlt: string;
  koefrazb: real;
  SLSL: TStringList;
  Excel: variant;
  ExBook, ExSheet: variant;
  ParsObjs: TPars;
  sloys: array [0 .. 100] of integer;
  Days: array [0 .. 6] of string = (
    'пн',
    'вт',
    'ср',
    'чт',
    'пт',
    'сб',
    'вс'
  );

implementation

{$R *.dfm}
{ TDOMElementNameVisitor }

constructor TElementNameVisitor.Create(const AName: string);
begin
  inherited Create;
  FName := AName;
end;

procedure TElementNameVisitor.visit(const document: ICefDomDocument);

  procedure ProcessNode(ANode: ICefDomNode);
  var
    Node: ICefDomNode;
  begin
    ShowMessage('2');
    if Assigned(ANode) then
    begin
      Node := ANode.FirstChild;
      while Assigned(Node) do
      begin
        if Node.GetElementAttribute('name') = FName then
        begin
          // do what you need with the Node here
          ShowMessage(Node.GetElementAttribute('value'));
        end;
        ShowMessage(Node.GetElementAttribute('value'));
        ProcessNode(Node);
        Node := Node.NextSibling;
      end;
    end;
  end;

begin
  ShowMessage('1');
  ProcessNode(document.Body);
end;

constructor TObjs.Create;
begin
  parn := false;
  samozakr := false;
end;

constructor TPars.Create(T: string);
begin
  obji := 0;
  sloy := 0;
  txt := T;
  zakr := true;
  Pars0;
end;

procedure TPars.Pars0;
var
  i: integer;
  vr: string;
begin
  i := 3;
  vr := txt;
  vr := '<>' + txt + '</>';

  SetLength(objs, obji + 1);
  objs[obji] := TObjs.Create;

  objs[obji].name := '';
  objs[obji].innerTxt := '';
  objs[obji].param := '';
  while i < length(vr) - 1 do
  begin
    if not zakr then
    begin
      objs[obji].name := '';
      objs[obji].innerTxt := '';
      objs[obji].param := '';
      if objs[obji].samozakr then
      begin
        inc(i);
        while (vr[i] <> ' ') or (vr[i] <> '>') do
        begin
          if (vr[i] = '>') then
          begin
            if objs[obji].samozakr then
            begin
              if (objs[obji - 1].samozakr) then
                dec(sloy);
            end;
            objs[obji].sloy := sloy;
            zakr := true;
            break;
          end
          else if (vr[i] = ' ') then
          begin
            break;
          end;
          objs[obji].name := objs[obji].name + vr[i];
          inc(i);
        end;
      end
      else
      begin
        while (vr[i] <> ' ') or (vr[i] <> '>') do
        begin
          if (vr[i] = '>') then
          begin
            if objs[obji].samozakr then
            begin
              if (Not objs[obji - 1].samozakr) then
                inc(sloy);
            end;
            objs[obji].sloy := sloy;
            zakr := true;
            break;
          end
          else if (vr[i] = ' ') then
          begin
            break;
          end;
          objs[obji].name := objs[obji].name + vr[i];
          inc(i);
        end;
      end;

      if not zakr then
      begin
        inc(i);
        while (vr[i] <> '/') or (vr[i] <> '>') do
        begin
          if (vr[i] = '<') or (vr[i] = '>') then
          else
            objs[obji].param := objs[obji].param + vr[i];
          inc(i);
          if (vr[i] = '>') then
          begin
            if objs[obji].samozakr then
            begin
              if (objs[obji - 1].samozakr) then
                dec(sloy);
            end
            else if Not objs[obji].samozakr then
            begin
              if (Not objs[obji - 1].samozakr) then
                inc(sloy);
            end;
            objs[obji].sloy := sloy;
            zakr := true;
            break;
          end;
        end;
      end;
    end;

    if zakr then
    begin
      while vr[i] <> '<' do
      begin
        if (vr[i] = '<') then
          break
        else
        begin
          inc(i);
          if (vr[i] = '<') then
            break;
          objs[obji].innerTxt := objs[obji].innerTxt + vr[i];
        end;
      end;
      zakr := false;
      inc(obji);
      SetLength(objs, obji + 1);
      objs[obji] := TObjs.Create;
      inc(i);
      if vr[i] = '/' then
        objs[obji].samozakr := true
      else
        objs[obji].samozakr := false;
    end;
  end;
end;

procedure openfile;
var
  cmdLine, FName: {$IFDEF WIDE}WideString{$ELSE}string{$ENDIF};
  si: TStartupInfo;
  // pi: TProcessInformation;
begin
  cmdLine := 'c:\program.exe';
  // полный путь до программы, которой хотим открыть файл
  FName := 'с:\text.txt'; // полный путь до файла

  FillChar(si, SizeOf(si), #0);
  with si do
  begin
    cb := SizeOf(si);
    dwFlags := STARTF_USESHOWWINDOW;
    wShowWindow := SW_SHOW;
  end;

  (* if {$ifdef WIDE}CreateProcessW{$else}CreateProcessA{$endif}(
    nil, // lpApplicationName,
    {$ifdef WIDE}pWideChar{$else}pChar{$endif}(cmdLine + fName), // lpCommandLine,
    nil, // lpProcessAttributes,
    nil, // lpThreadAttributes,
    True, // bInheritHandles,
    0, // dwCreationFlags
    nil, // lpEnvironment,
    nil, // lpCurrentDirectory,
    si, // lpStartupInfo,
    pi) then begin // lpProcessInformation
    WaitForSingleObject(pi.hProcess, INFINITE);
    CloseHandle(pi.hProcess);
    end; *)
end;

function wait(ms: integer): boolean;
var
  i: integer;
  procedure addmsec;
  begin
    sleep(100);
  end;

begin
  i := 0;
  while i < ms do
  begin
    Application.ProcessMessages;
    addmsec;
    inc(i);
  end;
  Result := true;
end;

function ExecuteFile(const FileName, Params, DefaultDir: string;
  ShowCmd: integer): THandle;
begin
  Result := ShellExecute(Application.MainForm.Handle, nil, PChar(FileName),
    PChar(Params), PChar(DefaultDir), ShowCmd);
end;

function TForm1.GetSerialMotherBoard: String;
var
  a, b, c, d: LongWord;
begin
  asm
    push EAX
    push EBX
    push ECX
    push EDX

    mov eax, 1
    db $0F, $A2
    mov a, EAX
    mov b, EBX
    mov c, ECX
    mov d, EDX

    pop EDX
    pop ECX
    pop EBX
    pop EAX

  end;
  Result := inttohex(a, 8) + '-' + inttohex(b, 8) + '-' + inttohex(c, 8) + '-' +
    inttohex(d, 8);
end;

function TForm1.DownloadFile(aIdHTTP: TIdHTTP; aUrl: string;
  aFileName: string): boolean;
var
  AStream: TMemoryStream;
begin
  AStream := TMemoryStream.Create;
  try
    aIdHTTP.Get(aUrl, AStream);

    AStream.SaveToFile(aFileName);
    Result := true;
  except
    Result := false;
    Application.HandleException(Self);
  end;
  AStream.Free;
end;

procedure TForm1.GetTokenTimer(Sender: TObject);
var
  CodeStr: string;
begin
  if iTimer = 1 then
    if Assigned(BRReg.Browser) and Assigned(BRReg.Browser.Mainframe) then
    begin
      CodeStr := '$("#nb-2").click();';
      BRReg.Browser.Mainframe.ExecuteJavaScript(CodeStr, 'about:blank', 0);
    end;
  if iTimer = 3 then
    if Assigned(BRReg.Browser) and Assigned(BRReg.Browser.Mainframe) then
    begin
      CodeStr :=
        'console.log("tk "+$(".js-verification-code-flow-token-output").text());';
      BRReg.Browser.Mainframe.ExecuteJavaScript(CodeStr, 'about:blank', 0);
    end;
  inc(iTimer);
  if iTimer = 4 then
  begin
    Finality.Enabled := true;
    GetToken.Enabled := false;
  end;
end;

procedure ObjCentredW(Sender: TControl; l_offset: integer);
begin
  Sender.Left := Round((Screen.Width - Sender.Width - l_offset) div 2);
end;

procedure ObjCentredH(Sender: TControl; t_offset: integer);
begin
  Sender.Top := Round((Screen.Height - Sender.Height - t_offset) / 2);
end;

{ procedure ObjCentredH(Sender: TControl; t_offset: integer; parent: boolean) overload;
  begin
  Sender.Top := Round((Sender.Parent.Height - Sender.Height - t_offset) / 2);
  end; }

procedure ObjCentred(Sender: TControl; l_offset, t_offset: integer);
begin
  ObjCentredW(Sender, l_offset);
  ObjCentredH(Sender, t_offset);
end;

{ procedure ObjCentred(Sender: TControl; l_offset, t_offset: integer; Parent: boolean) overload;
  begin
  ObjCentredW(Sender, l_offset);
  ObjCentredH(Sender, t_offset);
  end; }

procedure ObjShow(Sender: TControl);
begin
  Sender.Visible := true;
  Sender.BringToFront;
end;

procedure ObjHide(Sender: TControl);
begin
  Sender.Visible := false;
end;

function SerialTrue(Serial1, Serial2: string): boolean;
var
  b: boolean;
  v11, v12, v21, v22: string;
begin
  b := false;
  if AnsiCompareText(Serial1, Serial2) = 0 then
    b := true
  else
  begin
    v11 := Copy(Serial1, 1, 10);
    v12 := Copy(Serial1, 12, 24);
    v21 := Copy(Serial2, 1, 10);
    v22 := Copy(Serial2, 12, 24);
    if (AnsiCompareText(v11, v21) = 0) AND (AnsiCompareText(v12, v22) = 0) then
      b := true;
  end;
  SerialTrue := b;
end;

function IsOLEObjectInstalled(name: String): boolean;
var
  ClassID: TCLSID;
begin
  Result := CLSIDFromProgID(PWideChar(WideString(Name)), ClassID) = S_OK;
end;

function SetSystemProxy(host: string; port: string): boolean;
const
  INTERNET_PER_CONN_FLAGS = 1;
  PROXY_TYPE_PROXY = $00000002;
  INTERNET_PER_CONN_PROXY_BYPASS = 3;
  INTERNET_PER_CONN_PROXY_SERVER = 2;
  INTERNET_OPTION_PER_CONNECTION_OPTION = 75;
  PROXY_TYPE_DIRECT = $00000001;

type
  INTERNET_PER_CONN_OPTION = record
    dwOption: DWORD;

    Value: record
      case integer of
        1:
          (dwValue: DWORD);
        2:
          (pszValue: PChar); { Unicode/ANSI }
        3:
          (ftValue: TFileTime);
    end;
  end;

  LPINTERNET_PER_CONN_OPTION = ^INTERNET_PER_CONN_OPTION;

  INTERNET_PER_CONN_OPTION_List = record
    dwSize: DWORD;
    pszConnection: LPTSTR;
    dwOptionCount: DWORD;
    dwOptionError: DWORD;
    intOptions: LPINTERNET_PER_CONN_OPTION;
  end;

  LPINTERNET_PER_CONN_OPTION_List = ^INTERNET_PER_CONN_OPTION_List;

var
  list: INTERNET_PER_CONN_OPTION_List;
  dwBufSize: DWORD;
  hInternet: Pointer;
  Options: array [1 .. 3] of INTERNET_PER_CONN_OPTION;

begin
  Result := false;
  dwBufSize := SizeOf(list);
  list.dwSize := SizeOf(list);
  list.pszConnection := nil;
  list.dwOptionCount := High(Options);

  Options[1].dwOption := INTERNET_PER_CONN_FLAGS;

  Options[2].dwOption := INTERNET_PER_CONN_PROXY_SERVER;
  if (host = '') or (port = '') then
  begin
    Options[1].Value.dwValue := PROXY_TYPE_DIRECT;
    Options[2].Value.pszValue := PChar('');
  end
  else
  begin
    Options[1].Value.dwValue := PROXY_TYPE_PROXY;
    Options[2].Value.pszValue := PChar(host + ':' + port);
  end;

  Options[3].dwOption := INTERNET_PER_CONN_PROXY_BYPASS;
  Options[3].Value.pszValue := PChar('');

  list.intOptions := @Options;
  hInternet := InternetOpen(PChar(''), INTERNET_OPEN_TYPE_DIRECT, nil, nil, 0);
  if hInternet <> nil then
    try
      Result := InternetSetOption(nil, INTERNET_OPTION_PER_CONNECTION_OPTION,
        @list, dwBufSize);
      Result := Result and InternetSetOption(nil,
        INTERNET_OPTION_REFRESH, nil, 0);
    finally
      InternetCloseHandle(hInternet)
    end;
end;

procedure UrlFromProxy(Chrom: TChromium; url, ip, port: string);
begin
  SetSystemProxy(ip, port);
  Chrom.Refresh;
  sleep(3000);
  Chrom.Load(url);
end;

procedure TForm1.HideMemos;
begin
  Minuss.Visible := false;
  Cities.Visible := false;
  MyMinuss.Visible := false;
  PreKey.Visible := false;
  PreKeyRSY.Visible := false;
  KeyCollector.Visible := false;
  MyKey.Visible := false;
  AdsRightZags.Visible := false;
  AdsRightZags2.Visible := false;
  AdsRight.Visible := false;
  LocalMinus.Visible := false;
end;

procedure TForm1.HideMenuClick(Sender: TObject);
begin
  if poisk.Visible then
  begin
    poisk.Visible := false;
    rsy2.Visible := false;
    ReplaceT.Visible := false;
  end
  else
  begin
    HideMemos;
    poisk.Visible := true;
    poisk.Width := Round(Screen.Width / 3);
    rsy2.Visible := true;
    rsy2.Width := Round(Screen.Width / 3) - 40;
    ReplaceT.Visible := true;
    ReplaceT.Width := Round(Screen.Width / 3) - 40;
  end;
end;

procedure TakeList(Memo: TMemo; SG: TStringGrid; col: integer);
var
  i: integer;
  SL: TStringList;
begin
  SL := TStringList.Create;
  SL.Text := '';
  for i := 0 to SG.RowCount - 1 do
  begin
    // if SG.Cells[5, i] = '1' then
    if SG.Cells[3, i] = '1' then
      SL.Add(SG.Cells[col, i]); // SG.Cells[0, i]+' '+
    if i mod 25 = 0 then
      Application.ProcessMessages;
  end;
  Memo.Text := SL.Text;
  FreeAndNil(SL);
end;

function wasstrfullT32(Word: string; SG: TStringGrid; col: integer;
  s, n: integer): boolean;
// фразу, где, колонка, с какой строки, до какой строки
var
  i: integer;
  vr: boolean;
begin
  vr := false;
  for i := s to n - 1 do
  begin
    if AnsiCompareText(Word, SG.Cells[col, i]) = 0 then
    begin
      vr := true;
      break;
    end;
    if i mod 25 = 0 then
      Application.ProcessMessages;
  end;
  wasstrfullT32 := vr;
end;

function wasstrfullT3(Word: string; SG: TStringGrid; col: integer;
  s, n: integer): boolean;
// фразу, где, колонка, с какой строки, до какой строки
var
  i: integer;
  vr: boolean;
begin
  vr := false;
  for i := s to n - 1 do
  begin
    if SG.Cells[5, i] = '1' then
      if AnsiCompareText(Word, SG.Cells[col, i]) = 0 then
      begin
        vr := true;
        break;
      end;
    if i mod 25 = 0 then
      Application.ProcessMessages;
  end;
  wasstrfullT3 := vr;
end;

function wasstrposT(Word: string; SG: TStringGrid; col: integer): integer;
// фразу, где, сколько строк
var
  // sl, SL2: TStringList;
  // i, l, k, chet, dl1, dl2, vr: integer;
  i, vr: integer;
  // so: array [0 .. 20] of integer;
  // stri2: string;
begin
  vr := -1;
  for i := 0 to SG.RowCount - 1 do
  begin
    if (AnsiPos(Word, SG.Cells[col, i]) > 0) then
    begin
      vr := i;
    end;
  end;
  wasstrposT := vr;
end;

function wasstrposTG(Word: string; SG: TStringGrid;
  col, max, n: integer): integer;
// фразу, где, сколько строк
var
  // sl, SL2: TStringList;
  // i, l, k, chet, dl1, dl2, vr: integer;
  i, vr: integer;
  // so: array [0 .. 20] of integer;
  // stri2: string;
begin
  vr := -1;
  for i := 0 to SG.RowCount - 1 do
  begin
    if (AnsiPos(Word, SG.Cells[col, i]) > 0) and
      (strtoint(SG.Cells[4, i]) < max) and (strtoint(SG.Cells[3, i]) = n) then
    begin
      vr := i;
      break;
    end;
  end;
  wasstrposTG := vr;
end;

function wasstrposTGR(Word: string; SG: TStringGrid;
  col, max, n: integer): integer;
// фразу, где, сколько строк
var
  // sl, SL2: TStringList;
  // i, l, k, chet, dl1, dl2, vr: integer;
  i, vr: integer;
  // so: array [0 .. 20] of integer;
  // stri2: string;
begin
  vr := -1;
  for i := 0 to SG.RowCount - 1 do
  begin
    if (AnsiPos(Word, SG.Cells[col, i]) > 0) and
      (strtoint(SG.Cells[4, i]) <= max) and (strtoint(SG.Cells[3, i]) = n) then
    begin
      vr := i;
      break;
    end;
  end;
  wasstrposTGR := vr;
end;

function Slov(fraza: string): integer;
var
  ii, pr: integer;
begin
  pr := 0;
  if length(fraza) > 2 then
  begin
    for ii := 2 to length(fraza) - 1 do
      if (fraza[ii] = ' ') and (fraza[ii + 1] <> ' ') then
        pr := pr + 1;
    Slov := pr + 1;
  end
  else if length(fraza) = 0 then
    Slov := 0
  else
    Slov := 1;
end;

function wasstrfull(Word: string; Memo: TStrings; n: integer): integer;
// фразу, где, сколько строк
var
  SL, SL2: TStringList;
  i, l, k, chet, dl1, dl2, vr: integer;
  so: array [0 .. 20] of integer;
  stri2: string;
begin
  vr := -1;
  SL := TStringList.Create;
  SL.Text := StringReplace(Word, ' ', #13#10, [rfReplaceAll]);
  dl1 := SL.Count;
  for i := 0 to n - 1 do
  begin
    for k := 0 to 19 do
      so[k] := 0; // sovpadeniya

    stri2 := Memo.Strings[i];
    dl2 := Slov(stri2);
    SL2 := TStringList.Create;
    SL2.Text := StringReplace(stri2, ' ', #13#10, [rfReplaceAll]);
    chet := 0;
    if dl1 = dl2 then
    begin
      for l := 0 to dl1 - 1 do
      begin
        for k := 0 to dl2 - 1 do
          if (AnsiCompareStr(SL[l], SL2[k]) = 0) then
          begin
            so[l] := 1;
          end
      end;

      for l := 0 to dl1 - 1 do
        chet := chet + so[l];

      if chet = dl2 then
      begin
        vr := i;
        FreeAndNil(SL2);
        break;
      end;
    end;
    FreeAndNil(SL2);
  end;

  FreeAndNil(SL);
  wasstrfull := vr;
end;

function NoPlusString(stri: String): string;
var
  vr: string;
begin
  vr := StringReplace(stri, '+', '', [rfReplaceAll]);
  NoPlusString := vr;
end;

function wasstrfullT(Word: string; SG: TStringGrid; col: integer; n: integer)
  : integer; // фразу, где, колонка, сколько строк
var
  SL, SL2: TStringList;
  i, l, k, chet, dl1, dl2, vr: integer;
  so: array [0 .. 20] of integer;
  stri2: string;
begin
  vr := -1;
  SL := TStringList.Create;
  SL.Text := StringReplace(Word, ' ', #13#10, [rfReplaceAll]);
  dl1 := SL.Count;
  for i := 0 to n - 1 do
  begin
    for k := 0 to 19 do
      so[k] := 0; // sovpadeniya

    stri2 := NoPlusString(SG.Cells[col, i]);
    dl2 := Slov(stri2);
    SL2 := TStringList.Create;
    SL2.Text := StringReplace(stri2, ' ', #13#10, [rfReplaceAll]);
    chet := 0;
    if dl1 = dl2 then
    begin
      for l := 0 to dl1 - 1 do
      begin
        for k := 0 to dl2 - 1 do
          if (AnsiCompareStr(SL[l], SL2[k]) = 0) then
          begin
            so[l] := 1;
          end
      end;

      for l := 0 to dl1 - 1 do
        chet := chet + so[l];

      if chet = dl2 then
      begin
        vr := i;
        FreeAndNil(SL2);
        break;
      end;
    end;
    FreeAndNil(SL2);
  end;
  FreeAndNil(SL);
  wasstrfullT := vr;
end;

procedure TakeListnoDup(Memo, Memo2: TMemo; SG: TStringGrid; col: integer);
var
  i: integer;
  SL, SL2: TStringList;
begin
  SL := TStringList.Create;
  SL2 := TStringList.Create;
  SL.Text := '';
  SL2.Text := '';
  for i := 0 to SG.RowCount - 1 do
  begin
    if SG.Cells[5, i] = '1' then
    begin
      if not wasstrfullT3(SG.Cells[col, i], SG, col, 0, i - 1) then
      begin
        if SL.Count > 1 then
        begin
          if wasstrfull(SG.Cells[col, i], SL, SL.Count - 1) = -1 then
          begin
            SL.Add(SG.Cells[col, i]);
            SL2.Add(inttostr(i));
          end;
        end
        else
        begin
          SL.Add(SG.Cells[col, i]);
          SL2.Add(inttostr(i));
        end;
      end;
    end;
    if i mod 25 = 0 then
    begin
      Application.ProcessMessages;
      Memo.Text := SL.Text;
      Memo2.Text := SL2.Text;
    end;
  end;
  Memo.Text := SL.Text;
  Memo2.Text := SL2.Text;
  FreeAndNil(SL);
  FreeAndNil(SL2);
end;

procedure TakeListByWord(Memo, Memo2: TMemo; SG: TStringGrid; col: integer;
  s: string);
var
  i: integer;
  SL, SL2: TStringList;
begin
  SL := TStringList.Create;
  SL.Text := '';
  SL2 := TStringList.Create;
  SL2.Text := '';
  for i := 0 to SG.RowCount - 1 do
  begin
    if (SG.Cells[5, i] = '1') and (AnsiPos(s, SG.Cells[col, i]) > 0) then
    begin
      SL.Add(SG.Cells[col, i]);
      SL2.Add(inttostr(i));
    end;
    if i mod 25 = 0 then
      Application.ProcessMessages;
  end;
  Memo.Text := SL.Text;
  Memo2.Text := SL2.Text;
  FreeAndNil(SL);
  FreeAndNil(SL2);
end;

function SlovoChislo(stri: string): boolean;
begin
  try
    strtoint(stri);
    SlovoChislo := true;
  except
    SlovoChislo := false;
  end;
end;

function SlovoVChislo(stri: string): integer;
begin
  if SlovoChislo(stri) then
    SlovoVChislo := strtoint(stri)
  else
    SlovoVChislo := null;
end;

function chislovstr(chislo: integer; stri: string): boolean;
var
  i: integer;
  SL: TStringList;
  b: boolean;
begin
  b := false;
  SL := TStringList.Create;
  SL.Text := StringReplace(stri, ' ', #13#10, [rfReplaceAll]);
  for i := 0 to SL.Count - 1 do
  begin
    if SlovoChislo(SL.Strings[i]) then
      b := true;
  end;
  FreeAndNil(SL);
  chislovstr := b;
end;

function DelSpace(stri: string): string; // убирает лишние пробелы
var
  vr: string;
begin
  vr := stri;
  if vr.length > 2 then
  begin
    if vr[1] = ' ' then
      Delete(vr, 1, 1);
    if vr[length(vr)] = ' ' then
      Delete(vr, length(vr), 1);
    while AnsiPos('  ', vr) > 0 do
      vr := StringReplace(vr, '  ', ' ', [rfReplaceAll]);
  end;
  DelSpace := vr;
end;

procedure LoadPNGfromRes(i: TImage; name: string);
var
  PNG: TPngImage;
begin
  PNG := TPngImage.Create;
  try
    i.Picture := nil;
    PNG.LoadFromResourceName(HInstance, name);
    i.Picture.Assign(PNG);
  finally
    PNG.Free;
  end;
end;

procedure CurPosEnd(E: TEdit);
begin
  E.SetFocus;
  E.SelStart := length(E.Text);
  E.SelLength := 0;
end;

procedure GroupSelector(GroupSelectorM, GroupSelectorMI: TMemo; SG: TStringGrid;
  col: integer);
var
  i: integer;
  SL, SL2: TStringList;
begin
  SL := TStringList.Create;
  SL2 := TStringList.Create;
  for i := 0 to SG.RowCount - 1 do
  begin
    if i > 0 then
    begin
      if not wasstrfullT32(SG.Cells[col, i], SG, col, 0, i - 1) then
      begin
        SL.Add(SG.Cells[col, i]);
        SL2.Add(inttostr(i))
      end;
    end
    else
    begin
      if SG.Cells[5, i] = '1' then
      begin
        SL.Add(SG.Cells[col, i]);
        SL2.Add(inttostr(i));
      end;
    end;
    if i mod 20 = 0 then
      Application.ProcessMessages;
  end;
  GroupSelectorM.Text := SL.Text;
  GroupSelectorMI.Text := SL2.Text;
  FreeAndNil(SL);
  FreeAndNil(SL2);
end;

function WordInStr(w: string; s: string): boolean;
var
  SL: TStringList;
  i: integer;
  b: boolean;
begin
  b := false;
  SL := TStringList.Create();
  SL.Text := StringReplace(s, ' ', #13#10, [rfReplaceAll]);
  for i := 0 to SL.Count - 1 do
    if AnsiCompareText(AnsiLowerCase(w), AnsiLowerCase(SL[i])) = 0 then
      b := true;
  FreeAndNil(SL);
  WordInStr := b;
end;

procedure GroupSelectorByWord(GroupSelectorM, GroupSelectorMI: TMemo;
  SG: TStringGrid; col: integer; s: TStrings);
var
  i: integer;
  SL, SL2: TStringList;
  j: integer;
begin
  SL := TStringList.Create;
  SL2 := TStringList.Create;
  for i := 0 to SG.RowCount - 1 do
  begin
    if SG.Cells[5, i] = '1' then
    begin
      for j := 0 to s.Count - 1 do
      begin
        if WordInStr(s.Strings[j], SG.Cells[col, i]) then
        begin
          SL.Add(SG.Cells[col, i]);
          SL2.Add(inttostr(i));
        end;
      end;
    end;
    if i mod 20 = 0 then
      Application.ProcessMessages;
  end;
  GroupSelectorM.Text := SL.Text;
  GroupSelectorMI.Text := SL2.Text;
  FreeAndNil(SL);
  FreeAndNil(SL2);
end;

procedure GroupSelectorByStr(GroupSelectorM, GroupSelectorMI: TMemo;
  SG: TStringGrid; col, col2: integer; s: string);
var // col = gre sravnivaem, col2 = otkuda sobiraem
  i: integer;
  SL, SL2: TStringList;
begin
  SL := TStringList.Create;
  SL2 := TStringList.Create;
  for i := 0 to SG.RowCount - 1 do
  begin
    if SG.Cells[5, i] = '1' then
    begin
      if AnsiCompareText(s, SG.Cells[col, i]) = 0 then
      begin
        SL.Add(SG.Cells[col2, i]);
        SL2.Add(inttostr(i));
      end;
    end;
    if i mod 20 = 0 then
      Application.ProcessMessages;
  end;
  GroupSelectorM.Text := SL.Text;
  GroupSelectorMI.Text := SL2.Text;
  FreeAndNil(SL);
  FreeAndNil(SL2);
end;

function ListToStr(const SL: TStringList): string;
var
  stri: string;
  i: integer;
begin
  stri := '';
  if SL.Count > 0 then
  begin
    for i := 0 to SL.Count - 1 do
    begin
      if stri = '' then
        stri := SL.Strings[i]
      else
        stri := stri + ' ' + SL.Strings[i];
    end;
  end;
  stri := DelSpace(stri);
  ListToStr := stri;
end;

function ListToStrD(const SL: TStringList; d: string): string;
var
  stri: string;
  i: integer;
begin
  stri := '';
  if SL.Count > 0 then
  begin
    for i := 0 to SL.Count - 1 do
    begin
      if stri = '' then
        stri := SL.Strings[i]
      else
        stri := stri + d + SL.Strings[i];
    end;
  end;
  stri := DelSpace(stri);
  ListToStrD := stri;
end;

function DelWordInStr(w: string; s: string): string;
var
  SL: TStringList;
  i: integer;
  vr: string;
begin
  vr := s;
  SL := TStringList.Create();
  SL.Text := StringReplace(vr, ' ', #13#10, [rfReplaceAll]);
  for i := 0 to SL.Count - 1 do
    if AnsiCompareText(AnsiLowerCase(w), AnsiLowerCase(SL[i])) = 0 then
    begin
      SL[i] := '';
    end;

  vr := ListToStr(SL);
  FreeAndNil(SL);
  DelWordInStr := vr;
end;

function DelWordInStrPos(w: string; s: string): string;
var
  SL: TStringList;
  k: integer;
  vr: string;
begin
  vr := s;

  if AnsiPos(AnsiLowerCase(w), AnsiLowerCase(vr)) > 0 then
  begin
    SL := TStringList.Create;
    SL.Text := StringReplace(vr, ' ', #13#10, [rfReplaceAll]);
    for k := 0 to SL.Count - 1 do
    begin
      if AnsiPos(AnsiLowerCase(w), AnsiLowerCase(SL[k])) > 0 then
        SL[k] := '';
    end;
    vr := ListToStr(SL);
    FreeAndNil(SL);
  end;

  DelWordInStrPos := vr;
end;

procedure TForm1.DelStrInSG(strn: string; table: TStringGrid; stl: integer);
var
  i: integer;
begin
  for i := 0 to table.RowCount - 1 do
  begin
    if AnsiCompareText(strn, table.Cells[stl, i]) = 0 then
      DeleteARow(table, i);
    if i mod 25 = 0 then
      Application.ProcessMessages;
  end;
end;

function TForm1.Pohozhest(fraza: string; fraza2: string; sov: integer;
  const dlsl: integer): boolean; // проверяет похожесть слов
var
  i, j, { dc, maxdc, } kb, w, vrdl: integer;
  so: array [0 .. 20] of integer;
  vr: string;
  // b, nach: boolean;
  { sp, } ss1: real;
begin
  if fraza.length > fraza2.length then
  begin
    vr := fraza;
    fraza := fraza2;
    fraza2 := vr;
  end;
  fraza := AnsiLowerCase(fraza);
  fraza2 := AnsiLowerCase(fraza2);
  for i := 0 to 19 do
    so[i] := 0;

  if fraza.length < 3 then
  begin
    if AnsiCompareText(fraza, fraza2) = 0 then
      Pohozhest := true
    else
      Pohozhest := false;
  end
  else
  begin
    vrdl := 2 + fraza.length div 3;

    for i := 1 to fraza.length - vrdl + 2 do
    begin
      vr := '';
      for j := i to i + vrdl - 2 do
      begin
        if vr = '' then
          vr := fraza[j]
        else
          vr := vr + fraza[j];
      end;
      if AnsiPos(vr, fraza2) = i then
      begin
        so[i] := Round(1 / i * 10);
      end;
    end;

    if so[1] = 0 then
      Pohozhest := false
    else
    begin
      kb := 0;
      w := 0;
      for j := 1 to fraza.length - vrdl + 2 do
        if so[j] <> 0 then
        begin
          inc(kb);
          w := w + so[j];
        end;

      ss1 := kb * w / (Abs(fraza2.length - fraza.length) + 1) /
        (Abs(fraza.length - vrdl) + 1) * 10;
      if (ss1 > sov) then
      begin
        Pohozhest := true;
      end
      else
        Pohozhest := false;
    end;
  end;
end;

function TForm1.WordInStrP(w: string; s: string; sov: integer;
  dlsl: integer): boolean;
var
  SL: TStringList;
  i: integer;
  b: boolean;
begin
  b := false;
  SL := TStringList.Create();
  SL.Text := StringReplace(s, ' ', #13#10, [rfReplaceAll]);
  for i := 0 to SL.Count - 1 do
    if Pohozhest(w, SL[i], sov, dlsl) then
      b := true;
  FreeAndNil(SL);
  WordInStrP := b;
end;

function TForm1.DelWordInStrP(const w, s: string; sov: integer;
  dlsl: integer): string;
var
  SL: TStringList;
  i: integer;
  vr: string;
begin
  vr := s;
  SL := TStringList.Create();
  SL.Text := StringReplace(vr, ' ', #13#10, [rfReplaceAll]);
  for i := 0 to SL.Count - 1 do
    if Pohozhest(w, SL[i], sov, dlsl) then
    begin
      SL[i] := '';
    end;

  vr := '';
  for i := 0 to SL.Count - 1 do
    if vr = '' then
      vr := SL[i]
    else
      vr := vr + ' ' + SL[i];
  vr := DelSpace(vr);
  FreeAndNil(SL);
  DelWordInStrP := vr;
end;

procedure Slova(Memo, Memo2: TMemo; T: TProgressBar);
var
  s, SL, SL2: TStringList;
  i: integer;
begin
  SL := TStringList.Create;
  SL.Text := Memo.Text;

  SL2 := TStringList.Create;
  SL2.Duplicates := dupIgnore;
  SL2.Sorted := true;
  SL2.Text := '';
  T.max := SL.Count - 1;
  for i := 0 to SL.Count - 1 do
  begin
    s := TStringList.Create;
    s.Text := StringReplace(SL.Strings[i], ' ', #13#10, [rfReplaceAll]);
    SL2.Text := SL2.Text + s.Text;
    FreeAndNil(s);
    T.Position := i;
    if i mod 10 = 0 then
    begin

      Application.ProcessMessages;
    end;
  end;
  Memo2.Text := SL2.Text;
  FreeAndNil(SL);
  FreeAndNil(SL2);
end;

function RplsWordStr(w, r, s: string): string;
var
  SL: TStringList;
  i: integer;
begin
  SL := TStringList.Create;
  SL.Text := StringReplace(s, ' ', #13#10, [rfReplaceAll]);
  for i := 0 to SL.Count - 1 do
  begin
    if AnsiCompareText(w, SL[i]) = 0 then
      SL[i] := r;
  end;
  RplsWordStr := ListToStr(SL);
  FreeAndNil(SL)
end;

procedure TForm1.ReplaceTClick(Sender: TObject);
var
  i, ii: integer;
begin
  for i := 0 to ReplaceT.RowCount - 1 do
    for ii := 0 to ReplaceT.ColCount - 1 do
      if ReplaceT.ColWidths[ii] < ReplaceT.Canvas.TextWidth
        (ReplaceT.Cells[ii, i] + ' ') then
        ReplaceT.ColWidths[ii] := ReplaceT.Canvas.TextWidth
          (ReplaceT.Cells[ii, i] + ' ');
end;

function AbsString(stri: String): string;
var
  SL2: TStringList;
  vr: string;
  i: integer;
begin
  SL2 := TStringList.Create;
  SL2.Sorted := true;
  SL2.Duplicates := dupIgnore;
  SL2.Text := StringReplace(stri, ' ', #13#10, [rfReplaceAll]);

  vr := '';
  for i := 0 to SL2.Count - 1 do
    if vr <> '' then
      vr := vr + ' ' + SL2[i]
    else
      vr := SL2[i];
  FreeAndNil(SL2);
  AbsString := vr;
end;

procedure TForm1.ReplaceTDblClick(Sender: TObject);
var
  i, j, n: integer;
  vr, vr2: string;
  SL: TStringList;
begin
  vr2 := ReplaceT.Cells[ReplaceT.col, ReplaceT.Row];
  n := ReplaceT.Row;
  if vr2 <> '' then
  begin
    if ReplaceT.col <> 0 then
    begin
      vr := ReplaceT.Cells[0, ReplaceT.Row];
      for i := 0 to poisk.RowCount - 1 do
      begin
        if WordInStr(vr2, poisk.Cells[2, i]) then
        begin
          poisk.Cells[4, i] :=
            AbsString(RplsWordStr(vr, vr2, poisk.Cells[4, i]));
        end;
      end;
      j := ReplaceT.col;
      while ReplaceT.Cells[j + 1, ReplaceT.Row] <> '' do
      begin
        ReplaceT.Cells[j, ReplaceT.Row] := ReplaceT.Cells[j + 1, ReplaceT.Row];
        inc(j);
      end;
      ReplaceT.Cells[j, ReplaceT.Row] := '';
      ReplaceT.RowCount := ReplaceT.RowCount + 1;
      ReplaceT.Cells[0, ReplaceT.RowCount - 2] := vr2;
    end
    else
    begin
      if ReplaceT.Cells[1, ReplaceT.Row] = '' then
      begin
        ClearList.Lines.Add(vr2);
        ReplaceT.Cells[ReplaceT.col, ReplaceT.Row] := '';
        DeleteARow(ReplaceT, ReplaceT.Row);
        ReplaceT.Row := n;
        ObjShow(ClearListP);
      end
      else
      begin
        SL := TStringList.Create;
        vr := ReplaceT.Cells[0, ReplaceT.Row];
        j := 1;
        while ReplaceT.Cells[j, ReplaceT.Row] <> '' do
        begin
          vr2 := ReplaceT.Cells[j, ReplaceT.Row];
          for i := 0 to poisk.RowCount - 1 do
          begin
            if WordInStr(vr2, poisk.Cells[2, i]) then
            begin
              if WordInStr(vr, poisk.Cells[2, i]) then
                poisk.Cells[4, i] :=
                  AbsString(RplsWordStr(vr, vr2 + ' ' + vr, poisk.Cells[4, i]))
              else
                poisk.Cells[4, i] :=
                  AbsString(RplsWordStr(vr, vr2, poisk.Cells[4, i]));
            end;
          end;
          ReplaceT.Cells[j - 1, ReplaceT.Row] :=
            ReplaceT.Cells[j, ReplaceT.Row];
          SL.Add(ReplaceT.Cells[j - 1, ReplaceT.Row]);
          inc(j);
        end;
        ReplaceT.Cells[j - 1, ReplaceT.Row] := ReplaceT.Cells[j, ReplaceT.Row];
        if ReplaceT.Cells[1, ReplaceT.Row] <> '' then
          for i := 0 to poisk.RowCount - 1 do
            poisk.Cells[4, i] :=
              AbsString(WordReplaceS(poisk.Cells[4, i], ReplaceT.Cells[0,
              ReplaceT.Row], SL));
        FreeAndNil(SL);

        ReplaceT.RowCount := ReplaceT.RowCount + 1;
        ReplaceT.Cells[0, ReplaceT.RowCount - 2] := vr;
      end;
    end;
  end;
end;

procedure TForm1.ReplaceTDragDrop(Sender, source: TObject; X, Y: integer);
var
  ACol, ARow, i, j, n: integer;
  vr, vr2, vrs, vr3, vr4: string;
  SL: TStringList;
begin
  ReplaceT.MouseToCell(X, Y, ACol, ARow);
  n := ReplaceT.Row;
  vr2 := ReplaceT.Cells[ReplaceT.col, ReplaceT.Row];
  if vr2 <> '' then
  begin
    vrs := ReplaceT.Cells[ACol, ARow];
    vr := ReplaceT.Cells[0, ReplaceT.Row];
    vr3 := ReplaceT.Cells[0, ARow];
    vr4 := ReplaceT.Cells[ACol, ARow];

    if ReplaceT.col <> 0 then
    begin
      if ACol <> 0 then
      begin
        if whatdoT then // Alt
        begin
          for i := 0 to poisk.RowCount - 1 do
          begin
            if WordInStr(vr2, poisk.Cells[2, i]) then
            begin
              poisk.Cells[4, i] :=
                AbsString(RplsWordStr(vr, vr3, poisk.Cells[4, i]));
            end;
          end;
          if vr4 <> '' then
          begin
            for i := 0 to poisk.RowCount - 1 do
            begin
              if WordInStr(vr4, poisk.Cells[2, i]) then
              begin
                poisk.Cells[4, i] :=
                  AbsString(RplsWordStr(vr3, vr, poisk.Cells[4, i]));
              end;
            end;
          end;
          if vr4 = '' then
          begin
            j := ReplaceT.col;
            while ReplaceT.Cells[j + 1, ReplaceT.Row] <> '' do
            begin
              ReplaceT.Cells[j, ReplaceT.Row] :=
                ReplaceT.Cells[j + 1, ReplaceT.Row];
              inc(j);
            end;
            ReplaceT.Cells[j, ReplaceT.Row] := '';
            ReplaceT.Cells[ACol, ARow] := vr2;
          end
          else
          begin
            ReplaceT.Cells[ReplaceT.col, ReplaceT.Row] := vr4;
            ReplaceT.Cells[ACol, ARow] := vr2;
          end;
        end
        else
        begin
          for i := 0 to poisk.RowCount - 1 do
          begin
            if WordInStr(vr2, poisk.Cells[2, i]) then
            begin
              poisk.Cells[4, i] :=
                AbsString(RplsWordStr(vr, vr2, poisk.Cells[4, i]));
            end;
          end;
          for i := 0 to poisk.RowCount - 1 do
          begin
            if WordInStr(vr2, poisk.Cells[4, i]) then
            begin
              poisk.Cells[4, i] :=
                AbsString(RplsWordStr(vr2, vr3, poisk.Cells[4, i]));
            end;
          end;
          ReplaceT.Cells[ReplaceT.col, ReplaceT.Row] := '';
          j := 1;
          while ReplaceT.Cells[j, ARow] <> '' do
            inc(j);
          ReplaceT.Cells[j, ARow] := vr2;
        end;
      end //
      else // перенос в первый столбец
      begin
        if ARow = ReplaceT.Row then
        begin
          if ACol = 0 then
          begin
            if whatdoT then
            begin
              if ReplaceT.Cells[ReplaceT.col, ReplaceT.Row] <> '' then
              begin
                SL := TStringList.Create;
                SL.Add(ReplaceT.Cells[0, ReplaceT.Row]);
                j := 1;
                while ReplaceT.Cells[j, ReplaceT.Row] <> '' do
                begin
                  vr2 := ReplaceT.Cells[j, ReplaceT.Row];
                  for i := 0 to poisk.RowCount - 1 do
                  begin
                    if WordInStr(vr2, poisk.Cells[2, i]) then
                    begin
                      poisk.Cells[4, i] :=
                        AbsString(RplsWordStr(vr, vr2, poisk.Cells[4, i]));
                    end;
                  end;
                  if ReplaceT.col <> j then
                    SL.Add(ReplaceT.Cells[j, ReplaceT.Row]);
                  inc(j);
                end;

                ReplaceT.Cells[0, ReplaceT.Row] :=
                  ReplaceT.Cells[ReplaceT.col, ReplaceT.Row];
                for i := 0 to poisk.RowCount - 1 do
                  poisk.Cells[4, i] :=
                    AbsString(WordReplaceS(poisk.Cells[4, i],
                    ReplaceT.Cells[0, ReplaceT.Row], SL));
                FreeAndNil(SL);
                ReplaceT.Cells[ReplaceT.col, ReplaceT.Row] := vr4;
              end
              else
                ShowMessage
                  ('Перенос в первый стобец пустого значения не возможен');
            end
            else
            begin
              ObjShow(ClearListP);
              j := 0;
              while ReplaceT.Cells[j, ReplaceT.Row] <> '' do
              begin
                ClearList.Lines.Add(ReplaceT.Cells[j, ReplaceT.Row]);
                ReplaceT.Cells[j, ReplaceT.Row] := '';
                inc(j);
              end;
              DeleteARow(ReplaceT, ARow);
              ReplaceT.Row := n;
            end;
          end
          else
          begin
            ReplaceT.Cells[ReplaceT.col, ReplaceT.Row] := vr4;
            ReplaceT.Cells[ACol, ARow] := vr2;
          end;
        end
        else
          ShowMessage
            ('Перенос в первый стобец возможен только для той же строки');
      end;
    end
    else
    begin
      if (ReplaceT.Row <> ARow) then
      begin
        if (ReplaceT.Cells[1, ReplaceT.Row] <> '') then
          ShowMessage
            ('Перенос из первого стобца возможен только для слов без замен. Вы можете сделать перенос в первый столбец на той же строке.')
        else
        begin
          if whatdoT then // альт
          begin
            if vr4 <> '' then
            begin
              j := 1;
              while ReplaceT.Cells[j, ARow] <> '' do
              begin
                for i := 0 to poisk.RowCount - 1 do
                begin
                  if WordInStr(ReplaceT.Cells[j, ARow], poisk.Cells[2, i]) then
                  begin
                    poisk.Cells[4, i] :=
                      AbsString(RplsWordStr(ReplaceT.Cells[0, ARow], vr2,
                      poisk.Cells[4, i]));
                  end;
                end;
                inc(j);
              end;
              ReplaceT.Cells[ReplaceT.col, ReplaceT.Row] := vr4;
              ReplaceT.Cells[ACol, ARow] := vr2;
            end;
          end
          else
          begin
            for i := 0 to poisk.RowCount - 1 do
            begin
              if WordInStr(vr2, poisk.Cells[4, i]) then
              begin
                poisk.Cells[4, i] :=
                  AbsString(RplsWordStr(vr2, vr3, poisk.Cells[4, i]));
              end;
            end;
            j := 1;
            while ReplaceT.Cells[j, ARow] <> '' do
              inc(j);
            ReplaceT.Cells[j, ARow] := vr2;
            ReplaceT.Cells[ReplaceT.col, ReplaceT.Row] := '';
            DeleteARow(ReplaceT, ReplaceT.Row);
            ReplaceT.Row := n;
          end;
        end;
      end
      else
      begin
        if whatdoT then
        begin
          ShowMessage
            ('Перенос из первого стобца возможен только для слов без замен. Вы можете сделать перенос в первый столбец на той же строке.')
        end
        else
        begin
          ObjShow(ClearListP);
          j := 0;
          while ReplaceT.Cells[j, ARow] <> '' do
          begin
            ClearList.Lines.Add(ReplaceT.Cells[j, ReplaceT.Row]);
            ReplaceT.Cells[j, ReplaceT.Row] := '';
            inc(j);
          end;
          DeleteARow(ReplaceT, ARow);
        end;
      end;
    end;
  end;
  ReplaceT.col := ACol;
  ReplaceT.Row := ARow;
end;

procedure TForm1.ReplaceTDragOver(Sender, source: TObject; X, Y: integer;
  State: TDragState; var Accept: boolean);
begin
  Accept := source = ReplaceT;
end;

procedure TForm1.ReplaceTExit(Sender: TObject);
var
  i, j, sm: integer;
  b: boolean;
begin
  b := false;
  for i := 0 to ReplaceT.RowCount - 1 do
    if ReplaceT.Cells[ReplaceT.ColCount - 2, i] <> '' then
      b := true;
  if not b then
  begin
    ReplaceT.ColCount := rpls_col_count - 1;
    rpls_col_count := ReplaceT.ColCount;
  end;
  rpls_col_count := ReplaceT.ColCount;
  for j := 0 to ReplaceT.RowCount - 2 do
  begin
    b := false;
    i := 1;
    sm := 0;
    while i <= ReplaceT.ColCount - 2 do
    begin
      if ReplaceT.Cells[i, j] = '' then
      begin
        b := true;
        inc(sm);
      end
      else
      begin
        if b then
        begin
          ReplaceT.Cells[i - sm, ReplaceT.Row] :=
            ReplaceT.Cells[i, ReplaceT.Row];
          ReplaceT.Cells[i, ReplaceT.Row] := '';
          i := i - sm;
          b := false;
          sm := 0;
        end;
      end;
      inc(i);
    end;
  end;
end;

procedure TForm1.ReplaceTKeyUp(Sender: TObject; var Key: Word;
  Shift: TShiftState);
var
  i: integer;
  b: boolean;
begin
  if (Key = VK_BACK) or (Key = VK_DELETE) then
    if ReplaceT.Cells[ReplaceT.col, ReplaceT.Row] = '' then
    begin

      b := false;
      for i := 0 to ReplaceT.RowCount - 1 do
        if ReplaceT.Cells[ReplaceT.ColCount - 2, i] <> '' then
          b := true;
      if not b then
      begin
        ReplaceT.ColCount := rpls_col_count - 1;
        rpls_col_count := ReplaceT.ColCount;
      end;
    end;
end;

procedure TForm1.ReplaceTMouseDown(Sender: TObject; Button: TMouseButton;
  Shift: TShiftState; X, Y: integer);
var
  SL: TStringList;
  i, ACol, ARow: integer;
begin
  if Button = mbLeft then
  begin
    if ssAlt in Shift then
    begin
      ReplaceT.BeginDrag(true);
      whatdoT := true;
    end;
    if ssCtrl in Shift then
    begin
      ReplaceT.BeginDrag(true);
      whatdoT := false;
    end;
    if ssShift in Shift then
    begin
      LoadBarP.Visible := true;
      ReplaceRefresh(ReplaceT, poisk, LoadBar2);
      LoadBarP.Visible := false;
    end;
  end;
  if Button = mbRight then
  begin
    ReplaceT.MouseToCell(X, Y, ACol, ARow);
    ReplaceT.col := ACol;
    ReplaceT.Row := ARow;
    ObjShow(GroupSelectorP);
    Panel107.Caption := ReplaceT.Cells[ReplaceT.col, ReplaceT.Row];
    SL := TStringList.Create;
    i := 0;
    while ReplaceT.Cells[i, ReplaceT.Row] <> '' do
    begin
      SL.Add(ReplaceT.Cells[i, ReplaceT.Row]);
      inc(i);
    end;
    GroupSelectorByWord(GroupSelectorM, GroupSelectorMI, poisk, 4, SL);
    FreeAndNil(SL);
  end;
end;

procedure TForm1.ReplaceTMouseMove(Sender: TObject; Shift: TShiftState;
  X, Y: integer);
begin
  if (ssAlt in Shift) then
  begin
    if XposT > X + ReplaceT.DefaultColWidth then
    begin
      // ShowMessage(inttostr(XposT)+' '+inttostr(X));
      XposT := X;
      ReplaceT.Perform(WM_HSCROLL, 0, 0);
      // ShowMessage(inttostr(XposT)+' '+inttostr(YposT));
      // ReplaceT.Perform(WM_HSCROLL, 0, 0);
    end
    else if XposT < X - ReplaceT.DefaultColWidth then
    begin
      // ShowMessage(inttostr(XposT)+' '+inttostr(X));
      XposT := X;
      ReplaceT.Perform(WM_HSCROLL, 1, 0);
      // ReplaceT.Perform(WM_HSCROLL, 0, 0);
    end;
    // ShowMessage();
    Button5.Caption := inttostr(XposT);
  end;
end;

procedure swapstlb(SG: TStringGrid; col1, col2: integer);
var
  i: integer;
  vr: string;
begin
  for i := 0 to SG.RowCount - 1 do
  begin
    vr := SG.Cells[col1, i];
    SG.Cells[col1, i] := SG.Cells[col2, i];
    SG.Cells[col2, i] := vr;
  end;
end;

procedure TForm1.ReplaceToTable(ReplaceR: string; ReplaceM: TMemo;
  ReplaceT: TStringGrid);
var
  i, j, k, n: integer;
  b, c: boolean;
begin
  if ReplaceT.RowCount = 1 then
  begin
    ReplaceT.Cells[0, ReplaceT.RowCount - 1] := ReplaceR;
    if ReplaceT.ColCount < ReplaceM.Lines.Count + 1 then
      ReplaceT.ColCount := ReplaceM.Lines.Count + 1;
    for i := 0 to ReplaceM.Lines.Count - 1 do
      ReplaceT.Cells[i + 1, ReplaceT.RowCount - 1] := ReplaceM.Lines.Strings[i];
    ReplaceT.RowCount := ReplaceT.RowCount + 1;
  end
  else
  begin
    n := ReplaceT.RowCount - 1;
    for i := 0 to ReplaceT.ColCount - 1 do
      for j := 0 to ReplaceT.RowCount - 1 do
        if AnsiCompareText(ReplaceR, ReplaceT.Cells[i, j]) = 0 then
        begin
          n := j;
        end;
    if n = ReplaceT.RowCount - 1 then
    begin
      ReplaceT.Cells[0, ReplaceT.RowCount - 1] := ReplaceR;
      if ReplaceT.ColCount < ReplaceM.Lines.Count + 2 then
        ReplaceT.ColCount := ReplaceM.Lines.Count + 2;
      for i := 0 to ReplaceM.Lines.Count - 1 do
        ReplaceT.Cells[i + 1, ReplaceT.RowCount - 1] :=
          ReplaceM.Lines.Strings[i];
      ReplaceT.RowCount := ReplaceT.RowCount + 1;
    end
    else
    begin
      for j := 0 to ReplaceM.Lines.Count - 1 do
      begin
        b := false;
        for i := 0 to ReplaceT.ColCount - 1 do
          if AnsiCompareText(ReplaceM.Lines.Strings[j], ReplaceT.Cells[i, n]) = 0
          then
            b := true;
        if not b then
        begin
          c := false;
          for k := 0 to ReplaceT.ColCount - 2 do
            if ReplaceT.Cells[k, n] = '' then
            begin
              ReplaceT.Cells[k, n] := ReplaceM.Lines.Strings[j];
              c := true;
              break;
            end;
          if not c then
          begin
            ReplaceT.ColCount := ReplaceT.ColCount + 1;
            ReplaceT.Cells[ReplaceT.ColCount - 2, n] :=
              ReplaceM.Lines.Strings[j];
          end;
        end;
      end;
    end;
  end;
end;

procedure TForm1.ReplaceTSelectCell(Sender: TObject; ACol, ARow: integer;
  var CanSelect: boolean);
begin
  rpls_col_count := ReplaceT.ColCount;
end;

procedure TForm1.ReplaceTSetEditText(Sender: TObject; ACol, ARow: integer;
  const Value: string);
var
  b: boolean;
  i: integer;
begin
  if ACol = ReplaceT.ColCount - 1 then
  begin
    if Value <> '' then
    begin
      ReplaceT.ColCount := rpls_col_count + 1;
      rpls_col_count := ReplaceT.ColCount;
    end
    else
    begin
      b := false;
      for i := 0 to ReplaceT.RowCount - 1 do
        if ReplaceT.Cells[ReplaceT.ColCount - 2, i] <> '' then
          b := true;
      if not b then
      begin
        ReplaceT.ColCount := rpls_col_count - 1;
        rpls_col_count := ReplaceT.ColCount;
      end;
    end;
  end;
end;

procedure DelCell(stri: string; SG: TStringGrid; col: integer; all: boolean;
  Row: integer);
var
  i: integer;
begin
  if (not all) and (Row > -1) then
    SG.Cells[5, Row] := '0'
  else
    for i := 0 to SG.RowCount - 1 do
    begin
      if SG.Cells[5, i] = '1' then
      begin
        if AnsiCompareText(stri, SG.Cells[col, i]) = 0 then
        begin
          SG.Cells[5, i] := '0';
        end;
      end;
    end;
end;

procedure DelStr(stri: string; Memo: TMemo; all: boolean; Row: integer);
var
  i: integer;
  SL: TStringList;
begin
  if (not all) and (Row > -1) then
    Memo.Lines.Delete(Row)
  else
  begin
    SL := TStringList.Create;
    SL.Text := Memo.Text;
    i := SL.Count - 1;
    while i <> 0 do
    begin
      if AnsiCompareText(stri, SL.Strings[i]) = 0 then
        SL.Delete(i);
      dec(i);
      if i mod 25 = 0 then
        Application.ProcessMessages;
    end;
    Memo.Text := SL.Text;
    FreeAndNil(SL);
  end;
end;

procedure RplsStr(stri, stri2: string; Memo: TMemo; all: boolean; Row: integer);
var
  i: integer;
  SL: TStringList;
begin
  if (not all) and (Row > -1) then
    Memo.Lines.Strings[Row] := stri2
  else
  begin
    SL := TStringList.Create;
    SL.Text := Memo.Text;
    i := SL.Count - 1;
    while i <> 0 do
    begin
      if AnsiCompareText(stri, SL.Strings[i]) = 0 then
        SL.Strings[i] := stri2;
      dec(i);
    end;
    Memo.Text := SL.Text;
    FreeAndNil(SL);
  end;
end;

procedure TForm1.ReplaceZTZClick(Sender: TObject);
var
  i: integer;
begin
  for i := 0 to poisk.RowCount - 1 do
    if AnsiCompareText(poisk.Cells[rpls_col, i], OldZTZ.Caption) = 0 then
      poisk.Cells[rpls_col, i] := NewZTZ.Text;
  if changerI <> -1 then
  begin
    GroupSelectorZM.Lines.Strings[changerI] := NewZTZ.Text;
    changerI := 0;
  end;
  TakeList(AdsRightZags, poisk, 7);
  TakeList(AdsRightZags2, poisk, 8);
  TakeList(AdsRight, poisk, 9);
  if rpls_col = 7 then
  begin
    // RplsStr(OldZTZ.Caption, NewZTZ.Text, AdsRightZags, true, rpls_row);
    AdsZag.Caption := NewZTZ.Text;
  end;
  if rpls_col = 8 then
  begin
    // RplsStr(OldZTZ.Caption, NewZTZ.Text, AdsRightZags2, true, rpls_row);
    AdsZag2.Caption := NewZTZ.Text;
  end;
  if rpls_col = 9 then
  begin
    // RplsStr(OldZTZ.Caption, NewZTZ.Text, AdsRight, true, rpls_row);
    AdsText.Caption := NewZTZ.Text;
  end;
  ReplacerZTZP.Visible := false;
end;

procedure TForm1.ReplaceZTZOneClick(Sender: TObject);
begin
  // ShowMessage(inttostr(rpls_col)+' '+inttostr(rpls_row));
  poisk.Cells[rpls_col, rpls_row] := NewZTZ.Text;
  TakeList(AdsRightZags, poisk, 7);
  TakeList(AdsRightZags2, poisk, 8);
  TakeList(AdsRight, poisk, 9);

  { if ChangerI <> -1 then
    begin
    GroupSelectorZM.Lines.Strings[ChangerI] := NewZTZ.Text;
    ChangerI := 0;
    end;
    if rpls_col = 7 then
    begin
    RplsStr(OldZTZ.Caption, NewZTZ.Text, AdsRightZags, false, rpls_row);
    AdsZag.Caption := NewZTZ.Text;
    end;
    if rpls_col = 8 then
    begin
    RplsStr(OldZTZ.Caption, NewZTZ.Text, AdsRightZags2, false, rpls_row);
    AdsZag2.Caption := NewZTZ.Text;
    end;
    if rpls_col = 9 then
    begin
    RplsStr(OldZTZ.Caption, NewZTZ.Text, AdsRight, false, rpls_row);
    AdsText.Caption := NewZTZ.Text;
    end; }

  // ReplaceZTZOne.Enabled := false;
  ReplacerZTZP.Visible := false;
end;

function TForm1.WordReplaceS(s, r: string; M: TStrings): string;
var // Разбиваю строку S на слова, прохожу каждым словом по списку слов M, если нахожу совпадение то заменяю на R
  SS, SL: TStringList;
  i, j: integer;
  b: boolean;
begin
  SS := TStringList.Create;
  SS.Text := M.Text;
  SL := TStringList.Create;
  SL.Text := StringReplace(s, ' ', #13#10, [rfReplaceAll]);
  b := false;
  for i := 0 to SL.Count - 1 do
  begin
    for j := 0 to SS.Count - 1 do
      if AnsiCompareText(SS.Strings[j], SL[i]) = 0 then
      begin
        SL[i] := r;
        b := true;
      end;
  end;
  if b then
  begin
    WordReplaceS := ListToStr(SL);
  end
  else
    WordReplaceS := s;

  FreeAndNil(SL);
  FreeAndNil(SS);
end;

procedure WordReplaceW(Memo: TMemo; w, r: string);
var
  SL: TStringList;
  i: integer;
begin
  SL := TStringList.Create;
  SL.Duplicates := dupIgnore;
  SL.Text := Memo.Text;
  for i := 0 to SL.Count - 1 do
  begin
    SL.Strings[i] := RplsWordStr(w, r, SL.Strings[i]);
    if i mod 10 = 0 then
    begin
      Memo.Text := SL.Text;
      Application.ProcessMessages;
    end;
  end;
  Memo.Text := SL.Text;
  FreeAndNil(SL);
end;

procedure TForm1.WordReplaceM(Memo: TMemo; r: string; M: TMemo;
  T: TProgressBar);
var
  SL: TStringList;
  i: integer;
begin
  SL := TStringList.Create;
  SL.Duplicates := dupIgnore;
  SL.Text := Memo.Text;
  T.max := SL.Count - 1;
  for i := 0 to SL.Count - 1 do
  begin
    SL.Strings[i] := WordReplaceS(SL.Strings[i], r, M.Lines);
    T.Position := i;
    if i mod 10 = 0 then
    begin
      Memo.Text := SL.Text;
      Application.ProcessMessages;
    end;
  end;
  Memo.Text := SL.Text;
  FreeAndNil(SL);
end;

function wasstrfullT2(Word: string; SG: TStringGrid; col: integer;
  from_i, to_i: integer): integer; // фразу, где, колонка, сколько строк
var
  i, vr: integer;
begin
  vr := -1;
  for i := from_i to to_i - 1 do
  begin
    if SG.Cells[5, i] = '1' then
      if AnsiCompareText(Word, SG.Cells[col, i]) = 0 then
      begin
        vr := i;
        break;
      end;
  end;
  wasstrfullT2 := vr;
end;

function wasstrfullT22(Word: string; SG: TStringGrid; col: integer;
  from_i, to_i: integer): integer; // фразу, где, колонка, сколько строк
var
  i, vr: integer;
begin
  vr := -1;
  for i := from_i to to_i - 1 do
  begin
    if AnsiCompareText(Word, SG.Cells[col, i]) = 0 then
    begin
      vr := i;
      break;
    end;
  end;
  wasstrfullT22 := vr;
end;

// Список различных SL, Список в котором меняем SL2, временный список синонимов
procedure TForm1.WordReplaceP(M, M2, Mr: TMemo; sov, dlsl: integer;
  T, T2: TProgressBar; SG, SG2: TStringGrid);
var
  SL, SL2: TStringList;
  i, j, k, l, n, r: integer;
  vr, vrnew: string;
  b: boolean;
begin
  SL2 := TStringList.Create;
  SL2.Text := M2.Text;
  SL := TStringList.Create;
  SL.Text := M.Text;
  T.max := SL.Count - 1;
  Mr.Clear;
  Mr.Lines.Add(SL[i_sin]);
  b := false;
  n := i_sin;
  while (not closebool) and (not b) do
  begin
    for i := n to SL.Count - 2 do
    begin
      if (Pohozhest(SL[i], SL[i + 1], sov, dlsl)) AND (i < SL.Count - 2) then
        Mr.Lines.Add(SL[i + 1])
      else if (Pohozhest(SL[i], SL[i + 1], sov, dlsl)) AND (i = SL.Count - 2)
      then
      begin
        Mr.Lines.Add(SL[i + 1]);
        vr := Mr.Lines.Strings[0];
        Mr.Lines.Delete(0);
        T2.max := SL2.Count - 1;
        for j := 0 to SL2.Count - 1 do
        begin
          T2.Position := j;
          vrnew := SL2.Strings[j];
          SL2.Strings[j] := WordReplaceS(SL2.Strings[j], vr, Mr.Lines);

          if AnsiCompareText(vrnew, SL2.Strings[j]) <> 0 then
          begin
            r := wasstrfullT2(vrnew, SG2, 4, 0, SG2.RowCount - 1);
            SG2.Cells[4, r] := SL2.Strings[j];
          end;

          if j mod 10 = 0 then
          begin
            M2.Text := SL2.Text;
            Application.ProcessMessages;
          end;
          if closebool then
            break;
          T.max := SL.Count - 1;
        end;
        ReplaceToTable(vr, Mr, SG);
        l := 0;
        for k := 0 to Mr.Lines.Count - 1 do
          for j := l to M.Lines.Count - 1 do
            if AnsiCompareText(M.Lines.Strings[j], Mr.Lines.Strings[k]) = 0 then
            begin
              M.Lines.Delete(j);
              l := j;
              break;
            end;
        b := true;
        Mr.Lines.Clear;
      end
      else
      begin
        if Mr.Lines.Count > 1 then
        begin
          vr := Mr.Lines.Strings[0]; // выделяю слово для первого столбца
          Mr.Lines.Delete(0);
          T2.max := SL2.Count - 1;
          for j := 0 to SL2.Count - 1 do // прохожу по списку в котором меняю
          begin
            T2.Position := j;
            vrnew := SL2.Strings[j];
            SL2.Strings[j] := WordReplaceS(SL2.Strings[j], vr, Mr.Lines);

            if AnsiCompareText(vrnew, SL2.Strings[j]) <> 0 then
            begin
              r := wasstrfullT2(vrnew, SG2, 4, 0, SG2.RowCount - 1);
              // ShowMessage(vrnew+ '|'+SL2.Strings[j]+'|'+inttostr(r));
              if r > -1 then
                SG2.Cells[4, r] := SL2.Strings[j];
            end;

            if j mod 10 = 0 then
            begin
              M2.Text := SL2.Text;
              Application.ProcessMessages;
            end;
            if closebool then
              break;
          end;
          ReplaceToTable(vr, Mr, SG);
          l := 0;
          for k := 0 to Mr.Lines.Count - 1 do
            for j := l to M.Lines.Count - 1 do
              if AnsiCompareText(M.Lines.Strings[j], Mr.Lines.Strings[k]) = 0
              then
              begin
                M.Lines.Delete(j);
                l := j;
                break;
              end;
          T.max := SL.Count - 1;
        end
        else
        begin
          if not wasstrfullT3(SL[i], SG, 0, 0, SG.RowCount) then
          begin
            SG.Cells[0, SG.RowCount - 1] := SL[i];
            SG.RowCount := SG.RowCount + 1;
          end;
        end;
        Mr.Lines.Clear;
        Mr.Lines.Add(SL[i + 1]);
      end;
      T.Position := i;
      i_sin := i;
      if closebool then
        break;

      if i = SL.Count - 2 then
        b := true;
    end;
  end;
  i_sin := 0;
  M2.Text := SL2.Text;
  FreeAndNil(SL2);
  FreeAndNil(SL);
end;

procedure TForm1.getResult(s: string; const doc: ICefDomDocument);
var
  q: ICefDomNode;
begin
  q := doc.GetElementById(s);
  if Assigned(q) then
    mResult := q.GetValue
  else
    mResult := '-';
end;

Function parsec(Memo: TMemo; Word: string; word2: string): string;
var
  vr, ret: string;
  i: integer;
  b: bool;
begin
  vr := Memo.Text;

  if word2 = '' then
    word2 := '</html>';

  if (AnsiPos(Word, vr) > 0) then
  begin
    i := AnsiPos(Word, vr);
    while vr[i] <> '>' do
    begin
      inc(i);
    end;
    inc(i);
    ret := '';
    b := true;
    while (vr[i] <> '<') and (b) do
    begin
      ret := ret + vr[i];
      inc(i);
    end;
    vr := Copy(vr, i, vr.length - i - 1);
    Memo.Text := vr;
  end
  else
    ret := '';
  parsec := ret;
end;

procedure TForm1.ParsePage(Memo: TMemo);
begin
  ParsObjs := TPars.Create(Memo.Text);
end;

procedure TForm1.Pars(Memo: TMemo);
var
  vr: string;
  i, k: integer;
  wasbool: boolean;
begin
  vr := Memo.Text;
  if vr <> '' then
  begin
    ParsObjs := TPars.Create(vr);
    i := 2;
    while i < ParsObjs.obji - 1 do
    begin
      wasbool := false;
      for k := 0 to 119 do
      begin
        if ParsObjs.abc[k] = '' then
          break;
        if ParsObjs.abc[k] = ParsObjs.objs[i].name then
        begin
          wasbool := true;
          break;
        end;
      end;

      if Not wasbool then
      begin
        ParsObjs.abc[k] := ParsObjs.objs[i].name
      end;
      inc(i);
    end;
  end
  else
    ShowMessage('Ошибка: попробуйте позже.');
end;

procedure NoDuplicateT(aSg: TStringGrid; const ACol: integer);
var
  SlSort, SlRow: TStringList;
  i, j: integer;
begin
  // Сортируемый список.
  SlSort := TStringList.Create;

  // Добавляем в сортируемый список пары: "строка - объект".
  // В качестве строки будем записывать значения ячеек того
  // столбца, по которому надо провести сортировку. Будем брать те ячейки, которые
  // не принадлежат фиксированным строкам - чтобы не подвергнуть сортировке
  // шапку таблицы, если она есть.
  // А в качестве объекта будем присоединять копии соответствующих строк таблицы.
  for i := aSg.FixedRows to aSg.RowCount - 1 do
  begin
    // Создаём контейнер для копии строки таблицы.
    SlRow := TStringList.Create;
    // Копируем строку таблицы в контейнер.
    SlRow.Assign(aSg.Rows[i]);
    // Добавляем в сортируемый список пару:
    // строка: строка из ячейки целевого столбца;
    // объект: контейнер, содержащий копию строки таблицы.
    SlSort.AddObject(aSg.Cells[ACol, i], SlRow);
  end;

  // Сортируем столбец.
  SlSort.Sort;
  // SlSort.Duplicates := dupIgnore;

  // Возвращаем в таблицу строки, отсортированные по столбцу с номером aCol.
  j := 0;
  for i := aSg.FixedRows to aSg.RowCount - 1 do
  begin
    // Берём очередной контейнер.
    SlRow := Pointer(SlSort.Objects[j]);
    // Записываем содержимое контейнера в строку таблицы.
    aSg.Rows[i].Assign(SlRow);
    // Уничтожаем контейнер.
    SlRow.Free;
    // Следующий индекс списка.
    inc(j);
  end;

  // Уничтожаем сортируемый список.
  FreeAndNil(SlSort);
end;

procedure NoDuplicate(Memo: TMemo);
var
  SL: TStringList;
begin
  SL := TStringList.Create;
  SL.Sorted := true;
  SL.Duplicates := dupIgnore;
  SL.AddStrings(Memo.Lines);
  Memo.Clear;
  Memo.Lines.AddStrings(SL);
  FreeAndNil(SL);
end;

function NoPlusStringConst(const stri: String): string;
begin
  NoPlusStringConst := StringReplace(stri, '+', '', [rfReplaceAll]);;
end;

function AbsStringConst(const stri: String): string;
var
  SL2: TStringList;
  vr: string;
  i: integer;
begin
  SL2 := TStringList.Create;
  SL2.Sorted := true;
  SL2.Duplicates := dupIgnore;
  SL2.Text := StringReplace(stri, ' ', #13#10, [rfReplaceAll]);

  vr := '';
  for i := 0 to SL2.Count - 1 do
    if vr <> '' then
      vr := vr + ' ' + SL2[i]
    else
      vr := SL2[i];
  FreeAndNil(SL2);
  AbsStringConst := vr;
end;

procedure NoDuplicate2(Memo: TMemo);
var
  SL, SL2: TStringList;
  j, i: integer;
  vr: string;
  b: boolean;
begin
  SL := TStringList.Create;
  SL.Text := Memo.Text;
  Memo.Clear;
  SL2 := TStringList.Create;
  i := 0;
  while i < SL.Count - 1 do
  begin
    b := false;
    vr := AbsStringConst(NoPlusStringConst(SL.Strings[i]));
    for j := i + 1 to SL.Count - 1 do
      if AnsiCompareText(vr, AbsStringConst(NoPlusStringConst(SL.Strings[j]))) = 0
      then
      begin
        b := true;
        break;
      end;
    if not b then
      SL2.Add(SL.Strings[i]);
    inc(i);
  end;
  SL2.Add(SL.Strings[SL.Count - 1]);
  Memo.Text := SL2.Text;

  FreeAndNil(SL);
  FreeAndNil(SL2);
end;

procedure TForm1.NoDuplicate2T(Memo: TMemo; SG: TStringGrid);
var
  SL: TStringList;
  j, i, r: integer;
  vr: string;
  b: boolean;
begin
  SL := TStringList.Create;
  SL.Text := Memo.Text;
  Memo.Clear;
  i := 0;
  while i < SL.Count - 1 do
  begin
    b := false;
    for j := i + 1 to SL.Count - 1 do
      if AnsiCompareText(vr, SL.Strings[j]) = 0 then
      begin
        b := true;
        r := wasstrfullT2(vr, SG, 4, 0, SG.RowCount - 1);
        while r > -1 do
        begin
          r := wasstrfullT2(vr, SG, 4, r + 1, SG.RowCount - 1);
          SG.Cells[5, r] := '0';
        end;
        break;
      end;
    if not b then
      Memo.Lines.Add(SL.Strings[i]);
    inc(i);
    if i mod 25 = 0 then
      Application.ProcessMessages;
  end;
  Memo.Lines.Add(SL.Strings[SL.Count - 1]);

  FreeAndNil(SL);
end;

procedure NoDuplicate3T(SG: TStringGrid; col: integer);
var
  j, i: integer;
  vr: string;
  b: boolean;
begin
  for i := 0 to SG.RowCount - 2 do
  begin
    if SG.Cells[5, i] = '1' then
    begin
      b := false;
      vr := SG.Cells[col, i];
      for j := i + 1 to SG.RowCount - 1 do
        if AnsiCompareText(vr, SG.Cells[col, j]) = 0 then
        begin
          b := true;
          break;
        end;
      if b then
        SG.Cells[5, i] := '0';
    end;
    if i mod 25 = 0 then
      Application.ProcessMessages;
  end;
end;

procedure Lowering(Memo: TMemo);
var
  j: integer;
begin
  for j := 0 to Memo.Lines.Count - 1 do
  begin
    Memo.Lines.Strings[j] := AnsiLowerCase(Memo.Lines.Strings[j]);
    if j mod 50 = 0 then
      Application.ProcessMessages;
  end;
end;

procedure LoweringT(T: TStringGrid; n: integer);
var
  j: integer;
begin
  for j := 0 to T.RowCount - 1 do
  begin
    T.Cells[n, j] := AnsiLowerCase(T.Cells[n, j]);
    if j mod 50 = 0 then
      Application.ProcessMessages;
  end;
end;

procedure Absing(Memo: TMemo; T: TProgressBar);
var
  j: integer;
  SL: TStringList;
begin
  SL := TStringList.Create;
  SL.Text := Memo.Text;
  T.max := SL.Count - 1;
  for j := 0 to SL.Count - 1 do
  begin
    SL.Strings[j] := NoPlusString(SL.Strings[j]);
    SL.Strings[j] := AbsString(SL.Strings[j]);
    SL.Strings[j] := AnsiLowerCase(SL.Strings[j]);
    T.Position := j;
    if j mod 50 = 0 then
    begin
      Application.ProcessMessages;
      Memo.Text := SL.Text;
    end;
  end;
  FreeAndNil(SL);
  // Lowering(Memo);
end;

procedure AbsingT(T: TStringGrid; n: integer);
var
  j: integer;
begin
  for j := 0 to T.RowCount - 1 do
  begin
    T.Cells[n, j] := NoPlusString(T.Cells[n, j]);
    T.Cells[n, j] := AbsString(T.Cells[n, j]);
    T.Cells[n, j] := AnsiLowerCase(T.Cells[n, j]);
    if j mod 25 = 0 then
      Application.ProcessMessages;
  end;
end;

function ClearingStr(stri: string; Memo: TMemo): string;
var
  j, i: integer;
  SL, SS: TStringList;
  vr: string;
begin
  vr := stri;
  SL := TStringList.Create;
  SL.Text := StringReplace(vr, ' ', #13#10, [rfReplaceAll]);
  SS := TStringList.Create;
  SS.Text := Memo.Text;
  for i := 0 to SL.Count - 1 do
  begin
    for j := 0 to SS.Count - 1 do
    begin
      if AnsiCompareText(SL[i], SS[j]) = 0 then
        SL[i] := '';
    end;
  end;
  vr := '';
  for i := 0 to SL.Count - 1 do
  begin
    if SL[i] <> '' then
    begin
      if vr = '' then
        vr := SL[i]
      else
        vr := vr + ' ' + SL[i];
    end;
  end;
  FreeAndNil(SL);
  FreeAndNil(SS);
  ClearingStr := vr;
end;

procedure Clearing3(Memo: TMemo; T: TProgressBar);
var
  i: integer;
  vr: string;
  vrsl: TStringList;
begin
  vrsl := TStringList.Create;
  vrsl.Text := Memo.Text;
  i := 0;
  T.max := vrsl.Count - 1;
  while i <= vrsl.Count - 1 do
  begin
    vr := vrsl[i];
    T.Position := i;
    if vr = '' then
    begin
      vrsl.Delete(i);
    end
    else
    begin
      if vr.length < 3 then
      begin
        vrsl.Delete(i);
      end
      else
      begin
        vr := DelSpace(vr);
        if (vr = '') or (Slov(vr) = 1) then
          vrsl.Delete(i)
        else
        begin
          vrsl[i] := vr;
          inc(i);
        end;
      end;
    end;
    if i mod 20 = 0 then
    begin
      Memo.Text := vrsl.Text;
      Application.ProcessMessages;
    end;
  end;
  FreeAndNil(vrsl);
end;

procedure Clearing32(Memo: TMemo; SG: TStringGrid; col: integer;
  T: TProgressBar);
// удаляет строки длинной 2 буквы, удаляет пробелы, строки из одного слова
var
  i, j: integer;
  vr: string;
  vrsl: TStringList;
begin
  TakeList(Memo, SG, col);
  vrsl := TStringList.Create;
  vrsl.Text := Memo.Text;
  i := 0;
  j := 0;
  while i <= vrsl.Count - 1 do
  begin
    vr := vrsl[i];
    if vr = '' then
    begin
      vrsl.Delete(i);
      SG.Cells[5, j] := '0';
    end
    else
    begin
      if vr.length < 3 then
      begin
        vrsl.Delete(i);
        SG.Cells[5, j] := '0';
      end
      else
      begin
        vr := DelSpace(vr);
        if (vr = '') or (Slov(vr) = 1) then
        begin
          vrsl.Delete(i);
          SG.Cells[5, j] := '0';
        end
        else
        begin
          vrsl[i] := vr;
          SG.Cells[4, j] := vr;
          inc(i);
        end;
      end;
    end;
    inc(j);
    T.max := vrsl.Count - 1;
    T.Position := i;
    if i mod 20 = 0 then
    begin
      Memo.Text := vrsl.Text;
      Application.ProcessMessages;
    end;
  end;
  FreeAndNil(vrsl);
end;

procedure Clearing2Pos(Memo: TMemo; Memo2: TMemo; ccc: boolean; dlsl: integer;
  T: TProgressBar);
var
  j, i: integer;
  vrsl, vrsl2: TStringList;
  vr, vr2: string;
begin
  vrsl := TStringList.Create;
  vrsl.Text := Memo.Text;
  vrsl2 := TStringList.Create;
  vrsl2.Text := Memo2.Text;
  T.max := vrsl.Count - 1;
  for i := vrsl.Count - 1 downto 0 do
  begin
    vr := vrsl[i];
    T.Position := vrsl.Count - i + 1;
    for j := 0 to vrsl2.Count - 1 do
    begin
      vr2 := vrsl2[j];

      if ccc then // удалять числа?
      begin
        if SlovoChislo(vr2) then
        begin
          vr := DelWordInStrPos(vr2, vr);
        end;
      end;

      if length(vr2) > dlsl then
      begin
        vr := DelWordInStrPos(vr2, vr);
      end
      else
      begin
        vr := DelWordInStr(vr2, vr);
      end;
    end;

    vrsl[i] := vr;
    if i mod 10 = 0 then
    begin
      Memo.Text := vrsl.Text;
      Application.ProcessMessages;
    end;
  end;
  FreeAndNil(vrsl);
  FreeAndNil(vrsl2);
end;

procedure Clearing2Pos2(Memo: TMemo; Memo2: TMemo; SG: TStringGrid;
  ccc: boolean; dlsl: integer; T: TProgressBar);
var
  j, i: integer;
  vrsl, vrsl2: TStringList;
  vr, vr2: string;
begin
  vrsl := TStringList.Create;
  vrsl.Text := Memo.Text;
  vrsl2 := TStringList.Create;
  vrsl2.Text := Memo2.Text;
  T.max := vrsl.Count - 1;
  for i := vrsl.Count - 1 downto 0 do
  begin
    vr := vrsl[i];
    T.Position := vrsl.Count - i + 1;
    for j := 0 to vrsl2.Count - 1 do
    begin
      vr2 := vrsl2[j];

      if ccc then // удалять числа?
      begin
        if SlovoChislo(vr2) then
        begin
          vr := DelWordInStrPos(vr2, vr);
        end;
      end;

      if length(vr2) > dlsl then
      begin
        vr := DelWordInStrPos(vr2, vr);
      end
      else
      begin
        vr := DelWordInStr(vr2, vr);
      end;
    end;
    SG.Cells[4, i] := vr;
    vrsl[i] := vr;
    if i mod 10 = 0 then
    begin
      Memo.Text := vrsl.Text;
      Application.ProcessMessages;
    end;
  end;
  FreeAndNil(vrsl);
  FreeAndNil(vrsl2);
end;

procedure TForm1.Clearing2P(Memo: TMemo; Memo2: TMemo; ccc: boolean;
  sov, dlsl: integer; T: TProgressBar);
var
  j, i: integer;
  vrsl, vrsl2: TStringList;
  vr, vr2: string;
begin
  vrsl := TStringList.Create;
  vrsl.Text := Memo.Text;
  vrsl2 := TStringList.Create;
  vrsl2.Text := Memo2.Text;
  T.max := vrsl.Count - 1;
  for i := vrsl.Count - 1 downto 0 do
  begin
    vr := vrsl.Strings[i];
    for j := 0 to vrsl2.Count - 1 do
    begin
      vr2 := vrsl2.Strings[j];

      if ccc then // удалять числа?
      begin
        if SlovoChislo(vr2) then
        begin
          vr := DelWordInStrPos(vr2, vr);
        end;
      end;

      vr := DelWordInStrP(vr2, vr, sov, dlsl);
    end;

    vrsl.Strings[i] := vr;
    T.Position := vrsl.Count + 1 - i;
    if i mod 10 = 0 then
    begin
      Memo.Text := vrsl.Text;
      Application.ProcessMessages;
    end;
  end;
  FreeAndNil(vrsl);
  FreeAndNil(vrsl2);
end;

procedure TForm1.Clearing2Pstr(stri: string; Memo2: TMemo; ccc: boolean;
  sov, dlsl: integer; pos: integer);
var
  j: integer;
  vrsl2: TStringList;
  vr, vr2: string;
begin
  vrsl2 := TStringList.Create;
  vrsl2.Text := Memo2.Text;
  vr := stri;
  for j := 0 to vrsl2.Count - 1 do
  begin
    vr2 := vrsl2[j];

    if ccc then // удалять числа?
    begin
      if SlovoChislo(vr2) then
      begin
        vr := DelWordInStrPos(vr2, vr);
      end;
    end;
    if pos = 1 then
    begin
      if length(vr2) > dlsl then
      begin
        vr := DelWordInStrPos(vr2, vr);
      end
      else
      begin
        vr := DelWordInStr(vr2, vr);
      end;
    end
    else
      vr := DelWordInStrP(vr2, vr, sov, dlsl);

    if j mod 20 = 0 then
    begin
      Application.ProcessMessages;
    end;
  end;
  stri := vr;

  FreeAndNil(vrsl2);
end;

procedure TForm1.Clearing2P2(Memo: TMemo; Memo2: TMemo; SG: TStringGrid;
  col: integer; ccc: boolean; sov, dlsl: integer; T: TProgressBar);
var
  j, i: integer;
  vrsl, vrsl2: TStringList;
  vr, vr2: string;
begin
  vrsl := TStringList.Create;
  vrsl.Text := Memo.Text;
  vrsl2 := TStringList.Create;
  vrsl2.Text := Memo2.Text;
  T.max := vrsl.Count;
  for i := vrsl.Count - 1 downto 0 do
  begin
    vr := vrsl[i];
    for j := 0 to vrsl2.Count - 1 do
    begin
      vr2 := vrsl2[j];

      if ccc then // удалять числа?
      begin
        if SlovoChislo(vr2) then
        begin
          vr := DelWordInStrPos(vr2, vr);
        end;
      end;

      vr := DelWordInStrP(vr2, vr, sov, dlsl);
    end;
    SG.Cells[col, i] := vr;
    vrsl[i] := vr;
    T.Position := vrsl.Count + 1 - i;
    if i mod 10 = 0 then
    begin
      Memo.Text := vrsl.Text;
      Application.ProcessMessages;
    end;
  end;
  FreeAndNil(vrsl);
  FreeAndNil(vrsl2);
end;

procedure Clearing4(Memo: TMemo; Memo2: TMemo; Memo3: TMemo);
// pre my m //при ручной очистке минуса из предварительного списка отправляет в свои минуса, если нет в списке своих минусов и общем списке минус слов
var
  j, i: integer;
  vrsl, vrsl2, vrsl3: TStringList;
  // vr, vr2: string;
  a, b: boolean;
begin
  vrsl := TStringList.Create;
  vrsl.Text := Memo.Text;
  vrsl2 := TStringList.Create;
  vrsl2.Text := Memo2.Text;
  vrsl3 := TStringList.Create;
  vrsl3.Text := Memo3.Text;

  for i := 0 to vrsl.Count - 1 do // pre
  begin
    a := false;
    b := false;
    for j := 0 to vrsl2.Count - 1 do // my
    begin
      if AnsiCompareText(vrsl[i], vrsl2[j]) = 0 then
      begin
        a := true;
        break;
      end;
    end;
    if not a then
    begin
      b := false;
      for j := 0 to vrsl3.Count - 1 do // m
      begin
        if AnsiCompareText(vrsl3[j], vrsl[i]) = 0 then
        begin
          b := true;
          break;
        end;
      end;
      if b then
        break;
    end;
    if not b then
    begin
      vrsl2.Add(vrsl[i]);
    end;
    if i mod 10 = 0 then
    begin
      Memo.Text := vrsl.Text;
      Application.ProcessMessages;
    end;
  end;
  Memo.Text := vrsl.Text;
  Memo2.Text := vrsl2.Text;
  Memo3.Text := vrsl3.Text;
end;

procedure TForm1.Clearing5(Memo: TMemo; Memo2: TMemo; ListClear: TMemo;
  sov, DlSov, MinDlSlov: integer; formlist: boolean);
var
  j, i, k, n: integer;
  SL: TStringList;
  vr, vr2: string;
  num: boolean;
begin
  for i := Memo.Lines.Count - 1 downto 0 do
  begin
    vr := Memo.Lines.Strings[i];
    for j := 0 to Memo2.Lines.Count - 1 do
    begin
      vr2 := Memo2.Lines.Strings[j];
      num := true;
      try
        n := strtoint(vr2);
      except
        num := false;
      end;
      if formlist then
      begin
        if num then
        begin
          if AnsiPos(vr2, vr) > 0 then
          begin
            SL := TStringList.Create;
            SL.Text := StringReplace(vr, ' ', #13#10, [rfReplaceAll]);
            for k := 0 to SL.Count - 1 do
            begin
              if AnsiPos(vr2, SL[k]) > 0 then
              begin
                ListClear.Lines.Add(SL[k]);
                // ShowMessage(sl[k]);
              end;
            end;
            FreeAndNil(SL);
          end;
        end
        else
        begin
          if length(vr2) >= MinDlSlov then
          begin
            SL := TStringList.Create;
            SL.Text := StringReplace(vr, ' ', #13#10, [rfReplaceAll]);
            for k := 0 to SL.Count - 1 do
            begin
              if length(SL[k]) >= MinDlSlov then
              begin
                if Pohozhest(vr2, SL[k], sov, MinDlSlov) then
                begin
                  // if AnsiPos(sl[k], ListClear.Text)>0 then
                  ListClear.Lines.Add(SL[k]);
                  // ShowMessage(sl[k]);
                end;
              end;
            end;
            FreeAndNil(SL);
          end;
        end;
      end
      else
      begin
        if num then
        begin
          if AnsiPos(vr2, vr) > 0 then
          begin
            SL := TStringList.Create;
            SL.Text := StringReplace(vr, ' ', #13#10, [rfReplaceAll]);
            for k := 0 to SL.Count - 1 do
            begin
              if AnsiPos(vr2, SL[k]) > 0 then
                SL[k] := '';
            end;
            vr := '';
            for k := 0 to SL.Count - 1 do
            begin
              if vr = '' then
                vr := SL[k]
              else
              begin
                if SL[k] <> '' then
                  vr := vr + ' ' + SL[k];
              end;
            end;
            FreeAndNil(SL);
          end;
        end
        else
        begin
          if length(vr2) >= MinDlSlov then
          begin
            SL := TStringList.Create;
            SL.Text := StringReplace(vr, ' ', #13#10, [rfReplaceAll]);
            for k := 0 to SL.Count - 1 do
            begin
              if length(SL[k]) >= MinDlSlov then
              begin
                if Pohozhest(vr2, SL[k], sov, MinDlSlov) then
                begin
                  SL[k] := '';
                end;
              end;
            end;
            vr := '';
            for k := 0 to SL.Count - 1 do
            begin
              if vr = '' then
                vr := SL[k]
              else
              begin
                if SL[k] <> '' then
                  vr := vr + ' ' + SL[k];
              end;
            end;
            FreeAndNil(SL);
          end;
        end;
        // vr := StringReplace(vr, memo2.Lines.Strings[j], '', [rfReplaceAll, rfIgnoreCase]);
      end;
    end;
    Memo.Lines.Strings[i] := vr;
    if i mod 5 = 0 then
      Application.ProcessMessages;
  end;
end;

function was(Grid: TStringGrid; Word: string; n: integer): integer;
var
  i: integer;
  vr: integer;
begin
  vr := -1;
  for i := 0 to Grid.RowCount - 1 do
    if AnsiCompareStr(AnsiLowerCase(Word), AnsiLowerCase(Grid.Cells[n, i])) = 0
    then
      vr := i;
  was := vr;
end;

function wasstr(Word: string; Memo: TMemo; n: integer): integer;
// фразу, где, сколько строк
var
  SL, SL2: TStringList;
  i, l, k, chet, dl1, dl2, vr: integer;
  so: array [0 .. 20] of integer;
  stri2: string;
begin
  vr := -1;
  SL := TStringList.Create;
  SL.Text := StringReplace(Word, ' ', #13#10, [rfReplaceAll]);
  dl1 := SL.Count;
  for i := 0 to n - 1 do
  begin
    for k := 0 to 19 do
      so[k] := 0; // sovpadeniya

    stri2 := Memo.Lines.Strings[i];
    dl2 := Slov(stri2);
    SL2 := TStringList.Create;
    SL2.Text := StringReplace(stri2, ' ', #13#10, [rfReplaceAll]);
    chet := 0;
    if dl1 < dl2 then
    begin
      for l := 0 to dl1 - 1 do
      begin
        for k := 0 to dl2 - 1 do
          if (AnsiCompareStr(SL[l], SL2[k]) = 0) then
          begin
            so[l] := 1;
          end
      end;

      for l := 0 to dl1 - 1 do
        chet := chet + so[l];
      // ShowMessage('1) '+word + ' | ' + stri2 + ' | ' + inttostr(chet) + ' | ' + inttostr(dl1));
      if chet = dl1 then
      begin
        vr := i;
        break;
      end;
    end
    else
    begin
      for l := 0 to dl2 - 1 do
      begin
        for k := 0 to dl1 - 1 do
          if (AnsiCompareStr(SL2[l], SL[k]) = 0) then
          begin
            so[l] := 1;
          end
      end;

      for l := 0 to dl2 - 1 do
        chet := chet + so[l];
      // ShowMessage('2) '+word + ' | ' + stri2 + ' | ' + inttostr(chet) + ' | ' + inttostr(dl2));
      if chet = dl2 then
      begin
        vr := i;
        FreeAndNil(SL2);
        break;
      end;
    end;
    FreeAndNil(SL2);
  end;

  FreeAndNil(SL);
  wasstr := vr;
end;

procedure TForm1.ClearingS(Memo: array of TMemo; Memo2: TMemo; SG: TStringGrid;
  col, sov, DlSov, MinDlSlov: integer; ccc, posorcomp, cutordel, clearornot,
  formlist: boolean; TP: TProgressBar);
var
  i, j, k, n, r, prev_i: integer; // ne ispol
  vr, vr2, vrnew: string;
  SL, SL2, SLS: TStringList;
  num, next: boolean;
begin
  SL := TStringList.Create;
  SL2 := TStringList.Create;
  SL.Text := '';
  SL.Sorted := true;
  SL.Duplicates := dupIgnore;
  SL2.Text := Memo2.Text;

  for i := 0 to length(Memo) - 1 do
    SL.Text := SL.Text + Memo[i].Text; // единый список чистки     {}

  i := SL2.Count - 1;
  while i <> 0 do
  begin
    next := false;
    prev_i := i;
    vr := SL2.Strings[i];
    r := wasstrfullT2(vr, SG, col, 0, SG.RowCount - 1);
    SLS := TStringList.Create;
    SLS.Text := StringReplace(vr, ' ', #13#10, [rfReplaceAll]);
    // фраза из списка

    if ccc then
    begin
      j := SLS.Count - 1;
      while j >= 0 do
      begin
        vr2 := SLS.Strings[j];
        num := true;
        try
          n := strtoint(vr2);
        except
          num := false;
        end;
        if num then
        begin
          SLS.Delete(j);
          if cutordel then
          begin
            SG.Cells[5, r] := '0';
            SL2.Delete(i);
            dec(i);
            next := true;
            FreeAndNil(SLS);
          end;
        end;
        dec(j);
      end;
    end;

    vrnew := ListToStr(SLS);

    if AnsiCompareText(vr, vrnew) <> 0 then
    begin
      SG.Cells[col, r] := vrnew;
      SL2.Strings[i] := vrnew;
      if cutordel then
      begin
        SG.Cells[5, r] := '0';
        SL2.Delete(i);
        dec(i);
        next := true;
        FreeAndNil(SLS);
      end;
    end;

    if not next then
    begin
      if posorcomp then
      begin
        j := SLS.Count - 1;
        while j >= 0 do
        begin
          vr2 := SLS.Strings[j];
          for k := 0 to SL.Count - 1 do
          begin
            if AnsiCompareText(vr2, SL[k]) = 0 then
            begin
              SLS.Delete(j);
              if cutordel then
              begin
                SG.Cells[5, r] := '0';
                SL2.Delete(i);
                dec(i);
                next := true;
                FreeAndNil(SLS);
              end;
              break;
            end;
          end;
          if next then
            break;
          dec(j);
        end;
      end
      else
      begin
        j := SLS.Count - 1;
        while j >= 0 do
        begin
          vr2 := SLS.Strings[j];
          for k := 0 to SL.Count - 1 do
          begin
            if Pohozhest(vr2, SL[k], sov, MinDlSlov) then
            begin
              SLS.Delete(j);
              if cutordel then
              begin
                SG.Cells[5, r] := '0';
                SL2.Delete(i);
                dec(i);
                next := true;
                FreeAndNil(SLS);
              end;
              break;
            end;
          end;
          if next then
            break;
          dec(j);
        end;
      end;

      vrnew := ListToStr(SLS);
      if AnsiCompareText(vr, vrnew) <> 0 then
      begin
        r := wasstrfullT2(vr, SG, col, 0, SG.RowCount - 1);
        SL2.Strings[i] := vrnew;
        SG.Cells[col, r] := vrnew;
        if cutordel then
        begin
          SG.Cells[5, r] := '0';
          SL2.Delete(i);
          dec(i);
          FreeAndNil(SLS);
        end;
      end;
    end;

    FreeAndNil(SLS);
    TP.Position := SL2.Count - 1 - i;
    TP.max := SL2.Count - 1;
    if i mod 2 = 0 then
    begin
      Memo2.Text := SL2.Text;
      Application.ProcessMessages;
    end;
    if prev_i = i then
      dec(i);
    // ShowMessage(inttostr(i));
  end;

  if not clearornot then
  begin
    while i <= SL2.Count - 1 do
    begin
      vr := SL2.Strings[i];
      if vr = '' then
        SL2.Delete(i)
      else
      begin
        if vr.length < 3 then
          SL2.Delete(i)
        else
        begin
          vr := DelSpace(vr);
          if (vr = '') or (Slov(vr) = 1) then
          begin
            SL2.Delete(i);
          end
          else
          begin
            SL2.Strings[i] := vr;
            inc(i);
          end;
        end;
      end;
    end;
    for i := 0 to SG.RowCount - 1 do
    begin
      vr := SG.Cells[col, i];
      if vr = '' then
        SG.Cells[5, i] := '0'
      else
      begin
        if vr.length < 3 then
          SG.Cells[5, i] := '0'
        else
        begin
          vr := DelSpace(vr);
          if (vr = '') or (Slov(vr) = 1) then
            SG.Cells[5, i] := '0'
          else
          begin
            SG.Cells[col, i] := vr;
          end;
        end;
      end;
    end;
  end;
  Memo2.Text := SL2.Text;
  FreeAndNil(SL);
  FreeAndNil(SL2);
end;

procedure TForm1.CountControlClick(Sender: TObject);
var
  i, ii: integer;
begin
  for i := 0 to CountControl.RowCount - 1 do
    for ii := 0 to CountControl.ColCount - 1 do
      if CountControl.ColWidths[ii] < CountControl.Canvas.TextWidth
        (CountControl.Cells[ii, i] + ' ') then
        CountControl.ColWidths[ii] := CountControl.Canvas.TextWidth
          (CountControl.Cells[ii, i] + ' ');
end;

procedure TForm1.CreateNames(SG: TStringGrid);
var
  i: integer;
begin
  for i := 0 to SG.RowCount - 1 do
  begin
    if SG.Cells[5, i] = '1' then
    begin
      if SG.Cells[13, i] = '' then
        SG.Cells[13, i] := SG.Cells[19, i] + '_' + SG.Cells[30, i] + '_' + ' ' +
          code + '_' + regions + '_';
      if SG.Cells[14, i] = '' then
        SG.Cells[14, i] := code + '_' + SG.Cells[1, i];
    end;
  end;
end;

procedure FindWord(BR: TChromium; Word: string);
var
  CodeStr: string;
begin
  CodeStr := 'document.location.href = "https://wordstat.yandex.ru/#!/?regions='
    + regions + '&page=' + inttostr(pages_i) + '&words=' + Word + '"';
  BR.Browser.Mainframe.ExecuteJavaScript(CodeStr, 'about:blank', 0);
end;

function KrossDel(fraza: string; fraza2: string): integer;
var
  SL: TStringList;
  vr: string;
  i, k: integer;
  swap: boolean;
begin
  swap := false;
  if Slov(fraza) > Slov(fraza2) then
  begin
    vr := fraza;
    fraza := fraza2;
    fraza2 := vr;
    swap := true;
  end;
  // ShowMessage(fraza+' * '+fraza2);
  SL := TStringList.Create;
  SL.Text := StringReplace(fraza, ' ', #13#10, [rfReplaceAll]);

  k := 0;
  for i := 0 to SL.Count - 1 do
  begin
    if AnsiPos(SL[i], fraza2) > 0 then
    begin
      k := k + 1;
    end;
  end;

  FreeAndNil(SL);

  if Slov(fraza) = k then
  begin
    if swap then
      KrossDel := 1
    else
      KrossDel := 2;
  end
  else
    KrossDel := 0;
end;

procedure SaveTable(table: TStringGrid; code: String; pris: string);
var
  n, M: integer;
  F1: TextFile;
begin
  AssignFile(F1, ExtractfilePath(Application.ExeName) + 'Projects/' + code + '/'
    + code + pris + '.txt');
  Rewrite(F1);
  for n := 0 to table.RowCount - 1 do
    for M := 0 to table.ColCount - 1 do
      writeln(F1, table.Cells[M, n]);
  CloseFile(F1);
end;

procedure LoadTable(table: TStringGrid; code: String; SP_MAX: integer;
  pris: string);
var
  i, n, sp: integer;
  F1: TextFile;
  StrTEMP: string;
  b, c: boolean;
begin
  table.RowCount := 0;
  AssignFile(F1, ExtractfilePath(Application.ExeName) + 'Projects/' + code + '/'
    + code + pris + '.txt');
  Reset(F1);
  b := false;
  c := true;
  i := 0;
  sp := 0;
  if not EoF(F1) then
  begin
    while (not EoF(F1)) and (c) do
    begin
      for n := 0 to table.ColCount - 1 do
        if not EoF(F1) then
        begin
          readln(F1, StrTEMP);
          if (n = 4 + sp * 5) and (trim(StrTEMP) = '') and (b) then
          begin
            table.Cells[n - 2, table.RowCount - 1] := '';
            table.Cells[n - 1, table.RowCount - 1] := '';
            table.Cells[n - 3, table.RowCount - 1] := '';
            table.Cells[n - 4, table.RowCount - 1] := '';
            c := false;
          end
          else
          begin
            table.Cells[n, table.RowCount - 1] := StrTEMP;
            if (table.Cells[1 + sp * 5, table.RowCount - 1] = '') and
              (sp <= SP_MAX) and (n = 1 + sp * 5) then
              inc(sp);
          end;
        end;
      table.RowCount := table.RowCount + 1;
      b := true;
      inc(i);
      if i mod 10 = 0 then
        Application.ProcessMessages;
    end;
  end;
  table.RowCount := table.RowCount - 1;
  CloseFile(F1);
end;

procedure LoadTable2(table: TStringGrid; code: String; pris: string;
  cols: integer);
var
  i, n: integer;
  F1: TextFile;
  StrTEMP: string;
begin
  table.RowCount := 0;
  table.ColCount := cols;
  AssignFile(F1, ExtractfilePath(Application.ExeName) + 'Projects/' + code + '/'
    + code + pris + '.txt');
  i := 0;
  Reset(F1);
  if not EoF(F1) then
  begin
    while (not EoF(F1)) do
    begin
      for n := 0 to table.ColCount - 1 do
        if not EoF(F1) then
        begin
          readln(F1, StrTEMP);
          table.Cells[n, table.RowCount - 1] := StrTEMP;
        end;
      table.RowCount := table.RowCount + 1;
      inc(i);
      if i mod 10 = 0 then
        Application.ProcessMessages;
    end;
  end;
  table.RowCount := table.RowCount - 1;
  CloseFile(F1);
end;

// function JPeg2MIME(jpg: TJPEGImage): String;
function JPEGtoB64B(jpg: TJPEGImage): AnsiString;
var
  ds: TMemoryStream;
  // bs64:
begin
  ds := TMemoryStream.Create;
  try
    jpg.SaveToStream(ds);
    JPEGtoB64B := EncodeBase64(ds.Memory, ds.Size);
  finally
    ds.Free;
  end;
end;

procedure ParsJSON(stri, get1, field1, field2: string; Memo: TMemo);
var
  JSON, GARs, GC { , Gid } : TJSONObject;
  // JV: TJSONValue;
  Pairs: TJSONPairEnumerator;
  // Value: string;
  JsonArray: TJSONArray;
  i: integer;
begin
  JSON := TJSONObject.ParseJSONValue(stri) As TJSONObject;
  if Assigned(JSON) then
  begin
    Pairs := JSON.GetEnumerator;
    while Pairs.MoveNext do
    begin
      if Pairs.Current.JsonString.Value = 'result' then
      begin
        GARs := Pairs.Current.JsonValue as TJSONObject;
        JsonArray := GARs.Get(get1).JsonValue as TJSONArray;
        if Assigned(JsonArray) then
        begin
          for i := 0 to JsonArray.Count - 1 do
          begin
            GC := JsonArray.Items[i] as TJSONObject;
            if Assigned(GC) then
            begin
              Memo.Lines.Add((GC.Get(field1).JsonValue.Value));
              Memo.Lines.Add((GC.Get(field2).JsonValue.Value));
            end;
          end;
        end;
      end;
    end;
  end;
end;

function ParsJSON1(stri, get1, field1: string): string;
var
  JSON, GARs, GC: TJSONObject;
  Pairs: TJSONPairEnumerator;
  Value: string;
  JsonArray: TJSONArray;
  i: integer;
begin
  Value := '';
  JSON := TJSONObject.ParseJSONValue(stri) As TJSONObject;
  if Assigned(JSON) then
  begin
    Pairs := JSON.GetEnumerator;
    while Pairs.MoveNext do
    begin
      if Pairs.Current.JsonString.Value = 'result' then
      begin
        GARs := Pairs.Current.JsonValue as TJSONObject;
        JsonArray := GARs.Get(get1).JsonValue as TJSONArray;
        if Assigned(JsonArray) then
        begin
          for i := 0 to JsonArray.Size - 1 do
          begin
            GC := JsonArray.Get(i) as TJSONObject;
            if Assigned(GC) then
            begin
              if Value = '' then
                Value := (GC.Get(field1).JsonValue.Value)
              else
                Value := Value + ', ' + (GC.Get(field1).JsonValue.Value);
            end;
          end;
        end;
      end;
    end;
  end;
  ParsJSON1 := Value;
end;

procedure AddImage(IdHTTP: TIdHTTP; camp, method, client, token,
  imgname: string; base64Binary: AnsiString; SG: TStringGrid; Row: integer);
var
  url, JSON, api: string;
  sResponse, rezult: string;
  JsonToSend: TStringStream;
begin
  api := 'api';
  IdHTTP.Request.CustomHeaders.Clear;
  IdHTTP.Request.CustomHeaders.Add('POST /json/v5/' + camp + '/ HTTP/1.1');
  IdHTTP.Request.CustomHeaders.Add('Referer: https://' + api +
    '.direct.yandex.com/json/v5/' + camp);
  IdHTTP.Request.CustomHeaders.Add
    ('Content-Type: application/json; charset=utf-8');
  IdHTTP.Request.CustomHeaders.Add('Client-Login: ' + client);
  IdHTTP.Request.CustomHeaders.Add('Accept-Language: ru');
  IdHTTP.Request.CustomHeaders.Add('Host: ' + api + '.direct.yandex.com');
  IdHTTP.Request.CustomHeaders.Add('Authorization: Bearer ' + token);
  url := 'https://' + api + '.direct.yandex.com/json/v5/' + camp;

  JSON := '{"method":"add","params": {"AdImages": [{ "ImageData": ' +
    String(base64Binary) + ', "Name" : "' + imgname + '" } ]}}';

  JsonToSend := TStringStream.Create(JSON, TEncoding.UTF8);
  try
    try
      sResponse := IdHTTP.Post(url, JsonToSend);
    except
      on E: Exception do
        ShowMessage('Error on request: '#13#10 + E.message);
    end;
  finally
    JsonToSend.Free;
  end;

  // ParsJSON1(sResponse, 'AddResults', 'AdImageHash', rezult);
  rezult := ParsJSON1(sResponse, 'AddResults', 'AdImageHash');
  SG.Cells[31, Row] := rezult;
end;

procedure AddCamp(IdHTTP: TIdHTTP; camp, method, client, token,
  { camptype, } counters, Budget: string; SG: TStringGrid;
  Row: integer { ; rezult: string } );
var
  url, JSON, campname, camptype, rezult: string;
  sResponse, api: string;
  JsonToSend: TStringStream;
  // i, j, kolcamp: integer;
  // b: boolean;
begin
  // ShowMessage(camp+' || '+method+' || '+client+' || '+token+' || '+counters+' || '+Budget);
  api := 'api';
  IdHTTP.Request.CustomHeaders.Clear;
  IdHTTP.Request.CustomHeaders.Add('POST /json/v5/' + camp + '/ HTTP/1.1');
  IdHTTP.Request.CustomHeaders.Add('Referer: https://' + api +
    '.direct.yandex.com/json/v5/' + camp);
  IdHTTP.Request.CustomHeaders.Add
    ('Content-Type: application/json; charset=utf-8');
  IdHTTP.Request.CustomHeaders.Add('Client-Login: ' + client);
  IdHTTP.Request.CustomHeaders.Add('Accept-Language: ru');
  IdHTTP.Request.CustomHeaders.Add('Host: ' + api + '.direct.yandex.com');
  IdHTTP.Request.CustomHeaders.Add('Authorization: Bearer ' + token);
  url := 'https://' + api + '.direct.yandex.com/json/v5/' + camp;
  // ------------------------------------------------------------------------------

  // kolcamp := 0;
  // b := false;
  camptype := SG.Cells[19, Row];
  if camptype = 'poisk' then // if  = camptype
  begin
    JSON := '{"method":"' + method + '","params":{"Campaigns": [';
    (* for i := nr to SG.RowCount-1 do
      begin
      campname := SG.Cells[13, i];
      if campname<>'' then
      begin
      if i>0 then
      begin
      if wasstrfullT2(campname, SG, 13, i-1)>-1 then
      begin
      continue;
      end
      else
      begin
      if b then
      begin
      Json := Json + ', {"Name":"'
      + campname + '", "StartDate":"' + FormatDateTime('yyyy-mm-dd', Now) + '", '
      + '"DailyBudget": { "Amount" : "' + Budget + '000000", "Mode" : "STANDARD" }, "TextCampaign": { "BiddingStrategy" :'
      + ' { "Search" : { "BiddingStrategyType": "HIGHEST_POSITION" } , "Network" : {"BiddingStrategyType": "SERVING_OFF"} }, "Settings": [{"Option": "ADD_METRICA_TAG","Value": "YES"},'
      + ' {"Option": "ENABLE_BEHAVIORAL_TARGETING","Value": "NO"},{"Option": "ENABLE_SITE_MONITORING","Value": "YES"},{"Option": "EXCLUDE_PAUSED_COMPETING_ADS","Value": "YES"}],'
      + ' "CounterIds": { "Items": [' + counters + ']} }  }';
      end
      else
      begin
      Json := Json + '{"Name":"'
      + campname + '", "StartDate":"' + FormatDateTime('yyyy-mm-dd', Now) + '", '
      + '"DailyBudget": { "Amount" : "' + Budget + '000000", "Mode" : "STANDARD" }, "TextCampaign": { "BiddingStrategy" :'
      + ' { "Search" : { "BiddingStrategyType": "HIGHEST_POSITION" } , "Network" : {"BiddingStrategyType": "SERVING_OFF"} }, "Settings": [{"Option": "ADD_METRICA_TAG","Value": "YES"},'
      + ' {"Option": "ENABLE_BEHAVIORAL_TARGETING","Value": "NO"},{"Option": "ENABLE_SITE_MONITORING","Value": "YES"},{"Option": "EXCLUDE_PAUSED_COMPETING_ADS","Value": "YES"}],'
      + ' "CounterIds": { "Items": [' + counters + ']} }  }';
      b:=true;
      end;
      inc(kolcamp);
      if kolcamp=10 then
      break;
      end;
      end
      else
      begin
      Json := Json + '{"Name":"'
      + campname + '", "StartDate":"' + FormatDateTime('yyyy-mm-dd', Now) + '", '
      + '"DailyBudget": { "Amount" : "' + Budget + '000000", "Mode" : "STANDARD" }, "TextCampaign": { "BiddingStrategy" :'
      + ' { "Search" : { "BiddingStrategyType": "HIGHEST_POSITION" } , "Network" : {"BiddingStrategyType": "SERVING_OFF"} }, "Settings": [{"Option": "ADD_METRICA_TAG","Value": "YES"},'
      + ' {"Option": "ENABLE_BEHAVIORAL_TARGETING","Value": "NO"},{"Option": "ENABLE_SITE_MONITORING","Value": "YES"},{"Option": "EXCLUDE_PAUSED_COMPETING_ADS","Value": "YES"}],'
      + ' "CounterIds": { "Items": [' + counters + ']} }  }';
      kolcamp := 1;
      end;
      end;
      end; *)
    campname := SG.Cells[13, Row];
    JSON := JSON + '{"Name":"' + campname + '", "StartDate":"' +
      FormatDateTime('yyyy-mm-dd', Now) + '", ' +
      '"DailyBudget": { "Amount" : "' + Budget +
      '000000", "Mode" : "STANDARD" }, "TextCampaign": { "BiddingStrategy" :' +
      ' { "Search" : { "BiddingStrategyType": "HIGHEST_POSITION" } , "Network" : {"BiddingStrategyType": "SERVING_OFF"} }, "Settings": [{"Option": "ADD_METRICA_TAG","Value": "YES"},'
      + ' {"Option": "ENABLE_BEHAVIORAL_TARGETING","Value": "NO"},{"Option": "ENABLE_SITE_MONITORING","Value": "YES"},{"Option": "EXCLUDE_PAUSED_COMPETING_ADS","Value": "YES"}],'
      + ' "CounterIds": { "Items": [' + counters + ']} }  }';

    JSON := JSON + ']}}';
  end
  else if camptype = 'rsy' then
  begin // не изменена

    JSON := '{"method":"' + method + '","params":{"Campaigns": [{"Name":"' +
      campname + '", "StartDate":"' + FormatDateTime('yyyy-mm-dd', Now) + '", '
      + '"DailyBudget": { "Amount" : "' + Budget +
      '000000", "Mode" : "STANDARD" }, "TextCampaign": { "BiddingStrategy" :' +
      ' { "Search" : { "BiddingStrategyType": "SERVING_OFF" }, "Network" : {"BiddingStrategyType": "NETWORK_DEFAULT"} } }, "Settings": [{"Option": "ADD_METRICA_TAG","Value": "YES"},'
      + ' {"Option": "ENABLE_AREA_OF_INTEREST_TARGETING","Value": "NO"},{"Option": "ENABLE_SITE_MONITORING","Value": "YES"},{"Option": "EXCLUDE_PAUSED_COMPETING_ADS","Value": "YES"}],'
      + ' "CounterIds": { "Items": [' + counters +
      ']},  "RelevantKeywords": {"BudgetPercent": 0, "OptimizeGoalId": null } }] }}';
  end;
  // ------------------------------------------------------------------------------

  JsonToSend := TStringStream.Create(JSON, TEncoding.UTF8);
  try
    try
      sResponse := IdHTTP.Post(url, JsonToSend);
    except
      on E: Exception do
        ShowMessage('Error on request: '#13#10 + E.message);
    end;
  finally
    JsonToSend.Free;
  end;

  rezult := ParsJSON1(sResponse, 'AddResults', 'Id');
  if camptype = 'poisk' then
  begin
    SG.Cells[15, Row] := rezult;
  end;
end;

function GetCamp(IdHTTP: TIdHTTP; camp, method, client, token: string): string;
var
  url, JSON: string;
  sResponse, api: string;
  JsonToSend: TStringStream;
begin
  api := 'api';
  IdHTTP.Request.CustomHeaders.Clear;
  IdHTTP.Request.CustomHeaders.Add('POST /json/v5/' + camp + '/ HTTP/1.1');
  IdHTTP.Request.CustomHeaders.Add('Referer: https://' + api +
    '.direct.yandex.com/json/v5/' + camp);
  IdHTTP.Request.CustomHeaders.Add
    ('Content-Type: application/json; charset=utf-8');
  IdHTTP.Request.CustomHeaders.Add('Client-Login: ' + client);
  IdHTTP.Request.CustomHeaders.Add('Accept-Language: ru');
  IdHTTP.Request.CustomHeaders.Add('Host: ' + api + '.direct.yandex.com');
  IdHTTP.Request.CustomHeaders.Add('Authorization: Bearer ' + token);
  url := 'https://' + api + '.direct.yandex.com/json/v5/' + camp;
  // ------------------------------------------------------------------------------

  JSON := '{"method":"get","params":{"SelectionCriteria": {"States": ["OFF"]}, "FieldNames": ["Id", "Name"]} }';

  // ------------------------------------------------------------------------------
  JsonToSend := TStringStream.Create(JSON, TEncoding.UTF8);
  try
    try
      sResponse := IdHTTP.Post(url, JsonToSend);
    except
      on E: Exception do
        ShowMessage('Error on request: '#13#10 + E.message);
    end;
  finally
    JsonToSend.Free;
  end;
  GetCamp := sResponse;
end;

function GetGroup(IdHTTP: TIdHTTP; camp, method, client, token,
  campid: string): string;
var
  url, JSON: string;
  sResponse, api: string;
  JsonToSend: TStringStream;
begin
  api := 'api';
  IdHTTP.Request.CustomHeaders.Clear;
  IdHTTP.Request.CustomHeaders.Add('POST /json/v5/' + camp + '/ HTTP/1.1');
  IdHTTP.Request.CustomHeaders.Add('Referer: https://' + api +
    '.direct.yandex.com/json/v5/' + camp);
  IdHTTP.Request.CustomHeaders.Add
    ('Content-Type: application/json; charset=utf-8');
  IdHTTP.Request.CustomHeaders.Add('Client-Login: ' + client);
  IdHTTP.Request.CustomHeaders.Add('Accept-Language: ru');
  IdHTTP.Request.CustomHeaders.Add('Host: ' + api + '.direct.yandex.com');
  IdHTTP.Request.CustomHeaders.Add('Authorization: Bearer ' + token);
  url := 'https://' + api + '.direct.yandex.com/json/v5/' + camp;
  // ------------------------------------------------------------------------------

  JSON := '{"method":"get","params":{"SelectionCriteria": {"CampaignIds": [' +
    campid + ']}, "FieldNames": ["Id", "Name"]} }';

  // ------------------------------------------------------------------------------
  JsonToSend := TStringStream.Create(JSON, TEncoding.UTF8);
  try
    try
      sResponse := IdHTTP.Post(url, JsonToSend);
    except
      on E: Exception do
        ShowMessage('Error on request: '#13#10 + E.message);
    end;
  finally
    JsonToSend.Free;
  end;
  GetGroup := sResponse;
end;

procedure AddGroup(IdHTTP: TIdHTTP; camp, method, client, token,
  regions: string; minus: TMemo; SG: TStringGrid; Row: integer);
var
  url, JSON, rezult: string;
  sResponse, api: string;
  JsonToSend: TStringStream;
begin
  api := 'api';
  IdHTTP.Request.CustomHeaders.Clear;
  IdHTTP.Request.CustomHeaders.Add('POST /json/v5/' + camp + '/ HTTP/1.1');
  IdHTTP.Request.CustomHeaders.Add('Referer: https://' + api +
    '.direct.yandex.com/json/v5/' + camp);
  IdHTTP.Request.CustomHeaders.Add
    ('Content-Type: application/json; charset=utf-8');
  IdHTTP.Request.CustomHeaders.Add('Client-Login: ' + client);
  IdHTTP.Request.CustomHeaders.Add('Accept-Language: ru');
  IdHTTP.Request.CustomHeaders.Add('Host: ' + api + '.direct.yandex.com');
  IdHTTP.Request.CustomHeaders.Add('Authorization: Bearer ' + token);
  url := 'https://' + api + '.direct.yandex.com/json/v5/' + camp;
  // ------------------------------------------------------------------------------

  // idcamp

  JSON := '{"method":"add","params":{"AdGroups": [{"Name":"' + SG.Cells[14, Row]
    + '", "CampaignId":' + SG.Cells[15, Row] + ', ' + '"RegionIds": [' +
    StringReplace(regions, '%2C', ', ', [rfReplaceAll]) + ']';
  // Изменить добавление регионов //Изменил)

  (* if minus.Lines.Count > 0 then
    begin
    JSON := JSON + ', "NegativeKeywords": { "Items" : [';
    // for
    for i := 0 to minus.Lines.Count - 1 do
    begin
    if minus.Lines.Strings[i] <> '' then
    begin
    if i = 0 then
    JSON := JSON + '"' + minus.Lines.Strings[i] + '"'
    else
    JSON := JSON + ', "' + minus.Lines.Strings[i] + '"';
    end;
    end;
    JSON := JSON + ']}';
    end;
    // endfor *)
  JSON := JSON + ' }] }}';

  // ------------------------------------------------------------------------------
  JsonToSend := TStringStream.Create(JSON, TEncoding.UTF8);
  try
    try
      sResponse := IdHTTP.Post(url, JsonToSend);
    except
      on E: Exception do
        ShowMessage('Error on request: '#13#10 + E.message);
    end;
  finally
    JsonToSend.Free;
  end;

  rezult := ParsJSON1(sResponse, 'AddResults', 'Id');
  SG.Cells[16, Row] := rezult;
end;

function AddSiteLinks(IdHTTP: TIdHTTP; camp, method, client, token,
  href: string; texts, urls: TMemo): string;
var
  url, JSON: string;
  sResponse, api, rezult: string;
  JsonToSend: TStringStream;
  i: integer;
begin
  api := 'api';
  IdHTTP.Request.CustomHeaders.Clear;
  IdHTTP.Request.CustomHeaders.Add('POST /json/v5/' + camp + '/ HTTP/1.1');
  IdHTTP.Request.CustomHeaders.Add('Referer: https://' + api +
    '.direct.yandex.com/json/v5/' + camp);
  IdHTTP.Request.CustomHeaders.Add
    ('Content-Type: application/json; charset=utf-8');
  IdHTTP.Request.CustomHeaders.Add('Client-Login: ' + client);
  IdHTTP.Request.CustomHeaders.Add('Accept-Language: ru');
  IdHTTP.Request.CustomHeaders.Add('Host: ' + api + '.direct.yandex.com');
  IdHTTP.Request.CustomHeaders.Add('Authorization: Bearer ' + token);
  url := 'https://' + api + '.direct.yandex.com/json/v5/' + camp;
  // ------------------------------------------------------------------------------
  // Добавить различные JSON возможно //походу это все надо в таймер

  JSON := '{"method":"' + method +
    '","params":{"SitelinksSets": [{ "Sitelinks": [';
  for i := 0 to texts.Lines.Count - 1 do
  begin
    if i = 0 then
    begin
      JSON := JSON + '{"Title" : "' + texts.Lines.Strings[i] + '", "Href" : "';
      if urls.Lines.Count = texts.Lines.Count then
        JSON := JSON + urls.Lines.Strings[i] + '"}'
      else
        JSON := JSON + href + '#' + inttostr(i) + '"}';
    end
    else
    begin
      JSON := JSON + ', {"Title" : "' + texts.Lines.Strings[i] +
        '", "Href" : "';
      if urls.Lines.Count = texts.Lines.Count then
        JSON := JSON + urls.Lines.Strings[i] + '"}'
      else
        JSON := JSON + href + '#' + inttostr(i) + '"}';
    end;
  end;
  JSON := JSON + ']}]}}';

  // ------------------------------------------------------------------------------
  JsonToSend := TStringStream.Create(JSON, TEncoding.UTF8);
  try
    try
      sResponse := IdHTTP.Post(url, JsonToSend);
    except
      on E: Exception do
        ShowMessage('Error on request: '#13#10 + E.message);
    end;
  finally
    JsonToSend.Free;
  end;
  rezult := ParsJSON1(sResponse, 'AddResults', 'Id');
  // SG.Cells[16, row] := rezult;
  // ShowMessage(rezult + ' " '+sResponse);
end;

function phoneGetCountry(Phone: string): String;
begin
  phoneGetCountry := Copy(Phone, 1, pos('(', Phone) - 1);
end;

function phoneGetCity(Phone: string): String;
begin
  phoneGetCity := Copy(Phone, pos('(', Phone) + 1, pos(')', Phone) - pos('(',
    Phone) - 1);
end;

function phoneGetNumb(Phone: string): String;
begin
  if pos(':', Phone) > 0 then
    phoneGetNumb := Copy(Phone, pos(')', Phone) + 1, pos(':', Phone) - pos(')',
      Phone) - 1)
  else
    phoneGetNumb := Copy(Phone, pos(')', Phone) + 1,
      Phone.length - pos(')', Phone));
end;

function phoneGetCountry2(Phone: string): String;
begin
  phoneGetCountry2 := Copy(Phone, 1, 1);
end;

function phoneGetCity2(Phone: string): String;
begin
  phoneGetCity2 := Copy(Phone, 2, 3);
end;

function phoneGetNumb2(Phone: string): String;
begin
  phoneGetNumb2 := Copy(Phone, 5, 7);
end;

function phoneGetExt(Phone: string): String;
begin
  if pos(':', Phone) > 0 then
    phoneGetExt := Copy(Phone, pos(':', Phone) + 1,
      Phone.length - pos(':', Phone))
  else
    phoneGetExt := '';
end;

function DateFrmt(WorkTime: TMemo): string;
var
  worktimestr: string;
  i: integer;
begin
  worktimestr := ''; // пн-вс 08:00-20:00
  for i := 0 to WorkTime.Lines.Count - 1 do
  begin
    if worktimestr <> '' then
    begin
      worktimestr := worktimestr + ';' + Copy(WorkTime.Lines.Strings[i], 1, 2) +
        ';' + Copy(WorkTime.Lines.Strings[i], 4, 2) + ';';
      if Copy(WorkTime.Lines.Strings[i], 7, 1) = '0' then
        worktimestr := worktimestr + Copy(WorkTime.Lines.Strings[i], 8, 1) + ';'
      else
        worktimestr := worktimestr + Copy(WorkTime.Lines.Strings[i], 7,
          2) + ';';
      if Copy(WorkTime.Lines.Strings[i], 10, 1) = '0' then
        worktimestr := worktimestr + Copy(WorkTime.Lines.Strings[i],
          11, 1) + ';'
      else
        worktimestr := worktimestr + Copy(WorkTime.Lines.Strings[i],
          10, 2) + ';';
      if Copy(WorkTime.Lines.Strings[i], 13, 1) = '0' then
        worktimestr := worktimestr + Copy(WorkTime.Lines.Strings[i],
          14, 1) + ';'
      else
        worktimestr := worktimestr + Copy(WorkTime.Lines.Strings[i],
          13, 2) + ';';
      if Copy(WorkTime.Lines.Strings[i], 16, 1) = '0' then
        worktimestr := worktimestr + Copy(WorkTime.Lines.Strings[i], 17, 1)
      else
        worktimestr := worktimestr + Copy(WorkTime.Lines.Strings[i], 16, 2);
    end
    else
    begin
      worktimestr := Copy(WorkTime.Lines.Strings[i], 1, 2) + ';' +
        Copy(WorkTime.Lines.Strings[i], 4, 2) + ';';
      if Copy(WorkTime.Lines.Strings[i], 7, 1) = '0' then
        worktimestr := worktimestr + Copy(WorkTime.Lines.Strings[i], 8, 1) + ';'
      else
        worktimestr := worktimestr + Copy(WorkTime.Lines.Strings[i], 7,
          2) + ';';
      if Copy(WorkTime.Lines.Strings[i], 10, 1) = '0' then
        worktimestr := worktimestr + Copy(WorkTime.Lines.Strings[i],
          11, 1) + ';'
      else
        worktimestr := worktimestr + Copy(WorkTime.Lines.Strings[i],
          10, 2) + ';';
      if Copy(WorkTime.Lines.Strings[i], 13, 1) = '0' then
        worktimestr := worktimestr + Copy(WorkTime.Lines.Strings[i],
          14, 1) + ';'
      else
        worktimestr := worktimestr + Copy(WorkTime.Lines.Strings[i],
          13, 2) + ';';
      if Copy(WorkTime.Lines.Strings[i], 16, 1) = '0' then
        worktimestr := worktimestr + Copy(WorkTime.Lines.Strings[i], 17, 1)
      else
        worktimestr := worktimestr + Copy(WorkTime.Lines.Strings[i], 16, 2);
    end;
  end;
  worktimestr := StringReplace(worktimestr, 'пн', '0', [rfReplaceAll]);
  worktimestr := StringReplace(worktimestr, 'вт', '1', [rfReplaceAll]);
  worktimestr := StringReplace(worktimestr, 'ср', '2', [rfReplaceAll]);
  worktimestr := StringReplace(worktimestr, 'чт', '3', [rfReplaceAll]);
  worktimestr := StringReplace(worktimestr, 'пт', '4', [rfReplaceAll]);
  worktimestr := StringReplace(worktimestr, 'сб', '5', [rfReplaceAll]);
  worktimestr := StringReplace(worktimestr, 'вс', '6', [rfReplaceAll]);
  DateFrmt := worktimestr;
end;

procedure AddAds(IdHTTP: TIdHTTP; camp, method, client, token, href,
  DisplayUrlPath: string; mobile: boolean;
  SG { , AdExtensionIds } : TStringGrid; Row: integer);
var
  url, JSON: string;
  sResponse, api { , rezult } : string;
  JsonToSend: TStringStream;
  // i: integer;
  // sl: TStringList;
begin
  api := 'api';
  IdHTTP.Request.CustomHeaders.Clear;
  IdHTTP.Request.CustomHeaders.Add('POST /json/v5/' + camp + '/ HTTP/1.1');
  IdHTTP.Request.CustomHeaders.Add('Referer: https://' + api +
    '.direct.yandex.com/json/v5/' + camp);
  IdHTTP.Request.CustomHeaders.Add
    ('Content-Type: application/json; charset=utf-8');
  IdHTTP.Request.CustomHeaders.Add('Client-Login: ' + client);
  IdHTTP.Request.CustomHeaders.Add('Accept-Language: ru');
  IdHTTP.Request.CustomHeaders.Add('Host: ' + api + '.direct.yandex.com');
  IdHTTP.Request.CustomHeaders.Add('Authorization: Bearer ' + token);
  url := 'https://' + api + '.direct.yandex.com/json/v5/' + camp;
  // ------------------------------------------------------------------------------
  // Составление текста сделать отдельно с контролем длины
  // ShowMessage(href+' '+DisplayUrlPath);
  JSON := '{"method":"add","params":{"Ads": [{"TextAd": { "Title": "' +
    SG.Cells[7, Row] + '", "Title2": "' + SG.Cells[8, Row] + '", "Text": "' +
    SG.Cells[9, Row] + '. ' + SG.Cells[10, Row] + '! ' + SG.Cells[11, Row] + ' '
    + SG.Cells[12, Row] + '"' + ', "Href": "' + href + '"';
  if mobile then
    JSON := JSON + ', "Mobile": ' + '"YES"'
  else
    JSON := JSON + ', "Mobile": ' + '"NO"';
  if DisplayUrlPath <> '' then
    JSON := JSON + ', "DisplayUrlPath": "' + DisplayUrlPath + '"';
  if SG.Cells[23, Row] <> '' then
    JSON := JSON + ', "VCardId": ' + SG.Cells[23, Row];
  if SG.Cells[24, Row] <> '' then
    JSON := JSON + ', "SitelinkSetId": ' + SG.Cells[24, Row];
  { if AdExtensionIds.RowCount>0 then
    begin
    Json := Json + ', "AdExtensionIds": [';
    for i := 0 to AdExtensionIds.RowCount - 1 do
    begin
    if i = 0 then
    Json := Json + '"' + AdExtensionIds.Cells[1, i] + '"'
    else
    Json := Json + ', "' + AdExtensionIds.Cells[1, i] + '"';
    end;
    Json := Json + ']';
    end; }
  if SG.Cells[25, Row] <> '' then // Додумать с расширениями одноразовая версия
    JSON := JSON + ', "AdExtensionIds": [' + SG.Cells[25, Row] + ']';
  JSON := JSON + '}, "AdGroupId": ' + SG.Cells[16, Row] + ' }] } }';

  // ------------------------------------------------------------------------------
  JsonToSend := TStringStream.Create(JSON, TEncoding.UTF8);
  try
    try
      sResponse := IdHTTP.Post(url, JsonToSend);
    except
      on E: Exception do
        ShowMessage('Error on request: '#13#10 + E.message);
    end;
  finally
    JsonToSend.Free;
  end;
  ShowMessage(SG.Cells[26, Row] + ' " ' + sResponse);
  SG.Cells[26, Row] := ParsJSON1(sResponse, 'AddResults', 'Id');
  // ShowMessage(SG.Cells[26, row]  + ' " '+sResponse);
end;

procedure AddVCards(IdHTTP: TIdHTTP; camp, method, client, token, City,
  kompania, Phone, Ulica, dom, korpus, ofis, metro, familiya, imya, otchestvo,
  KontEmail, ogrn: string; WorkTime, Addi: TMemo; SG: TStringGrid;
  Row: integer);
var
  url, JSON, worktimestr, addistr, icq, icqnumb, fio: string;
  sResponse, api: string;
  JsonToSend: TStringStream;
  i: integer;
begin
  worktimestr := DateFrmt(WorkTime); // пн-вс 08:00-20:00

  addistr := '';
  for i := 1 to Addi.Lines.Count - 1 do
  begin
    if addistr <> '' then
      addistr := addistr + ' ' + Addi.Lines.Strings[i]
    else
      addistr := Addi.Lines.Strings[i];
  end;
  DelSpace(addistr);
  StringReplace(addistr, #13#10, ' ', [rfReplaceAll]);

  icq := '';
  icqnumb := '';
  fio := familiya + ' ' + imya + ' ' + otchestvo;

  api := 'api';
  IdHTTP.Request.CustomHeaders.Clear;
  IdHTTP.Request.CustomHeaders.Add('POST /json/v5/' + camp + '/ HTTP/1.1');
  IdHTTP.Request.CustomHeaders.Add('Referer: https://' + api +
    '.direct.yandex.com/json/v5/' + camp);
  IdHTTP.Request.CustomHeaders.Add
    ('Content-Type: application/json; charset=utf-8');
  IdHTTP.Request.CustomHeaders.Add('Client-Login: ' + client);
  IdHTTP.Request.CustomHeaders.Add('Accept-Language: ru');
  IdHTTP.Request.CustomHeaders.Add('Host: ' + api + '.direct.yandex.com');
  IdHTTP.Request.CustomHeaders.Add('Authorization: Bearer ' + token);
  url := 'https://' + api + '.direct.yandex.com/json/v5/' + camp;
  // ----------------------------------------------------------------------------
  // ShowMessage(method+'| '+SG.Cells[15, row]+'| '+City+' '+kompania+'! '+worktimestr+'! '+phoneGetCountry(Phone)+'! '+phoneGetCity(Phone)+'! '+phoneGetNumb(Phone)+  '! '+phoneGetExt(Phone)+'! '+Ulica+'! '+dom+'! '+korpus+'! '+ofis+'! '+icq+'! '+icqnumb+'! '+addistr+'! '+KontEmail+'! '+ogrn+'! '+metro+'! '+fio);
  // idcamp := SG.Cells[15, 0]
  (* vr := '{"method":"add","params":{"VCards": [{ "CampaignId": '+SG.Cells[15, row]+', "Country" : "Россия", "City" : "' + City +'",'+
    '"CompanyName" : "' + kompania + '","WorkTime" : "0;6;9;0;21;0",'+
    '"Phone" : {"CountryCode": "+7", "CityCode" : "917", "PhoneNumber": "4688000"}, "Street": "' + Ulica + '", "House": "' + dom + '", "Building": "' + korpus + '",'+
    //'"ExtraMessage":"' + addistr + '",'+
    '"ContactEmail":"' + KontEmail + '", "Ogrn": "1140280012179", "ContactPerson": "' + fio + '"} ]}}'; *)
  // b := false;
  (* if phoneGetExt(Phone) <> '' then
    JSON := JSON + ', "Extension": "' + phoneGetExt(Phone) + '"}'
    else
    JSON := JSON + '}'; *)
  JSON := '{"method":"' + method + '","params":{"VCards": [';
  JSON := JSON + '{ "CampaignId": ' + SG.Cells[15, Row];
  JSON := JSON + ', ' + '"Country" : "Россия", "City" : "' + City +
    '", "CompanyName" : "' + kompania + '",' + '"WorkTime" : "' + worktimestr +
    '", "Phone" : {"CountryCode": "+' + phoneGetCountry2(Phone) +
    '", "CityCode" : "' + phoneGetCity2(Phone) + '", ' + '"PhoneNumber": "' +
    phoneGetNumb2(Phone) + '"}';

  JSON := JSON + ', "Street": "' + Ulica + '", "House": "' + dom + '"';
  if korpus <> '' then
    JSON := JSON + ', ' + '"Building": "' + korpus + '"';
  if ofis <> '' then
    JSON := JSON + ', "Apartment": "' + ofis + '"';
  if (icq <> '') and (icqnumb <> '') then
    JSON := JSON + ', "InstantMessenger": {"MessengerClient":"' + icq + '", ' +
      '"MessengerLogin":"' + icqnumb + '"}';
  if addistr <> '' then
    JSON := JSON + ', "ExtraMessage":"' + addistr + '"';
  JSON := JSON + ', "ContactEmail":"' + KontEmail + '"';
  JSON := JSON + ', ' + '"Ogrn": "' + ogrn + '"';
  if metro <> '' then
    JSON := JSON + ', "MetroStationId":"' + metro + '"';
  JSON := JSON + ', "ContactPerson": "' + fio + '"}';

  (* for I := 0 to SG.RowCount - 2 do
    begin
    if (SG.Cells[5, i] = '1') and (SG.Cells[15, i] <> '') then
    begin
    if b then
    begin
    if wasstrfullT32(SG.Cells[15, i],SG,15,0,i-1) then
    begin
    JSON := JSON + ',{ "CampaignId": "' + SG.Cells[15, i] + vr;
    end;
    end
    else
    begin
    JSON := JSON + '{ "CampaignId": "' +
    SG.Cells[15, i];
    vr := '", ' + '"Country" : "Россия", "City" : "' + City +
    '", "CompanyName" : "' + kompania + '",' + '"WorkTime" : "' + worktimestr +
    '", "Phone" : {"CountryCode": "+' + phoneGetCountry2(Phone) +
    '", "CityCode" : "' + phoneGetCity2(Phone) + '", ' + '"PhoneNumber": "' +
    phoneGetNumb2(Phone) + '"}';
    if phoneGetExt(Phone) <> '' then
    JSON := JSON + ', "Extension": "' + phoneGetExt(Phone) + '"}'
    else
    JSON := JSON + '}';
    vr := vr + ', "Street": "' + Ulica + '", "House": "' + dom + '"';
    if korpus <> '' then
    vr := vr + ', ' + '"Building": "' + korpus + '"';
    if ofis <> '' then
    vr := vr + ', "Apartment": "' + ofis + '"';
    if (icq <> '') and (icqnumb <> '') then
    vr := vr + ', "InstantMessenger": {"MessengerClient":"' + icq + '", ' +
    '"MessengerLogin":"' + icqnumb + '"}';
    if addistr <> '' then
    vr := vr + ', "ExtraMessage":"' + addistr + '"';
    vr := vr + ', "ContactEmail":"' + KontEmail + '"';
    vr := vr + ', ' + '"Ogrn": "' + ogrn + '"';
    if metro <> '' then
    vr := vr + ', "MetroStationId":"' + metro + '"';
    vr := vr + ', "ContactPerson": "' + fio + '"}';
    JSON := JSON + vr;
    b := true;
    end;
    end;
    if i mod 15 = 0 then
    begin
    //ShowMessage(method);
    Application.ProcessMessages;
    end;
    end; *)
  JSON := JSON + ']}}';

  // ------------------------------------------------------------------------------
  JsonToSend := TStringStream.Create(JSON, TEncoding.UTF8);
  try
    try
      sResponse := IdHTTP.Post(url, JsonToSend);
    except
      on E: Exception do
        ShowMessage('Error on request: '#13#10 + E.message);
    end;
  finally
    JsonToSend.Free;
  end;
  // ShowMessage(sResponse);
  SG.Cells[22, Row] := JSON;
  SG.Cells[23, Row] := ParsJSON1(sResponse, 'AddResults', 'Id');
  // AddVCards := rezult;
end;
/// 11.3 ' ' 36291452 605401650 3538350, 3538349, 3538348

function AddFastLinks(IdHTTP: TIdHTTP; camp, method, client, token: string;
  AdsFasts, adsfastsurl: TMemo): string;
var
  // url, Json, worktimestr, addistr, icq, icqnumb, fio: string;
  JSON, sResponse, url, api, rezult: string;
  JsonToSend: TStringStream;
  i: integer;
begin
  api := 'api';
  IdHTTP.Request.CustomHeaders.Clear;
  IdHTTP.Request.CustomHeaders.Add('POST /json/v5/' + camp + '/ HTTP/1.1');
  IdHTTP.Request.CustomHeaders.Add('Referer: https://' + api +
    '.direct.yandex.com/json/v5/' + camp);
  IdHTTP.Request.CustomHeaders.Add
    ('Content-Type: application/json; charset=utf-8');
  IdHTTP.Request.CustomHeaders.Add('Client-Login: ' + client);
  IdHTTP.Request.CustomHeaders.Add('Accept-Language: ru');
  IdHTTP.Request.CustomHeaders.Add('Host: ' + api + '.direct.yandex.com');
  IdHTTP.Request.CustomHeaders.Add('Authorization: Bearer ' + token);
  url := 'https://' + api + '.direct.yandex.com/json/v5/' + camp;

  JSON := '{"method":"add","params":{"SitelinksSets": [{ "Sitelinks": [';
  for i := 0 to AdsFasts.Lines.Count - 1 do
  begin
    if i = AdsFasts.Lines.Count - 1 then
      JSON := JSON + '{"Title" :"' + AdsFasts.Lines.Strings[i] + '", "Href" : "'
        + adsfastsurl.Lines.Strings[i] + '"}'
    else
      JSON := JSON + '{"Title" :"' + AdsFasts.Lines.Strings[i] + '", "Href" : "'
        + adsfastsurl.Lines.Strings[i] + '"}, ';
  end;
  JSON := JSON + ']} ]}}';

  // -----------------------------------------------------------------------------
  JsonToSend := TStringStream.Create(JSON, TEncoding.UTF8);
  try
    try
      sResponse := IdHTTP.Post(url, JsonToSend);
    except
      on E: Exception do
        ShowMessage('Error on request: '#13#10 + E.message);
    end;
  finally
    JsonToSend.Free;
  end;
  rezult := ParsJSON1(sResponse, 'AddResults', 'Id');
  AddFastLinks := rezult;
  // ShowMessage(rezult  + ' " '+sResponse);
end;

function AddExtensions(IdHTTP: TIdHTTP; camp, method, client, token: string;
  AdsExt: TMemo): string;
var
  // url, Json, worktimestr, addistr, icq, icqnumb, fio: string;
  JSON, sResponse, url, api, rezult: string;
  JsonToSend: TStringStream;
  i: integer;
begin
  api := 'api';
  IdHTTP.Request.CustomHeaders.Clear;
  IdHTTP.Request.CustomHeaders.Add('POST /json/v5/' + camp + '/ HTTP/1.1');
  IdHTTP.Request.CustomHeaders.Add('Referer: https://' + api +
    '.direct.yandex.com/json/v5/' + camp);
  IdHTTP.Request.CustomHeaders.Add
    ('Content-Type: application/json; charset=utf-8');
  IdHTTP.Request.CustomHeaders.Add('Client-Login: ' + client);
  IdHTTP.Request.CustomHeaders.Add('Accept-Language: ru');
  IdHTTP.Request.CustomHeaders.Add('Host: ' + api + '.direct.yandex.com');
  IdHTTP.Request.CustomHeaders.Add('Authorization: Bearer ' + token);
  url := 'https://' + api + '.direct.yandex.com/json/v5/' + camp;
  // -----------------------------------------------------------------------------

  JSON := '{ "method": "add", "params": { "AdExtensions": [';
  for i := 0 to AdsExt.Lines.Count - 1 do
    if i = AdsExt.Lines.Count - 1 then
      JSON := JSON + '{ "Callout": { "CalloutText": "' + AdsExt.Lines.Strings
        [i] + '"} }'
    else
      JSON := JSON + '{ "Callout": { "CalloutText": "' + AdsExt.Lines.Strings[i]
        + '"} }, ';
  JSON := JSON + '] } }';

  // -----------------------------------------------------------------------------
  JsonToSend := TStringStream.Create(JSON, TEncoding.UTF8);
  try
    try
      sResponse := IdHTTP.Post(url, JsonToSend);
    except
      on E: Exception do
        ShowMessage('Error on request: '#13#10 + E.message);
    end;
  finally
    JsonToSend.Free;
  end;
  rezult := ParsJSON1(sResponse, 'AddResults', 'Id');
  AddExtensions := rezult;
  // тут не все так просто, здесь в ответ приходит несколько id //вроде сделал) через запятую = легко вносить в JSON
  // ShowMessage(rezult  + ' " '+sResponse);
end;

procedure AddKeywords(IdHTTP: TIdHTTP; camp, method, client, token: string;
  SG: TStringGrid; Row: integer);
var
  // url, Json, worktimestr, addistr, icq, icqnumb, fio: string;
  JSON, sResponse, url, api: string;
  JsonToSend: TStringStream;
  // i: integer;
begin
  api := 'api';
  IdHTTP.Request.CustomHeaders.Clear;
  IdHTTP.Request.CustomHeaders.Add('POST /json/v5/' + camp + '/ HTTP/1.1');
  IdHTTP.Request.CustomHeaders.Add('Referer: https://' + api +
    '.direct.yandex.com/json/v5/' + camp);
  IdHTTP.Request.CustomHeaders.Add
    ('Content-Type: application/json; charset=utf-8');
  IdHTTP.Request.CustomHeaders.Add('Client-Login: ' + client);
  IdHTTP.Request.CustomHeaders.Add('Accept-Language: ru');
  IdHTTP.Request.CustomHeaders.Add('Host: ' + api + '.direct.yandex.com');
  IdHTTP.Request.CustomHeaders.Add('Authorization: Bearer ' + token);
  url := 'https://' + api + '.direct.yandex.com/json/v5/' + camp;
  // -----------------------------------------------------------------------------

  JSON := '{"method":"add","params":{"Keywords": [{"Keyword": "' +
    SG.Cells[4, Row] + ' ' + SG.Cells[6, Row] + '", "AdGroupId": ' +
    SG.Cells[16, Row];
  if SG.Cells[20, Row] <> '' then
    JSON := JSON + ', "Bid": ' + floattostr(strtofloat(SG.Cells[20, Row])
      * 1000000);
  if SG.Cells[21, Row] <> '' then
    JSON := JSON + ', "ContextBid": ' + floattostr(strtofloat(SG.Cells[21, Row])
      * 1000000);
  { if SG.Cells[22, row] <> '' then
    begin
    if SG.Cells[22, row] = '1' then
    JSON := JSON + ', "StrategyPriority": "LOW"';
    if SG.Cells[22, row] = '2' then }
  JSON := JSON + ', "StrategyPriority": "NORMAL"';
  { if SG.Cells[22, row] = '3' then
    JSON := JSON + ', "StrategyPriority": "HIGH"';
    end; }

  JSON := JSON + ' }] } }';

  // -----------------------------------------------------------------------------
  JsonToSend := TStringStream.Create(JSON, TEncoding.UTF8);
  try
    try
      sResponse := IdHTTP.Post(url, JsonToSend);
    except
      on E: Exception do
        ShowMessage('Error on request: '#13#10 + E.message);
    end;
  finally
    JsonToSend.Free;
  end;
  SG.Cells[17, Row] := ParsJSON1(sResponse, 'AddResults', 'Id');
  // ShowMessage(SG.Cells[17, row]  + ' " '+sResponse);
end;

procedure AdsModerate(IdHTTP: TIdHTTP; camp, method, client, token: string;
  SG: TStringGrid; Row_s, Row_e: integer);
var
  // url, Json, worktimestr, addistr, icq, icqnumb, fio: string;
  JSON, sResponse, url, api, b, rezult: string;
  JsonToSend: TStringStream;
  SL: TStringList;
  i, j: integer;
begin
  api := 'api';
  IdHTTP.Request.CustomHeaders.Clear;
  IdHTTP.Request.CustomHeaders.Add('POST /json/v5/' + camp + '/ HTTP/1.1');
  IdHTTP.Request.CustomHeaders.Add('Referer: https://' + api +
    '.direct.yandex.com/json/v5/' + camp);
  IdHTTP.Request.CustomHeaders.Add
    ('Content-Type: application/json; charset=utf-8');
  IdHTTP.Request.CustomHeaders.Add('Client-Login: ' + client);
  IdHTTP.Request.CustomHeaders.Add('Accept-Language: ru');
  IdHTTP.Request.CustomHeaders.Add('Host: ' + api + '.direct.yandex.com');
  IdHTTP.Request.CustomHeaders.Add('Authorization: Bearer ' + token);
  url := 'https://' + api + '.direct.yandex.com/json/v5/' + camp;
  // -----------------------------------------------------------------------------

  b := '';
  JSON := '{  "method": "moderate",  "params": { "SelectionCriteria": { "Ids": [ ';
  for i := Row_s to Row_e do
  begin
    if (SG.Cells[5, i] = '1') and (SG.Cells[26, i] <> '') and
      (SG.Cells[18, i] <> '0') then
    begin
      JSON := JSON + b + SG.Cells[26, i];
      b := ',';
    end;
  end;
  JSON := JSON + ' ]} } }';

  // -----------------------------------------------------------------------------
  JsonToSend := TStringStream.Create(JSON, TEncoding.UTF8);
  try
    try
      sResponse := IdHTTP.Post(url, JsonToSend);
    except
      on E: Exception do
        ShowMessage('Error on request: '#13#10 + E.message);
    end;
  finally
    JsonToSend.Free;
  end;
  rezult := ParsJSON1(sResponse, 'ModerateResults', 'Id');
  SL := TStringList.Create;
  SL.Text := StringReplace(rezult, ',', #13#10, [rfReplaceAll]);
  for i := 0 to SL.Count - 1 do
  begin
    for j := Row_s to Row_e do
      if AnsiCompareText(SG.Cells[26, j], SL.Strings[i]) = 0 then
        SG.Cells[18, j] := '0';
    if i mod 5 = 0 then
      Application.ProcessMessages;
  end;
  FreeAndNil(SL);
  // ShowMessage(SG.Cells[17, row]  + ' " '+sResponse);
end;

procedure TForm1.PasteAds;
begin
  { if pos('direct.yandex.ru', frame.Url) > 0 then
    begin
    BRReg.Load('https://direct.yandex.ru/search/?regions=225&text=' +
    SellPhraseMemo.Lines[iSp]); }
  { if adsright_i < KeyCollector.Lines.Count then
    BRReg.Load('https://direct.yandex.ru/search/?regions=' + regions + '&text='
    + KeyCollector.Lines.Strings[adsright_i]); }
  if adsright_i < ColRowsText then
    BRReg.Load('https://direct.yandex.ru/search/?regions=' + regions + '&text='
      + adstextword);
  stage := 31;
  // Тут можно проверять как быстро грузится страница с прокси и если че отправлять на 6665 с увеличением proxy_n
  { if proxybool then
    begin
    if dolgo then
    begin
    inc(proxy_n);
    st:=6665
    end
    else
    st := 25;
    end; }
end;

procedure TForm1.SiteCode;
var
  CefStringVisitor: ICefStringVisitor;
begin
  Memo3.Clear;
  CefStringVisitor := TCefFastStringVisitor.Create(StringVisitor2);
  AdsBR.Browser.GetMainFrame.GetSource(CefStringVisitor);
  stage := 32;
end;

procedure TForm1.TakePageCode(Memo: TMemo; Page: TChromium);
var
  CefStringVisitor: ICefStringVisitor;
begin

  { Memo.Clear;
    CefStringVisitor := TCefFastStringVisitor.Create(StringVisitor3);
    Page.Browser.GetMainFrame.GetSource(CefStringVisitor);
    Memo.Text:=PageM;
    if Memo.Text <> '' then
    st:=2; }
  PageCode.Clear;
  CefStringVisitor := TCefFastStringVisitor.Create(StringVisitor3);
  BRReg.Browser.GetMainFrame.GetSource(CefStringVisitor);
  // Memo.Text:=PageM;
  // if PageCode.Text <> '' then
  // st:=2;
  // Finality.Enabled:=false;
end;

procedure TForm1.TakePageCode2(Memo: TMemo; Page: TChromium);
var
  CefStringVisitor: ICefStringVisitor;
begin

  { Memo.Clear;
    CefStringVisitor := TCefFastStringVisitor.Create(StringVisitor3);
    Page.Browser.GetMainFrame.GetSource(CefStringVisitor);
    Memo.Text:=PageM;
    if Memo.Text <> '' then
    st:=2; }
  PageCode.Clear;
  CefStringVisitor := TCefFastStringVisitor.Create(StringVisitor3);
  AdsBR.Browser.GetMainFrame.GetSource(CefStringVisitor);
  // Memo.Text:=PageM;
  // if PageCode.Text <> '' then
  // st:=2;
  // Finality.Enabled:=false;
end;

procedure TForm1.TakeAds;
// var zapros, vr, zag, adstext: string;
begin
  AdsCreater.Enabled := false;
  { vr := parsec(Memo3, 'banners-list-td', '');
    while pos('ad-link', Memo3.Text) > 0 do
    begin
    zapros := KeyCollector.Lines[adsright_i];
    vr := parsec(Memo3, 'ad_link', '');
    zag := parsec(Memo3, '<a target', '');
    adstext := parsec(Memo3, '<di ', '');
    ShowMessage(zapros + ' = ' + zag + ' | ' + adstext);
    end;
    stage := 30; }
end;

procedure TForm1.SelLine(Memo: TMemo; Index: integer);
begin
  with Memo do
  begin
    SelStart := Perform(EM_LINEINDEX, Index, 0);
    SelLength := length(Lines[Index]);
    SetFocus;
  end;
end;

procedure TForm1.clearPNGClick(Sender: TObject);
begin
  ShemeAds.Clear;
end;

procedure TForm1.ClearPreClick(Sender: TObject);
begin
  PreMinuss.Clear;
end;

procedure TForm1.ClearWordClick(Sender: TObject);
begin
  poisk.Cells[5, rpls_row] := '0';
  TakeList(KeyCollector, poisk, 4);
  TakeList(AdsRightZags, poisk, 7);
  TakeList(AdsRightZags2, poisk, 8);
  TakeList(AdsRight, poisk, 9);
  rpls_col := -1;
  rpls_row := -1;
  AdsPreview.Visible := false;
end;

procedure TForm1.clickFind;
var
  CodeStr: string;
begin
  BRReg.Load( 'https://wordstat.yandex.ru/#!/?page=' + inttostr(pages_i) + '&words=' + PreKey.Lines
      [word_i]);
  (*if Assigned(BRReg.Browser) and Assigned(BRReg.Browser.Mainframe) then
  begin
    CodeStr :=
      'document.location.href = "https://wordstat.yandex.ru/#!/?regions=' +
      regions + '&page=' + inttostr(pages_i) + '&words=' + PreKey.Lines
      [word_i] + '"';
    BRReg.Browser.Mainframe.ExecuteJavaScript(CodeStr, 'about:blank', 0);
    stage := 2;
  end;    *)
end;

procedure TForm1.clickFindRSY;
begin
  if Assigned(BRReg.Browser) and Assigned(BRReg.Browser.Mainframe) then
  begin
    while stage = 21 do
    begin
      if rsybool then
      begin
        if rsy_i = rsy.RowCount - 1 then
        begin
          if SP_i < 3 then
          begin
            stage := 20;
          end
          else
          begin
            ParserRSY.Enabled := false;
            stage := -1;
            ShowMessage('Собрано');
            PrClearE.Visible := false;
            PrClear.Visible := false;
          end;
        end
        else
        begin
          wordrsy := rsy.Cells[1, rsy_i];
          rsy_parent := rsy.Cells[0, rsy_i];
          if was(rsy, wordrsy, 0) <> -1 then
          begin
            inc(rsy_i);
            if (rsy_i mod 50) = 0 then
            begin
              SaveTable(rsy, code, '_rsy');
            end;
          end
          else
          begin
            FindWord(BRReg, wordrsy);
            stage := 22;
          end;
        end;
      end
      else
      begin
        if rsy_i = rsy.RowCount - 1 then
        begin
          ParserRSY.Enabled := false;
          stage := -1;
          ShowMessage('Собрано');
          PrClearE.Visible := false;
          PrClear.Visible := false;
        end
        else
        begin
          wordrsy := rsy.Cells[1, rsy_i];
          rsy_parent := rsy.Cells[0, rsy_i];
          if was(rsy, wordrsy, 0) <> -1 then
          begin
            inc(rsy_i);
          end
          else
          begin
            FindWord(BRReg, wordrsy);
            rsybool := true;
            stage := 22;
          end;
        end;
      end;

      if (rsy_i mod 99) = 0 then
        Application.ProcessMessages;
    end;
  end;
end;

procedure TForm1.CampaignCreatorTimer(Sender: TObject);
// var
// changesname, counter, Budget, method, camptype, camp, idcamp: string;
begin
  // := 'campaigns';
  { imagename := '';
    base64str := '';
    camptype := 'poisk';
    client := 'vinhunter';
    token := 'AQAAAAABrN4OAARhHFKyM_9CGEw6ifxmEKy8AQU';
    changesname := 'aafd';
    counter := '34987335';
    Budget := '300';
    method := 'add';
    regions := '225';
    if stage_camp = 1 then
    begin
    AddVCards(IdHTTP, camp, method, client, token, idcamp, City.Text,
    Kompaniya.Text, Phone.Text, Ulica.Text, dom.Text, korpus.Text, ofice.Text,
    metro.Text, familiya.Text, imya.Text, otchestvo.Text, KontEmail.Text,
    ogrn.Text, WorkTime, Addi);
    end;
    if stage_camp = 2 then
    begin
    //AddCamp(IdHTTP, camp, method, client, token, camptype, changesname, counter, Budget);
    end;
    if stage_camp = 3 then
    begin
    if imagename <> '' then
    begin
    AddImage(IdHTTP, camp, method, client, token, imagename, base64str);
    end
    else
    begin
    ShowMessage('Выберите изображение');
    end;
    end; }
end;

function TForm1.Changer(s: string): string;
const
  rus: string = 'абвгдежзийклмнопрстуфхцчшщъыьэюя';
  sw: string = 'f,dult;pbqrkvyjghcnea[wxio]sm''.z';
var
  i: integer;
  d: string;
begin
  d := s;
  for i := 1 to length(s) do
  begin
    if AnsiPos(s[i], rus) > 0 then
      d[i] := sw[Ord(s[i]) - Ord(rus[1]) + 1]
    else if AnsiPos(s[i], sw) > 0 then
      d[i] := rus[AnsiPos(s[i], sw)]
    else
      d[i] := s[i];
  end;
  Result := d;
end;

procedure TForm1.FindProxyChClick(Sender: TObject);
begin
  if FindProxyCh.Checked then
    FindProxy := true
  else
    FindProxy := false;
end;

procedure TForm1.FastClearChClick(Sender: TObject);
begin
  if FastClearCh.Checked then
    fastclear := true
  else
    fastclear := false;
end;

procedure TForm1.SliceCityChClick(Sender: TObject);
begin
  if SliceCityCh.Checked then
  begin
    AllCity.Enabled := true;
  end
  else
  begin
    AllCity.Enabled := false;
  end
end;

procedure TForm1.SliceTimeChClick(Sender: TObject);
begin
  if SliceTimeCh.Checked then
  begin
    RadioButton1.Enabled := true;
    RadioButton2.Enabled := true;
    RadioButton3.Enabled := true;
  end
  else
  begin
    RadioButton1.Enabled := false;
    RadioButton2.Enabled := false;
    RadioButton3.Enabled := false;
  end
end;

procedure TForm1.checkWord;
var
  CodeStr: string;
begin
  if Assigned(BRReg.Browser) and Assigned(BRReg.Browser.Mainframe) then
  begin
    CodeStr := '$(".b-pager__next")[0].click();';
    BRReg.Browser.Mainframe.ExecuteJavaScript(CodeStr, 'about:blank', 0);
    stage := 2;
  end;
end;

procedure TForm1.nextPageA;
var
  CodeStr: string;
begin
  if Assigned(BRReg.Browser) and Assigned(BRReg.Browser.Mainframe) then
  begin
    CodeStr := '$(".b-pager__next")[0].click();';
    BRReg.Browser.Mainframe.ExecuteJavaScript(CodeStr, 'about:blank', 0);
  end;
end;

procedure TForm1.checkWordRSY;
var
  CodeStr: string;
begin
  if Assigned(BRReg.Browser) and Assigned(BRReg.Browser.Mainframe) then
  begin
    CodeStr :=
      'var $str=""; var $ss=""; $str=$(".b-word-statistics__info").html(); $ss=$str.slice($str.indexOf("«")+1,$str.indexOf("»")); console.log("checr "+$ss);';
    BRReg.Browser.Mainframe.ExecuteJavaScript(CodeStr, 'about:blank', 0);
  end;
end;

procedure TForm1.MemoChanger(Memo: TMemo);
var
  jj, nn, mm, nm: integer;
begin
  //
  nm := 0;
  with HideLCont do
  begin
    for jj := 0 to ControlCount - 1 do
      if (Controls[jj] is TMemo) then
        if (AnsiPos('Memo', (Controls[jj] as TMemo).name) = 1) and
          (strtoint(Copy((Controls[jj] as TMemo).name, 5, 2)) = stlb + 9) then
          nm := jj;

    if Memo.Color = clInfoBk then
    begin
      Frst.Text := Memo.Text;
      if Scnd.Text <> '' then
      begin
        (Controls[nm] as TMemo).Clear;
        { if strk=0 then
          (Controls[nm] as TMemo).Lines.Add(Frst.Lines.Strings[0]+'+'+Scnd.Lines.Strings[0]); }
        for mm := strk to Frst.Lines.Count - 1 do
          for nn := strk to Scnd.Lines.Count - 1 do
            (Controls[nm] as TMemo).Lines.Add(Frst.Lines.Strings[mm] + ' ' +
              Scnd.Lines.Strings[nn]);
      end;
    end
    else if Memo.Color = clYellow then
    begin
      Scnd.Text := Memo.Text;
      if Frst.Text <> '' then
      begin
        (Controls[nm] as TMemo).Clear;
        { if strk=0 then
          (Controls[nm] as TMemo).Lines.Add(Frst.Lines.Strings[0]+'+'+Scnd.Lines.Strings[0]); }
        for mm := strk to Frst.Lines.Count - 1 do
          for nn := strk to Scnd.Lines.Count - 1 do
            (Controls[nm] as TMemo).Lines.Add(Frst.Lines.Strings[mm] + ' ' +
              Scnd.Lines.Strings[nn]);
      end;
    end;
  end;
end;

procedure TForm1.MemoChoiser(Memo: TMemo);
var
  jj, nn, mm, nm: integer;
begin
  //
  nm := 0;
  with HideLCont do
  begin
    for jj := 0 to ControlCount - 1 do
      if (Controls[jj] is TMemo) then
        if (AnsiPos('Memo', (Controls[jj] as TMemo).name) = 1) and
          (strtoint(Copy((Controls[jj] as TMemo).name, 5, 2)) = stlb + 9) then
          nm := jj;

    if Memo.Color = clCream then
    begin
      if Frst.Text = '' then
      begin
        Frst.Text := Memo.Text;
        Memo.Color := clInfoBk;
        if Scnd.Text <> '' then
        begin
          (Controls[nm] as TMemo).Clear;
          { if strk=0 then
            (Controls[nm] as TMemo).Lines.Add(Frst.Lines.Strings[0]+'+'+Scnd.Lines.Strings[0]); }
          for mm := strk to Frst.Lines.Count - 1 do
            for nn := strk to Scnd.Lines.Count - 1 do
              (Controls[nm] as TMemo).Lines.Add(Frst.Lines.Strings[mm] + ' ' +
                Scnd.Lines.Strings[nn]);
          stlb := stlb + 1;
        end;
      end
      else
      begin
        if Scnd.Text = '' then
        begin
          Scnd.Text := Memo.Text;
          Memo.Color := clYellow;
          if Frst.Text <> '' then
          begin
            (Controls[nm] as TMemo).Clear;
            { if strk=0 then
              (Controls[nm] as TMemo).Lines.Add(Frst.Lines.Strings[0]+'+'+Scnd.Lines.Strings[0]); }
            for mm := strk to Frst.Lines.Count - 1 do
              for nn := strk to Scnd.Lines.Count - 1 do
                (Controls[nm] as TMemo).Lines.Add(Frst.Lines.Strings[mm] + ' ' +
                  Scnd.Lines.Strings[nn]);
            stlb := stlb + 1;
          end;
        end
        else
          ShowMessage('Уберите один из выбранных списков');
      end;
    end
    else if Memo.Color = clInfoBk then
    begin
      Frst.Text := '';
      Memo.Color := clCream;
    end
    else if Memo.Color = clYellow then
    begin
      Scnd.Text := '';
      Memo.Color := clCream;
    end;
  end;
end;

procedure TForm1.ChtoChange(Sender: TObject);
// var nn, mm: integer;
begin
  { if (Sender as TMemo).Color = clInfoBk then
    begin
    Frst.Text:=(Sender as TMemo).Text;
    if Scnd.Text<>'' then
    begin
    Memo10.Clear;
    if strk=1 then
    Memo10.Lines.Add(Frst.Lines.Strings[0]+'+'+Scnd.Lines.Strings[0]);
    for mm := strk to Frst.Lines.Count-1 do
    for nn := strk to Scnd.Lines.Count-1 do
    Memo10.Lines.Add(Frst.Lines.Strings[mm]+' '+Scnd.Lines.Strings[nn]);
    end;
    end
    else if (Sender as TMemo).Color = clYellow then
    begin
    Scnd.Text:=(Sender as TMemo).Text;
    if Frst.Text<>'' then
    begin
    Memo10.Clear;
    if strk=1 then
    Memo10.Lines.Add(Frst.Lines.Strings[0]+'+'+Scnd.Lines.Strings[0]);
    for mm := strk to Frst.Lines.Count-1 do
    for nn := strk to Scnd.Lines.Count-1 do
    Memo10.Lines.Add(Frst.Lines.Strings[mm]+' '+Scnd.Lines.Strings[nn]);
    end;
    end; }
  MemoChanger((Sender as TMemo));
end;

procedure TForm1.ChtoClick(Sender: TObject);
// var nn, mm: integer;
begin
  // no := 1;
  { if (Sender as TMemo).Color = clCream then
    begin
    if Frst.Text='' then
    begin
    Frst.Text:=(Sender as TMemo).Text;
    (Sender as TMemo).Color := clInfoBk;
    if Scnd.Text<>'' then
    begin
    Memo10.Clear;
    if strk=1 then
    Memo10.Lines.Add(Frst.Lines.Strings[0]+'+'+Scnd.Lines.Strings[0]);
    for mm := strk to Frst.Lines.Count-1 do
    for nn := strk to Scnd.Lines.Count-1 do
    Memo10.Lines.Add(Frst.Lines.Strings[mm]+' '+Scnd.Lines.Strings[nn]);
    end;
    end
    else
    begin
    if Scnd.Text='' then
    begin
    Scnd.Text:=(Sender as TMemo).Text;
    (Sender as TMemo).Color := clYellow;
    if Frst.Text<>'' then
    begin
    Memo10.Clear;
    if strk=1 then
    Memo10.Lines.Add(Frst.Lines.Strings[0]+'+'+Scnd.Lines.Strings[0]);
    for mm := strk to Frst.Lines.Count-1 do
    for nn := strk to Scnd.Lines.Count-1 do
    Memo10.Lines.Add(Frst.Lines.Strings[mm]+' '+Scnd.Lines.Strings[nn]);
    end;
    end
    else
    ShowMessage('Уберите один из выбранных списков');
    end;
    end
    else if (Sender as TMemo).Color = clInfoBk then
    begin
    Frst.Text:='';
    (Sender as TMemo).Color := clCream;
    end
    else if (Sender as TMemo).Color = clYellow then
    begin
    Scnd.Text:='';
    (Sender as TMemo).Color := clCream;
    end; }
  MemoChoiser((Sender as TMemo));
end;

procedure TForm1.CitiesChDblClick(Sender: TObject);
begin
  CitiesCh.Lines.Delete(CitiesCh.CaretPos.Y);
end;

procedure TForm1.CitiesClick(Sender: TObject);
begin
  // ShemeAds.Lines.Strings[0]:=ShemeAds.Lines.Strings[0]+'{ГОРОД}';
  city_i := Cities.CaretPos.Y;
  // SelLine(Cities, Cities.CaretPos.Y);
  CitiesCh.Lines.Add(Cities.Lines.Strings[city_i]);
end;

procedure TForm1.CityChange(Sender: TObject);
begin
  if next_i = 15 then
    changebool := true;
end;

procedure TForm1.CitySlicePNGClick(Sender: TObject);
begin
  ObjShow(CitySetP);
end;

procedure TForm1.CitySlicePNGMouseEnter(Sender: TObject);
begin
  LoadPNGfromRes(CitySlicePNG, 'cityslice_PNG');
end;

procedure TForm1.CitySlicePNGMouseLeave(Sender: TObject);
begin
  LoadPNGfromRes(CitySlicePNG, 'cityslice2_PNG');
end;

procedure TForm1.ClearCloseClick(Sender: TObject);
begin
  if PreKeySheet.Visible then
  begin
    ClearinP.Visible := false;
    MyMinuss.Visible := false;
    ObjShow(PreKeyLoad);
    ObjShow(ChoiseP);
  end;
  if DokeySheet.Visible then
  begin
    ClearinP.Visible := false;
    MyMinuss.Visible := false;
    ObjShow(KeysC);
    ObjShow(ChoiseD);
  end;
  SheetList.Enabled := true;
end;

procedure TForm1.ClearingFullPNGClick(Sender: TObject);
begin
  if PreKeySheet.Visible then
  begin
    Minuss.Lines.Add(PreKey.Lines.Strings[prekey_i]);
    PreKey.Lines.Delete(prekey_i);
    if (prekey_i = PreKey.Lines.Count) or (PreKey.Lines.Count = 0) then
    begin
      ClearinP.Visible := false;
      MyMinuss.Visible := false;
      ObjShow(PreKeyLoad);
      SheetList.Enabled := true;
      if PreKey.Lines.Count = 0 then
      begin
        ChoiseP.Visible := false;
      end
      else
      begin
        ObjShow(ChoiseP);
      end;
    end
    else
      ClearingWord.Caption := PreKey.Lines.Strings[prekey_i];
    ClearingL.Caption := 'Чисто ' + inttostr(prekey_i) + ' / ' +
      inttostr(PreKey.Lines.Count);
  end;
  if DokeySheet.Visible then
  begin
    Minuss.Lines.Add(KeyCollector.Lines.Strings[prekey_i]);
    KeyCollector.Lines.Delete(prekey_i);
    if (prekey_i = KeyCollector.Lines.Count) or (KeyCollector.Lines.Count = 0)
    then
    begin
      ClearinP.Visible := false;
      MyMinuss.Visible := false;
      ObjShow(KeyCollector);
      if KeyCollector.Lines.Count = 0 then
      begin
        ChoiseD.Visible := false;
      end
      else
      begin
        ObjShow(ChoiseD);
      end;
    end
    else
      ClearingWord.Caption := KeyCollector.Lines.Strings[prekey_i];
    ClearingL.Caption := 'Чисто ' + inttostr(prekey_i) + ' / ' +
      inttostr(KeyCollector.Lines.Count);
  end;
  if AdsSheet.Visible then
  begin
    Minuss.Lines.Add(KeyCollector.Lines.Strings[adsright_i]);
    KeyCollector.Lines.Delete(adsright_i);
    if (adsright_i = KeyCollector.Lines.Count) or (KeyCollector.Lines.Count = 0)
    then
    begin
      AdsManager.Visible := false;
      ObjShow(AdsControlP);
      MyMinuss.Visible := false;
      ObjShow(KeyCollector);
      if KeyCollector.Lines.Count = 0 then
      begin
        LoadPNGfromRes(PriblPNG, 'pribl_PNG');
        priblbool := false;
      end
      else
      begin
        LoadPNGfromRes(PriblPNG, 'pribl3_PNG');
      end;
    end
    else
    begin
      AdsRightL.Caption := KeyCollector.Lines.Strings[adsright_i];
      AdsRight.Lines.Delete(adsright_i);
      AdsRightZags.Lines.Delete(adsright_i);
      AdsRightZags2.Lines.Delete(adsright_i);
      teplota.Lines.Delete(adsright_i);
      AdsRightE.Text := AdsRight.Lines.Strings[adsright_i];
      AdsRightZagE.Text := AdsRightZags.Lines.Strings[adsright_i];
      AdsRightZag2E.Text := AdsRightZags2.Lines.Strings[adsright_i];
    end;
    AdsRightB.Caption := 'Человекопонятные фразы ' + inttostr(adsright_i) +
      ' / ' + inttostr(KeyCollector.Lines.Count - 1);
  end;
end;

procedure TForm1.ClearingHelpMouseEnter(Sender: TObject);
begin
  PreKeyHelp.Clear;
  PreKeyHelp.Lines.Strings[0] :=
    'Кликнув на изображение "Зеленая галочка" - фраза хорошая.' + #13#10 +
    'Кликнув на изображение "Красный крестик" - убрать некоторые слова из фразы.'
    + #13#10 +
    'Кликнув на изображение "Красные стрелочки" - убрать фразу целиком.' +
    #13#10 + 'Кликнув на "Отметьте минус-слова" Вы отметите все активные слова'
    + 'Кликнув на квадратик перед словом Вы отметите это слово.' +
    'Кликнув на убрать минус-слова запустится механизм который уберет' +
    'во всем списке все фразы содержащие отмеченные слова. А сами слова' +
    'попадут в список минус-слов.';
  ObjShow(PreKeyHelpP);
end;

procedure TForm1.ClearingHelpMouseLeave(Sender: TObject);
begin
  PreKeyHelpP.Visible := false;
end;

procedure TForm1.ClearingNoPNGClick(Sender: TObject);
var
  stri: string;
  SL: TStringList;
begin
  if HandClearP.Visible = false then
  begin
    if PreKeySheet.Visible then
      stri := PreKey.Lines.Strings[prekey_i];
    if DokeySheet.Visible then
      stri := KeyCollector.Lines.Strings[prekey_i];
    if AdsSheet.Visible then
      stri := KeyCollector.Lines.Strings[adsright_i];
    SL := TStringList.Create;
    SL.Text := StringReplace(stri, ' ', #13#10, [rfReplaceAll]);
    CheckBox1.Caption := '';
    CheckBox2.Caption := '';
    CheckBox3.Caption := '';
    CheckBox4.Caption := '';
    CheckBox5.Caption := '';
    CheckBox6.Caption := '';
    CheckBox7.Caption := '';
    CheckBox1.Checked := false;
    CheckBox2.Checked := false;
    CheckBox3.Checked := false;
    CheckBox4.Checked := false;
    CheckBox5.Checked := false;
    CheckBox6.Checked := false;
    CheckBox7.Checked := false;
    CheckBox1.Enabled := false;
    CheckBox2.Enabled := false;
    CheckBox3.Enabled := false;
    CheckBox4.Enabled := false;
    CheckBox5.Enabled := false;
    CheckBox6.Enabled := false;
    CheckBox7.Enabled := false;
    if (SL.Count >= 1) then
    begin
      CheckBox1.Enabled := true;
      if (length(SL[0]) > 0) then
        CheckBox1.Caption := SL[0];
    end
    else
      CheckBox1.Checked := false;
    if (SL.Count >= 2) then
    begin
      CheckBox2.Enabled := true;
      if (length(SL[1]) > 0) then
        CheckBox2.Caption := SL[1];
    end
    else
      CheckBox2.Checked := false;
    if (SL.Count >= 3) then
    begin
      CheckBox3.Enabled := true;
      if (length(SL[2]) > 0) then
        CheckBox3.Caption := SL[2];
    end
    else
      CheckBox3.Checked := false;
    if (SL.Count >= 4) then
    begin
      CheckBox4.Enabled := true;
      if (length(SL[3]) > 0) then
        CheckBox4.Caption := SL[3];
    end
    else
      CheckBox4.Checked := false;
    if (SL.Count >= 5) then
    begin
      CheckBox5.Enabled := true;
      if (length(SL[4]) > 0) then
        CheckBox5.Caption := SL[4]
    end
    else
      CheckBox5.Checked := false;
    if (SL.Count >= 6) then
    begin
      CheckBox6.Enabled := true;
      if (length(SL[5]) > 0) then
        CheckBox6.Caption := SL[5]
    end
    else
      CheckBox6.Checked := false;
    if (SL.Count >= 7) then
    begin
      CheckBox7.Enabled := true;
      if (length(SL[6]) > 0) then
        CheckBox7.Caption := SL[6]
    end
    else
      CheckBox7.Checked := false;
    FreeAndNil(SL);

    ObjShow(HandClearP);
  end
  else
  begin
    HandClearClick(HandClear);
  end;
end;

procedure TForm1.ClearingYesPNGClick(Sender: TObject);
begin
  prekey_i := prekey_i + 1;
  if PreKeySheet.Visible then
  begin
    if (prekey_i = PreKey.Lines.Count) or (PreKey.Lines.Count = 0) then
    begin
      ClearinP.Visible := false;
      MyMinuss.Visible := false;
      ObjShow(PreKeyLoad);
      SheetList.Enabled := true;
      if PreKey.Lines.Count = 0 then
      begin
        ChoiseP.Visible := false;
      end
      else
      begin
        ObjShow(ChoiseP);
      end;
    end
    else
      ClearingWord.Caption := PreKey.Lines.Strings[prekey_i];
    ClearingL.Caption := 'Чисто ' + inttostr(prekey_i) + ' / ' +
      inttostr(PreKey.Lines.Count);
  end;
  if DokeySheet.Visible then
  begin;
    if (prekey_i = KeyCollector.Lines.Count) or (KeyCollector.Lines.Count = 0)
    then
    begin
      ClearinP.Visible := false;
      MyMinuss.Visible := false;
      ObjShow(KeyCollector);
      if KeyCollector.Lines.Count = 0 then
      begin
        ChoiseD.Visible := false;
      end
      else
      begin
        ObjShow(ChoiseD);
      end;
    end
    else
      ClearingWord.Caption := KeyCollector.Lines.Strings[prekey_i];
    ClearingL.Caption := 'Чисто ' + inttostr(prekey_i) + ' / ' +
      inttostr(KeyCollector.Lines.Count);
  end;
end;

procedure TForm1.ClearListBClick(Sender: TObject);
begin
  MyMinuss.Text := MyMinuss.Text + ClearList.Text;
  TakeList(KeyCollector, poisk, 4);
  ObjShow(LoadBarP);
  ClearingS([ClearList], KeyCollector, poisk, 4, SovT.Position, DlSovT.Position,
    MinDlSlovT.Position, ClearChisloC.Checked, true, false, false, true,
    LoadBar2);
  ClearList.Clear;
  NoDuplicate3T(poisk, 4);
  TakeList(KeyCollector, poisk, 4);
  LoadBarP.Visible := false;
  ClearListPXClick(ClearListP);
end;

procedure TForm1.ClearListPXClick(Sender: TObject);
begin
  ClearListP.Visible := false;
end;

procedure TForm1.nextWord;
begin
  if word_i < PreKey.Lines.Count then
    stage := 1
  else
  begin
    stage := -1;
    ShowMessage('Собрано');
    Parser.Enabled := false;
    ChoiseD.Visible := true;
    KeyCollector.Lines.SaveToFile(ExtractfilePath(Application.ExeName) +
      'Projects/' + code + '/' + code + '_keys.txt');
  end;
end;

procedure TForm1.NoListClearClick(Sender: TObject);
begin
  ListClear.Lines.Add(NoListClear.Lines.Strings[NoListClear.CaretPos.Y]);
  NoListClear.Lines.Delete(NoListClear.CaretPos.Y);
end;

procedure TForm1.NoListClearDblClick(Sender: TObject);
begin
  ListClear.Lines.Add(NoListClear.Lines.Strings[NoListClear.CaretPos.Y]);
  NoListClear.Lines.Delete(NoListClear.CaretPos.Y);
end;

procedure TForm1.oficeChange(Sender: TObject);
begin
  if next_i = 15 then
    changebool := true;
end;

procedure TForm1.ogrnChange(Sender: TObject);
begin
  if next_i = 15 then
    changebool := true;
end;

procedure TForm1.OldZTZClick(Sender: TObject);
begin
  ObjShow(GroupSelectorP);
  Panel104.Caption := OldZTZ.Caption;
  GroupSelector(GroupSelectorM, GroupSelectorMI, poisk, 4);
end;

procedure TForm1.otchestvoChange(Sender: TObject);
begin
  if next_i = 15 then
    changebool := true;
end;

procedure TForm1.OtsevCClick(Sender: TObject);
begin
  if Otsev then
    Otsev := false
  else
    Otsev := true;
end;

procedure TForm1.OtsevEChange(Sender: TObject);
begin
  if OtsevE.Text <> '' then
    OtsevT.Position := strtoint(OtsevE.Text)
  else
  begin
    OtsevT.Position := 1;
    OtsevE.SelStart := length(OtsevE.Text);
    OtsevE.SelLength := 0;
  end;
end;

procedure TForm1.OtsevEKeyPress(Sender: TObject; var Key: Char);
begin
  case Key of
    #8, '0' .. '9':
    else
      Key := Chr(0);
  end;
end;

procedure TForm1.OtsevTChange(Sender: TObject);
begin
  OtsevE.Text := inttostr(OtsevT.Position);
end;

procedure TForm1.colWords;
var
  CefStringVisitor: ICefStringVisitor;
begin
  Memo1.Clear;
  CefStringVisitor := TCefFastStringVisitor.Create(StringVisitor);
  BRReg.Browser.GetMainFrame.GetSource(CefStringVisitor);
  stage := 4;
end;

procedure TForm1.StringVisitor(const str: ustring);
begin
  Memo1.Lines.Add(str);
end;

procedure TForm1.StringVisitor2(const str: ustring);
begin
  Memo3.Lines.Add(str);
end;

procedure TForm1.StringVisitor3(const str: ustring);
begin
  PageCode.Lines.Add(str);
end;

procedure TForm1.TakePageRSY;
var
  CefStringVisitor: ICefStringVisitor;
begin
  Memo1.Clear;
  CefStringVisitor := TCefFastStringVisitor.Create(StringVisitor);
  BRReg.Browser.GetMainFrame.GetSource(CefStringVisitor);
  stage := 24;
end;

procedure TForm1.DoSTChange(Sender: TObject);
begin
  if lvlentry = 1 then
  begin
    if (DoST.ItemIndex = 0) or (DoST.ItemIndex = 1) or (DoST.ItemIndex = 2) then
      DoST.ItemIndex := 3;
  end;
end;

procedure TForm1.DoSTKeyPress(Sender: TObject; var Key: Char);
begin
  Key := #0;
end;

procedure TForm1.CTAchDblClick(Sender: TObject);
begin
  CTAch.Lines.Delete(CTAch.CaretPos.Y);
end;

procedure TForm1.CTAsClick(Sender: TObject);
begin
  // ShemeAds.Lines.Strings[0]:=ShemeAds.Lines.Strings[0]+'{ПРИЗЫВ К ДЕЙСТВИЮ}';
  CTAs_i := CTAs.CaretPos.Y;
  // SelLine(CTAs, CTAs.CaretPos.Y);
  CTAch.Lines.Add(CTAs.Lines.Strings[CTAs_i]);
end;

procedure TForm1.CTAsetPNGClick(Sender: TObject);
begin
  ObjShow(CTASetP);
end;

procedure TForm1.CTAsetPNGMouseEnter(Sender: TObject);
begin
  LoadPNGfromRes(CTAsetPNG, 'CTA3_PNG');
end;

procedure TForm1.CTAsetPNGMouseLeave(Sender: TObject);
begin
  LoadPNGfromRes(CTAsetPNG, 'CTA_PNG');
end;

procedure TForm1.CtrPNGClick(Sender: TObject);
var
  stri, stri2: string;
  SL: TStringList;
  i: integer;
begin
  ZConnection1.Connected := false;
  ZConnection1.Connected := true;
  SheetList.Enabled := false;
  AdsControlP.Visible := false;
  ObjShow(AdsSet);
  ctrbool := true;

  ZQuery1.SQL.Text := 'SELECT * FROM `product` WHERE `id`=''' + id_prod + '''';
  ZQuery1.Active := true; { }

  AdsHref.Text := ZQuery1.FieldByName('url').AsString;
  hrefdesc.Text := ZQuery1.FieldByName('urldesc').AsString;
  stri := ZQuery1.FieldByName('fasts').AsString;
  stri2 := ZQuery1.FieldByName('descs').AsString;

  SL := TStringList.Create;
  try
    SL.Text := StringReplace(stri, '||', #13#10, [rfReplaceAll]);
    if SL.Count > 0 then
      AdsFasts.Clear;
    for i := 0 to SL.Count - 1 do
      AdsFasts.Lines.Add(SL[i]);
  finally
    FreeAndNil(SL);
  end;
  SL := TStringList.Create;
  try
    SL.Text := StringReplace(stri2, '||', #13#10, [rfReplaceAll]);
    if SL.Count > 0 then
      AdsDescs.Clear;
    for i := 0 to SL.Count - 1 do
      AdsDescs.Lines.Add(SL[i]);
  finally
    FreeAndNil(SL);
  end;
end;

procedure TForm1.dataPNGMouseEnter(Sender: TObject);
begin
  LoadPNGfromRes(dataPNG, 'data2_PNG');
end;

procedure TForm1.dataPNGMouseLeave(Sender: TObject);
begin
  LoadPNGfromRes(dataPNG, 'data_PNG');
end;

procedure TForm1.pasteWord;
var
  CodeStr: string;
begin
  if Assigned(BRReg.Browser) and Assigned(BRReg.Browser.Mainframe) then
  begin
    CodeStr := '$(".b-form-input__input").val("' + PreKey.Lines[word_i] + '");';
    BRReg.Browser.Mainframe.ExecuteJavaScript(CodeStr, 'about:blank', 0);
    stage := 1;
  end;
end;

procedure TForm1.pasteWordRSY;
var
  i: integer;
begin
  ParserRSY.Enabled := false;
  for i := 1 to rsy.RowCount - 1 do
  begin
    if rsy.Cells[0, i - 1] <> rsy.Cells[0, i] then
      PreKey.Lines.Add(rsy.Cells[0, i]);
  end;
  inc(SP_i);
  rsy_np := 1;
  ShowMessage('Следующие слово');
  ParserRSY.Enabled := true;
  stage := 21;
end;

procedure TForm1.nextPage;
begin
  if AnsiPos('b-pager__inactive', Memo2.Text) > AnsiPos('b-pager__active',
    Memo2.Text) then
  begin
    stage := 6;
    Keys.Lines.SaveToFile(ExtractfilePath(Application.ExeName) + 'Projects/' +
      CodeName.Text + '/keywords/' + Keys.Lines[word_i] + '_ws.txt');
    word_i := word_i + 1;
    KeyCollector.Lines.Text := KeyCollector.Lines.Text + Keys.Lines.Text;
    Keys.Clear;

  end
  else
  begin
    IF AnsiPos('b-pager__active', Memo2.Text) > 0 then
    begin
      stage := 7;
    end;
  end;

end;

procedure TForm1.checkClass;
begin
  Memo2.Clear;
  Memo2.Text := Copy(Memo1.Text,
    AnsiPos('b-word-statistics__phrases-associations', Memo1.Text),
    AnsiPos('</html>', Memo1.Text));
  Memo1.Text := Copy(Memo1.Text, 1,
    AnsiPos('b-word-statistics__phrases-associations', Memo1.Text)) + '</html>';
  kont_start := Keys.Lines.Count - 1;
  stage := 3;
end;

procedure TForm1.doRSYcol;
var
  CodeStr: string;
begin
  if Assigned(BRReg.Browser) and Assigned(BRReg.Browser.Mainframe) then
  begin
    CodeStr :=
      'console.log("col "+$(".b-word-statistics__phrases-associations .b-phrase-link__link").length);';
    BRReg.Browser.Mainframe.ExecuteJavaScript(CodeStr, 'about:blank', 0);
  end;
end;

procedure TForm1.doRSYword;
var
  CodeStr: string;
begin
  if Assigned(BRReg.Browser) and Assigned(BRReg.Browser.Mainframe) then
  begin
    CodeStr :=
      'console.log("col "+$(".b-word-statistics__phrases-associations .b-phrase-link__link").length);';
    BRReg.Browser.Mainframe.ExecuteJavaScript(CodeStr, 'about:blank', 0);
  end;
end;

procedure TForm1.DoSetBClick(Sender: TObject);
// var i:integer;
begin
  { PageCode.Lines.LoadFromFile(ExtractfilePath(Application.ExeName)+'regions.txt');
    Sleep(1234);
    Application.ProcessMessages;
    ParsePage(PageCode);
    for i := 0 to ParsObjs.obji-1 do
    begin
    if pos('name="reg"' , ParsObjs.objs[i].param)>0 then
    begin
    LocalZag.Lines.Add(ParsObjs.objs[i+1].innerTxt);
    LocalText.Lines.Add(Copy(ParsObjs.objs[i+1].param,pos('for="',ParsObjs.objs[i+1].param)+5,Length(ParsObjs.objs[i+1].param)-pos('for="',ParsObjs.objs[i+1].param)-6));
    //LocalText.Lines.Add( ParsObjs.objs[i+1].param);
    end;
    end;
    LocalZag.Lines.SaveToFile('rn.txt');
    LocalText.Lines.SaveToFile('ri.txt'); }
end;

procedure TForm1.DoSetBMouseEnter(Sender: TObject);
begin
  LoadPNGfromRes(DoSetB, 'Set2_PNG');
end;

procedure TForm1.DoSetBMouseLeave(Sender: TObject);
begin
  LoadPNGfromRes(DoSetB, 'Set_PNG');
end;

procedure TForm1.DoSPChange(Sender: TObject);
begin
  if lvlentry = 1 then
  begin
    While (DoSP.Lines.Count > 1) do
    begin
      DoSP.Lines.Delete(1);
    end;
    if DoSP.CaretPos.Y = 1 then
    begin
      SendMessage(DoSP.Handle, WM_CHAR, VK_BACK, 0);
    end;
  end;

  if DoSP.Lines.Count > 1 then
    DoSP.ScrollBars := ssVertical;
end;

procedure TForm1.DoSPEnter(Sender: TObject);
begin
  LoadPNGfromRes(Hot, 'hot_PNG');
end;

procedure TForm1.DoSPExit(Sender: TObject);
begin
  LoadPNGfromRes(Hot, 'hot2_PNG');
end;

procedure TForm1.DoSPKeyPress(Sender: TObject; var Key: Char);
begin
  { if (Key = #13) and (DoSP.Lines.Count = 3) then
    begin
    Key := #0;
    end; }
end;

procedure TForm1.DoSPMouseEnter(Sender: TObject);
begin
  LoadPNGfromRes(Hot, 'hot_PNG');
end;

procedure TForm1.DoSPMouseLeave(Sender: TObject);
begin
  LoadPNGfromRes(Hot, 'hot2_PNG');
end;

procedure TForm1.DoSRChange(Sender: TObject);
begin
  if DoSR.Lines.Count > 1 then
    DoSR.ScrollBars := ssVertical;
end;

procedure TForm1.DoSREnter(Sender: TObject);
begin
  LoadPNGfromRes(Cold, 'cold_PNG');
end;

procedure TForm1.DoSRExit(Sender: TObject);
begin
  LoadPNGfromRes(Cold, 'cold2_PNG');
end;

procedure TForm1.DoSRMouseEnter(Sender: TObject);
begin
  LoadPNGfromRes(Cold, 'cold_PNG');
end;

procedure TForm1.DoSRMouseLeave(Sender: TObject);
begin
  LoadPNGfromRes(Cold, 'cold2_PNG');
end;

procedure TForm1.DokeyHelpMouseEnter(Sender: TObject);
begin
  PreKeyHelp.Clear;
  if DokeySheet.Visible then
    PreKeyHelp.Lines.Strings[0] :=
      'Введите свой логин почтового ящика в яндекс и пароль. ' +
      'Нажмите кнопку "ОК" и дождитесь появления надписи "Собрать ключи". ' +
      'Нажмите "Собрать ключи". Дождитесь' + ' сообщения "Собрано".' + #13#10 +
      '*В целях безопасности данные ни как не сохраняются!' + #13#10 +
      '**Вход происходит за 10 секунд.'
  else
    PreKeyHelp.Lines.Strings[0] :=
      'Список ключевых запросов зачастую имеет неправильную морфологическую форму.'
      + ' Для повышения качества объявлений и, следовательно, увеличения CTR (количества кликов по объявлению).'
      + ' Этот большой труд будет оправдан, выполнив все качественно, Вы получите адаптивный контент, что увеличит конверсию (количество оставленных заявок) сайта (который вы получаете бесплатно!).';
  ObjShow(PreKeyHelpP);
end;

procedure TForm1.DokeyHelpMouseLeave(Sender: TObject);
begin
  PreKeyHelpP.Visible := false;
end;

procedure TForm1.domChange(Sender: TObject);
begin
  if next_i = 15 then
    changebool := true;
end;

procedure TForm1.DoOptionsClick(Sender: TObject);
begin
  ShowMessage('Hello');
end;

procedure TForm1.DoYaEntry;
begin
  yabool := false;
  Finality.Enabled := false;
  if (DoYaLogin.Text <> '') and (DoYaPass.Text <> '') then
  begin
    yalog := DoYaLogin.Text;
    yapas := DoYaPass.Text;
    BRReg.Load('https://wordstat.yandex.ru/#!/?regions=' + regions);
    iTimer := 0;
    yabool := true;
    DoError.Caption := '';
    // DoError.Visible := false;
    YaTimer.Enabled := true;
  end
  else
  begin
    ObjHide(LoadBarP);
    DoRK.Caption := 'Запустить';
    DoError.Caption := 'Введите логин и пароль в яндекс директ!';
  end;
end;

procedure TForm1.YaEntryBClick(Sender: TObject);
begin
  yabool := false;
  if (YaLogin.Text <> '') and (YaPassword.Text <> '') then
  begin
    BRReg.Load('https://wordstat.yandex.ru/#!/?regions=' + regions);
    iTimer := 0;
    yabool := true;
    YaEntryB.Cursor := crHourGlass;
    DoErr.Visible := false;
    YaEntry.Enabled := true;
  end
  else
    DoErr.Caption := 'Введите логин и пароль в яндекс вордстат!';
end;

procedure TForm1.PageCodeClick(Sender: TObject);
var
  ClipBoard: TClipboard;
begin
  ClipBoard := TClipboard.Create;
  ClipBoard.SetTextBuf(PWideChar(Pwidestring(PageCode.Text)));
end;

procedure TForm1.Panel102MouseDown(Sender: TObject; Button: TMouseButton;
  Shift: TShiftState; X, Y: integer);
const
  SC_DragMove = $F012;
begin
  ReleaseCapture;
  (Sender as TPanel).Parent.Perform(WM_SysCommand, SC_DragMove, 0);
end;

procedure TForm1.Panel103Click(Sender: TObject);
begin
  GroupSelectorP.Visible := false;
  Panel107.Caption := '';
end;

procedure TForm1.Panel105Click(Sender: TObject);
begin
  ReplacerZTZP.Visible := false;
end;

procedure TForm1.Panel107Click(Sender: TObject);
begin
  ObjShow(ReplacerZTZP);
  OldZTZ.Caption := Panel107.Caption;
  ReplaceZTZOne.Enabled := false;
  ReplaceZTZOne.Font.Color := clGray;
  LenStr.Caption := inttostr(length(Panel116.Caption));
  NewZTZ.Text := OldZTZ.Caption;
end;

procedure TForm1.Panel114Click(Sender: TObject);
var
  i, M: integer;
  b: boolean;
begin
  if ErrorZP.Caption <> 'Идет сбор данных...' then
  begin
    b := false;
    M := 30;
    if rpls_col = 7 then
      M := maxdlz1;
    if rpls_col = 8 then
      M := maxdlz2;
    if rpls_col = 9 then
      M := maxdltxt;
    for i := 0 to GroupSelectorZM.Lines.Count - 1 do
      if length(GroupSelectorZM.Lines.Strings[i]) > M then
      begin
        ErrorZP.Visible := true;
        ErrorZP.Caption := 'Устраните ошибки перед выходом! Кликните здесь.';
        ErrorZP.Font.Color := clRed;
        b := true;
        break;
      end;
    if not b then
    begin
      GroupSelectorZP.Visible := false;
      Panel116.Caption := '';
    end;
  end;
end;

procedure TForm1.Panel116Click(Sender: TObject);
begin
  ObjShow(ReplacerZTZP);
  OldZTZ.Caption := Panel116.Caption;
  ReplaceZTZOne.Enabled := false;
  ReplaceZTZOne.Font.Color := clGray;
  LenStr.Caption := inttostr(length(Panel116.Caption));
  NewZTZ.Text := OldZTZ.Caption;
end;

procedure TForm1.Panel118Click(Sender: TObject);
begin
  ClearingP.Visible := false;
end;

procedure TForm1.regioClick(Sender: TObject);
var
  SL: TStringList;
  i: integer;
begin
  RegionsP.Visible := false;
  if RegionsMI.Lines.Count = 0 then
  begin
    regions := '225';
    regionsz := 'Россия';
  end
  else
  begin
    for i := 0 to RegionsMI.Lines.Count - 1 do
      if regions = '' then
        regions := RegionsMI.Lines.Strings[i]
      else
        regions := regions + '%2C' + RegionsMI.Lines.Strings[i];
    SL := TStringList.Create;
    SL.Text := Memo5.Text;
    regionsz := ListToStrD(SL, ', ');
    FreeAndNil(SL);
  end;
end;

procedure TForm1.Panel12Click(Sender: TObject);
begin
  if PreKey.Visible then
  begin
    Clearing2P2(PreKey, PreMinuss, poisk, 4, ClearChisloC.Checked,
      SovT.Position, MinDlSlovT.Position, LoadBar2);
    Clearing32(PreKey, poisk, 1, LoadBar2);
  end
  else if PreKeyRSY.Visible then
  begin
    Clearing2P2(PreKeyRSY, PreMinuss, poisk, 4, ClearChisloC.Checked,
      SovT.Position, MinDlSlovT.Position, LoadBar2);
    Clearing32(PreKeyRSY, poisk, 1, LoadBar2);
  end
  else
  begin
    Clearing2P2(KeyCollector, PreMinuss, poisk, 4, ClearChisloC.Checked,
      SovT.Position, MinDlSlovT.Position, LoadBar2);
    Clearing32(KeyCollector, poisk, 4, LoadBar2);
  end;

  Clearing4(PreMinuss, MyMinuss, Minuss);
  PreMinuss.Lines.Clear;

  HandClearP.Visible := false;
  AdsPreview.Visible := false;
end;

procedure TForm1.Panel13Click(Sender: TObject);
begin
  HandClearP.Visible := false;
  ClearPre.Visible := false;
end;

procedure TForm1.Panel22Click(Sender: TObject);
begin
  if CheckBox1.Enabled then
    CheckBox1.Checked := true;
  if CheckBox2.Enabled then
    CheckBox2.Checked := true;
  if CheckBox3.Enabled then
    CheckBox3.Checked := true;
  if CheckBox4.Enabled then
    CheckBox4.Checked := true;
  if CheckBox5.Enabled then
    CheckBox5.Checked := true;
  if CheckBox6.Enabled then
    CheckBox6.Checked := true;
  if CheckBox7.Enabled then
    CheckBox7.Checked := true;
end;

procedure TForm1.Panel36Click(Sender: TObject);
begin
  (* ADS.Clear;
    for j := 0 to AdsRightZags.Lines.Count - 1 do
    begin
    if AnsiPos(AdsRight.Lines.Strings[j][AdsRight.Lines.Strings[j].length],
    zn) > 0 then
    ADS.Lines.Add(AnsiUpperCase(AdsRightZags2.Lines.Strings[j][1]) +
    AnsiLowerCase(Copy(AdsRightZags2.Lines.Strings[j], 2,
    AdsRightZags2.Lines.Strings[j].length)) + ' ' +
    AnsiUpperCase(AdsRight.Lines.Strings[j][1]) +
    AnsiLowerCase(Copy(AdsRight.Lines.Strings[j], 2,
    AdsRight.Lines.Strings[j].length)))
    else
    ADS.Lines.Add(AnsiUpperCase(AdsRightZags2.Lines.Strings[j][1]) +
    AnsiLowerCase(Copy(AdsRightZags2.Lines.Strings[j], 2,
    AdsRightZags2.Lines.Strings[j].length)) + ' ' +
    AnsiUpperCase(AdsRight.Lines.Strings[j][1]) +
    AnsiLowerCase(Copy(AdsRight.Lines.Strings[j], 2,
    AdsRight.Lines.Strings[j].length)) + '.');

    if (ADS.Lines.Strings[j].length + UTPs.Lines.Strings[UTPs_i].length + 1) <
    maxdltxt + 1 then
    begin
    ADS.Lines.Strings[j] := ADS.Lines.Strings[j] + ' ' +
    UTPs.Lines.Strings[UTPs_i];
    if (ADS.Lines.Strings[j].length + Times.Lines.Strings[time_i].length + 12)
    < maxdltxt then
    begin
    ADS.Lines.Strings[j] := ADS.Lines.Strings[j] + ' только до ' +
    Times.Lines.Strings[time_i] + '!';
    end
    else
    ADS.Lines.Strings[j] := ADS.Lines.Strings[j] + '!';
    end
    else
    stri := 'Превышает длину текста объявления. УТП';
    if (ADS.Lines.Strings[j].length + CTAs.Lines.Strings[CTAs_i].length + 1) <
    maxdltxt + 1 then
    ADS.Lines.Strings[j] := ADS.Lines.Strings[j] + ' ' +
    CTAs.Lines.Strings[CTAs_i]
    else
    stri := 'Превышает длину текста объявления. ';
    Application.ProcessMessages;
    end;
    finisherr.Caption := 'Тексты объявлений подготовлены.'; *)
end;

procedure TForm1.Panel36MouseDown(Sender: TObject; Button: TMouseButton;
  Shift: TShiftState; X, Y: integer);
const
  SC_DragMove = $F012;
begin
  ReleaseCapture;
  TimeSetP.Perform(WM_SysCommand, SC_DragMove, 0);
end;

procedure TForm1.HideMinusAllClick(Sender: TObject);
begin
  HideMemos;
  Minuss.Visible := true;
end;

procedure TForm1.HideMinusBClick(Sender: TObject);
var
  SL, SL2, slm: TStringList;
  i, j, l, chet: integer;
  stri, stri2, minusstri: string;
  a, b, c: boolean;
begin
  i := 0;
  while i < KeyCollector.Lines.Count - 1 do
  begin
    // ShowMessage(inttostr(i)+' '+PreKey.Lines.Strings[i]);
    stri := KeyCollector.Lines.Strings[i];
    SL := TStringList.Create;
    c := false;
    SL.Text := StringReplace(stri, ' ', #13#10, [rfReplaceAll]);
    b := false;
    for j := KeyCollector.Lines.Count - 1 downto i + 1 do
    begin
      stri2 := KeyCollector.Lines.Strings[j];
      SL2 := TStringList.Create;
      SL2.Text := StringReplace(stri2, ' ', #13#10, [rfReplaceAll]);
      a := false;
      if SL.Count < SL2.Count then
      begin
        chet := 0;
        for l := 0 to SL.Count - 1 do
        begin
          if (AnsiPos(SL[l], stri2) > 0) then
          begin
            chet := chet + 1;
          end
        end;
        if chet = SL.Count then
        begin
          b := true;
        end;
      end
      else if SL2.Count < SL.Count then

      begin
        chet := 0;
        for l := 0 to SL2.Count - 1 do
        begin
          if (AnsiPos(SL2[l], stri) > 0) then
          begin
            chet := chet + 1;
          end
        end;
        if chet = SL2.Count then
        begin
          a := true;
        end;
      end
      else
      begin
        chet := 0;
        for l := 0 to SL2.Count - 1 do
        begin
          if (AnsiPos(SL2[l], stri) > 0) then
          begin
            chet := chet + 1;
          end
        end;
        if chet = SL2.Count then
        begin
          c := true;
        end;
      end;

      minusstri := '';
      if a then
      begin
        // ShowMessage('первое длиннее '+inttostr(i));
        KeyCollector.Lines.Add(PreKey.Lines.Strings[i]);
        KeyCollector.Lines.Delete(i);
        i := i - 1;
        break;
      end;
      if b then
      begin
        // ShowMessage('второе длиннее '+inttostr(i));
        for l := 0 to SL2.Count - 1 do
        begin
          if (AnsiPos(SL2[l], stri) < 1) then
          begin
            if minusstri <> '' then
              minusstri := minusstri + ' ' + SL2[l]
            else
              minusstri := SL2[l];
          end;
        end;
        slm := TStringList.Create;
        slm.Text := StringReplace(minusstri, ' ', #13#10, [rfReplaceAll]);
        for l := 0 to slm.Count - 1 do
        begin
          KeyCollector.Lines.Add('');
          // PreKey.Lines.Add(stri+' '+slm[l]);
        end;
        for l := KeyCollector.Lines.Count - 1 downto i + 1 + slm.Count do
          KeyCollector.Lines.Strings[l] := KeyCollector.Lines.Strings
            [l - slm.Count];
        for l := 0 to slm.Count - 1 do
          KeyCollector.Lines.Strings[l + i + 1] := stri + ' ' + slm[l];

        for l := 0 to slm.Count - 1 do
          KeyCollector.Lines.Strings[i] := KeyCollector.Lines.Strings[i] +
            ' -' + slm[l];
        FreeAndNil(SL2);
        break;
      end;
      if c then
      begin
        if (SL.Count = SL2.Count) then
        begin
          // ShowMessage('второе равно '+inttostr(i)+' '+PreKey.Lines.Strings[i]);
          KeyCollector.Lines.Delete(i);
          i := i - 1;
          break;
        end
      end;

      FreeAndNil(SL2);
    end;
    FreeAndNil(SL);
    i := i + 1;
  end;
end;

procedure TForm1.HideMinusCityClick(Sender: TObject);
begin
  HideMemos;
  Cities.Visible := true;
  Cities.Parent := HideContentP;
end;

procedure TForm1.HideMinusIClick(Sender: TObject);
var
  b: boolean;
begin
  b := false;
  if LoadBarP.Visible then
    b := true;
  if (not Minuss.Visible) and (not MyMinuss.Visible) and (not Cities.Visible)
  then
  begin
    HideMemos;
    Minuss.Visible := true;
  end
  else if Minuss.Visible then
  begin
    ObjShow(LoadBarP);
    ClearingS([Minuss], KeyCollector, poisk, 4, SovT.Position, DlSovT.Position,
      MinDlSlovT.Position, ClearChisloC.Checked, false, true, false, true,
      LoadBar2);
  end
  else if MyMinuss.Visible then
  begin
    ObjShow(LoadBarP);
    ClearingS([MyMinuss], KeyCollector, poisk, 4, SovT.Position,
      DlSovT.Position, MinDlSlovT.Position, ClearChisloC.Checked, false, true,
      false, true, LoadBar2);
  end
  else if Cities.Visible then
  begin
    ObjShow(LoadBarP);
    ClearingS([Cities], KeyCollector, poisk, 4, SovT.Position, DlSovT.Position,
      MinDlSlovT.Position, ClearChisloC.Checked, false, true, false, true,
      LoadBar2);
  end;
  if not b then
    LoadBarP.Visible := false;
end;

procedure TForm1.HideMinusIMouseEnter(Sender: TObject);
begin
  LoadPNGfromRes(HideMinusI, 'Minus_PNG');
end;

procedure TForm1.HideMinusIMouseLeave(Sender: TObject);
begin
  LoadPNGfromRes(HideMinusI, 'Minus2_PNG');
end;

procedure TForm1.HideMinusMyClick(Sender: TObject);
begin
  HideMemos;
  MyMinuss.Visible := true;
end;

procedure NoDup(Memo: TMemo);
var
  SL, SL2: TStringList;
  i, j, l, k, chet, dl1, dl2: integer;
  so: array [0 .. 20] of integer;
  stri, stri2: string;
  a: boolean;
begin
  i := 0;
  while i < Memo.Lines.Count - 1 do
  begin
    stri := Memo.Lines.Strings[i];
    SL := TStringList.Create;
    SL.Text := StringReplace(stri, ' ', #13#10, [rfReplaceAll]);
    dl1 := SL.Count;
    for j := Memo.Lines.Count - 1 downto i + 1 do
    begin
      for k := 0 to 19 do
        so[k] := 0; // sovpadeniya

      stri2 := Memo.Lines.Strings[j];
      dl2 := Slov(stri2);
      a := false;
      if dl1 = dl2 then
      begin
        SL2 := TStringList.Create;
        SL2.Text := StringReplace(stri2, ' ', #13#10, [rfReplaceAll]);

        chet := 0;
        for l := 0 to dl2 - 1 do
        begin
          for k := 0 to dl1 - 1 do
            if (AnsiCompareStr(SL2[l], SL[k]) = 0) then
            begin
              so[l] := 1;
            end
        end;
        for l := 0 to dl2 - 1 do
          chet := chet + so[l];
        if chet >= dl1 then
        begin
          a := true;
        end;
        FreeAndNil(SL2);
        if a then
        begin
          Memo.Lines.Delete(i);
          dec(i);
          break;
        end;
      end;
    end;

    FreeAndNil(SL);
    inc(i);
    if i mod 2 = 0 then
      Application.ProcessMessages;
  end;
end;

procedure SortByWord(Memo: TMemo);
var
  i: integer;
  stri, stri2, vr: string;
begin
  i := 0;
  while i < Memo.Lines.Count - 2 do
  begin
    stri := Memo.Lines.Strings[i];
    stri2 := Memo.Lines.Strings[i + 1];
    if Slov(stri) > Slov(stri2) then
    begin
      vr := stri2;
      stri2 := stri;
      stri := vr;
      Memo.Lines.Strings[i] := stri;
      Memo.Lines.Strings[i + 1] := stri2;
      if i > 0 then
      begin
        dec(i);
      end;
    end
    else
    begin
      inc(i);
    end;
    if i mod 10 = 0 then
      Application.ProcessMessages;
  end;
end;

procedure FSortByWord(SL: TStringList);
var
  i, k: integer;
  sls_i: array [0 .. 19] of integer;
  // stri, stri2, vr: string;
  SLS: array [0 .. 19] of TStringList;
begin
  for i := 0 to 18 do
    sls_i[i] := 0;
  i := 0;

  while i <= SL.Count - 1 do
  begin
    k := Slov(SL[i]);
    if sls_i[k] = 0 then
    begin
      SLS[k] := TStringList.Create(true);
      inc(sls_i[k]);
      SLS[k].Add(SL[i]);
    end
    else
    begin
      SLS[k].Add(SL[i]);
    end;
    if i mod 10 = 0 then
      Application.ProcessMessages;
    inc(i);
  end;
  SL.Text := '';
  for i := 0 to 18 do
    if sls_i[i] <> 0 then
      if SL.Text = '' then
      begin
        SL.Text := SLS[i].Text;
        FreeAndNil(SLS[i]);
      end
      else
      begin
        SL.Text := SL.Text + SLS[i].Text;
        FreeAndNil(SLS[i]);
      end;
end;

procedure QSortByWord(SL: TStringList; l, r: integer);
var
  i, j, M: integer;
  stri, stri2, vr: string;
begin

  if l < r then
  begin
    i := l;
    j := r;
    M := Slov(SL[i]);
    repeat
      while M < Slov(SL[j]) do
        j := j - 1;

      if i <= j then
      begin
        stri := SL[i];
        stri2 := SL[j];
        vr := stri2;
        stri2 := stri;
        stri := vr;
        SL[i] := stri;
        SL[j] := stri2;
        i := i + 1;
      end;
      while M > Slov(SL[i]) do
        i := i + 1;

      if i <= j then
      begin
        stri := SL[i];
        stri2 := SL[j];
        vr := stri2;
        stri2 := stri;
        stri := vr;
        SL[i] := stri;
        SL[j] := stri2;
        j := j - 1;
      end;
    until i > j;
    Application.ProcessMessages;
    QSortByWord(SL, l, j);
    QSortByWord(SL, i, r);
  end;
end;

{ procedure QSortByWord (Memo: TMemo; l,r:integer);
  var i,j,m:integer;
  stri, stri2, vr: string;
  SL: TStringList;
  begin
  SL := TStringList.Create;
  SL.Text := Memo.Text;
  if l < r then
  begin
  i:=l; j:=r;
  m:=Slov(Memo.Lines.Strings[i]);
  repeat
  while m<Slov(Memo.Lines.Strings[j]) do
  j:=j-1;

  if  i<=j then
  begin
  stri := Memo.Lines.Strings[i];
  stri2 := Memo.Lines.Strings[j];
  vr := stri2;
  stri2 := stri;
  stri := vr;
  Memo.Lines.Strings[i] := stri;
  Memo.Lines.Strings[j] := stri2;
  i:=i+1;
  end;
  while m>Slov(Memo.Lines.Strings[i]) do
  i:=i+1;

  if  i<=j then
  begin
  stri := Memo.Lines.Strings[i];
  stri2 := Memo.Lines.Strings[j];
  vr := stri2;
  stri2 := stri;
  stri := vr;
  Memo.Lines.Strings[i] := stri;
  Memo.Lines.Strings[j] := stri2;
  j:=j-1;
  end;
  until i>j;
  Application.ProcessMessages;
  QSortByWord(Memo, l, j);
  QSortByWord(Memo, i, r);
  end;
  if l < r then
  begin
  i:=l; j:=r;
  m:=Slov(SL[i]);
  repeat
  while m<Slov(SL[j]) do
  j:=j-1;

  if  i<=j then
  begin
  stri := SL[i];
  stri2 := SL[j];
  vr := stri2;
  stri2 := stri;
  stri := vr;
  SL[i] := stri;
  SL[j] := stri2;
  i:=i+1;
  end;
  while m>Slov(SL[i]) do
  i:=i+1;

  if  i<=j then
  begin
  stri := SL[i];
  stri2 := SL[j];
  vr := stri2;
  stri2 := stri;
  stri := vr;
  SL[i] := stri;
  SL[j] := stri2;
  j:=j-1;
  end;
  until i>j;
  Application.ProcessMessages;
  Memo.Text := SL.Text;
  FreeAndNil(SL);
  QSortByWord(Memo, l, j);
  QSortByWord(Memo, i, r);
  end;

  end; }

procedure StrToAny(stri: string; M: TMemo);
var
  SL, SS: TStringList;
  i, j: integer;
  b: boolean;
begin
  SL := TStringList.Create;
  SL.Text := StringReplace(stri, ' ', #13#10, [rfReplaceAll]);
  SS := TStringList.Create;
  SS.Text := M.Text;
  for i := 0 to SL.Count - 1 do
  begin
    b := false;
    for j := 0 to SS.Count - 1 do
      if AnsiCompareText(SL[i], SS[j]) = 0 then
      begin
        b := true;
        break;
      end;
    if not b then
      SS.Add(SL[i]);
  end;
  M.Text := SS.Text;
  FreeAndNil(SS);
end;

function WordInSG(strn: string; table: TStringGrid; stl: integer): boolean;
var
  b: boolean;
  i: integer;
begin
  b := false;
  for i := 0 to table.RowCount - 1 do
    if AnsiCompareText(strn, table.Cells[stl, i]) = 0 then
    begin
      b := true;
      break;
    end;
  WordInSG := b;
end;

procedure TForm1.MinusCrossAdd(Memo: TMemo; SG: TStringGrid; TP: TProgressBar);
var
  SL, SL2: TStringList;
  i, j, l, k, chet, dl1, dl2, r: integer;
  so: array [0 .. 20] of integer;
  stri, stri2, vr: string;
  a, b: boolean;
begin
  SLSL := TStringList.Create(true);
  SLSL.Duplicates := dupIgnore;
  SLSL.Text := Memo.Text;
  FSortByWord(SLSL);
  b := false;
  i := mca_i;
  while (not closebool) and (not b) do
  begin
    while i < SLSL.Count - 1 do // цикл сравнений первой фразы
    begin
      mca_i := i;
      TP.max := SLSL.Count - 1;
      TP.Position := i;
      // ShowMessage(inttostr(i)+' '+memo.Lines.Strings[i]);
      stri := SLSL[i]; // берем первую фразу
      SL := TStringList.Create;
      SL.Text := StringReplace(stri, ' ', #13#10, [rfReplaceAll]);
      // разбиваем на слова первую фразу
      dl1 := SL.Count; // считаем количество слов первой фразы

      for j := SLSL.Count - 1 downto i + 1 do // цикл сравнений второй фразы
      begin
        for k := 0 to 19 do // до 19 слов в строке
          so[k] := 0; // sovpadeniya

        stri2 := SLSL[j]; // берем вторую фразу
        dl2 := Slov(stri2); // считаем количество слов второй фразы

        a := false; // помечаем НЕТ
        if dl2 - dl1 > 1 then
        // Если слов во второй фразе больше как минимум на 2
        begin
          // ShowMessage(stri+' || '+stri2);
          SL2 := TStringList.Create;
          SL2.Text := StringReplace(stri2, ' ', #13#10, [rfReplaceAll]);
          // разбиваем на слова вторую фразу

          chet := 0;
          for l := 0 to dl2 - 1 do
          // проходим по словам второй фразы (здсь их больше) :: 4 слова во второй, 2 слова в первой
          begin
            for k := 0 to dl1 - 1 do // проходим по словам первой фразы
              if (AnsiCompareStr(SL2[l], SL[k]) = 0) then
              // точное совпадение слов второй и первой фраз
              begin
                so[l] := 1; // помечаем слово из второй фразы как совпавшее
              end
          end;
          for l := 0 to dl2 - 1 do // проходим по словам второй фразы
            chet := chet + so[l]; // считаем сколько совпало
          if chet >= dl1 then // если столько же сколько и в первой
          begin
            a := true; // помечаем ДА
          end;

          if a then // Если ДА
          begin
            for l := 0 to dl2 - 1 do // проходим по словам второй фразы
            begin
              if so[l] = 0 then // если слова первой фразы нет во второй фразе
              begin
                vr := AbsString(stri + ' ' + SL2[l]);
                if SLSL.IndexOf(vr) = -1 then // если такой фразы нет
                begin
                  SLSL.Add(vr);

                  if not WordInSG(vr, poisk, 4) then
                  begin
                    r := wasstrfullT2(stri2, SG, 4, 0, SG.RowCount - 1);
                    SG.Cells[0, k_word] := inttostr(k_word);
                    SG.Cells[1, k_word] := SG.Cells[1, r];
                    SG.Cells[2, k_word] := SG.Cells[2, r];
                    SG.Cells[3, k_word] := SG.Cells[3, r];
                    SG.Cells[4, k_word] := vr;
                    SG.Cells[5, k_word] := '1';
                    SG.RowCount := SG.RowCount + 1;
                    inc(k_word);
                  end;
                end;
                // добавляем фразу из первой + отсутствующим словом из второй  :: Получим 2 дополнительные фразы
              end;
            end;
          end;
          FreeAndNil(SL2);
        end;

        if closebool then
          break;
      end;

      FreeAndNil(SL);
      inc(i);
      if i mod 5 = 0 then
        Application.ProcessMessages;
      SLSL.Duplicates := dupIgnore;
      FSortByWord(SLSL);

      Memo.Text := SLSL.Text;
      if closebool then
        break;
    end;
    Application.ProcessMessages;
    b := true;
    SLSL.Sorted := true;
    SLSL.Sorted := false;
    FSortByWord(SLSL);
    Memo.Text := SLSL.Text;
    FreeAndNil(SLSL);
  end;
  if not closebool then
    mca_i := 0;
  { while i < Memo.Lines.Count - 1 do  //цикл сравнений первой фразы
    begin
    // ShowMessage(inttostr(i)+' '+memo.Lines.Strings[i]);
    stri := Memo.Lines.Strings[i]; //берем первую фразу
    sl := TStringList.Create;
    sl.Text := StringReplace(stri, ' ', #13#10, [rfReplaceAll]);    //разбиваем на слова первую фразу
    dl1 := sl.Count; //считаем количество слов первой фразы

    for j := Memo.Lines.Count - 1 downto i + 1 do  //цикл сравнений второй фразы
    begin
    for k := 0 to 19 do //до 19 слов в строке
    so[k] := 0; // sovpadeniya

    stri2 := Memo.Lines.Strings[j];  //берем вторую фразу
    dl2 := Slov(stri2); //считаем количество слов второй фразы
    a := false;  //помечаем НЕТ
    if dl2 - dl1 > 1 then  //Если слов во второй фразе больше
    begin
    // ShowMessage(stri+' || '+stri2);
    sl2 := TStringList.Create;
    sl2.Text := StringReplace(stri2, ' ', #13#10, [rfReplaceAll]); //разбиваем на слова вторую фразу

    chet := 0;
    for l := 0 to dl2 - 1 do //проходим по словам второй фразы (здсь их больше) :: 4 слова во второй, 2 слова в первой
    begin
    for k := 0 to dl1 - 1 do  //проходим по словам первой фразы
    if (AnsiCompareStr(sl2[l], sl[k]) = 0) then   //точное совпадение слов второй и первой фраз
    begin
    so[l] := 1;  //помечаем слово из второй фразы как совпавшее
    end
    end;
    for l := 0 to dl2 - 1 do //проходим по словам второй фразы
    chet := chet + so[l];  //считаем сколько совпало
    if chet >= dl1 then //если столько же сколько и в первой
    begin
    a := true; //помечаем ДА
    end;

    if a then  //Если ДА
    begin
    for l := 0 to dl2 - 1 do //проходим по словам второй фразы
    begin
    if so[l] = 0 then  //если слова первой фразы нет во второй фразе
    Memo.Lines.Add(stri + ' ' + sl2[l]); //добавляем фразу из первой + отсутствующим словом из второй  :: Получим 2 дополнительные фразы
    end;
    end;
    FreeAndNil(sl2);
    end;
    else if (dl2 - dl1 = 1) or (dl2 - dl1 = 0) then //разница на один или ноль по количеству слов
    begin

    end
    else     //в первой фразе слов больше чем во второй
    begin
    Memo.Lines.Add(stri); //добавляем первую фразу в конец
    Memo.Lines.Delete(i); //и удаляем в начале
    dec(i);               //остаемся на том же месте и выходим из обхода сравнений второй фразы
    break;
    end;
    end;

    FreeAndNil(sl);
    inc(i);
    if i mod 5 = 0 then
    Application.ProcessMessages;
    NoDup(Memo);
    SLSL := TStringList.Create(true);
    SLSL.Text := Memo.Text;
    FSortByWord(SLSL);
    Memo.Text := SLSL.Text;
    FreeAndNil(SLSL);
    end;        { }
  // ShowMessage('Da!');
end;

procedure MinusCrossMin(Memo: TMemo; minus: TMemo);
var
  SL2, SLSL: TStringList;
  i, j, l, chet, st: integer;
  stri, stri2, minusstri, Minuss: string;
begin
  minus.Clear;
  SLSL := TStringList.Create(true);
  SLSL.Duplicates := dupIgnore;
  SLSL.Text := Memo.Text;
  FSortByWord(SLSL);
  Memo.Text := SLSL.Text;
  FreeAndNil(SLSL);
  Minuss := '';
  st := mcm_i;
  for i := st to Memo.Lines.Count - 2 do // фраза
  begin
    Minuss := '';
    mcm_i := i;
    for j := i + 1 to Memo.Lines.Count - 1 do // откуда берем минуса
    begin
      stri := Memo.Lines.Strings[i];
      stri2 := Memo.Lines.Strings[j];
      chet := 0;
      minusstri := '';
      SL2 := TStringList.Create;
      SL2.Text := StringReplace(stri2, ' ', #13#10, [rfReplaceAll]);
      for l := 0 to SL2.Count - 1 do
      begin
        if SL2[l].length < 4 then
        begin
          if AnsiPos(SL2[l] + ' ', stri) = 1 then
          begin
            inc(chet);
          end
          else if AnsiPos(' ' + SL2[l], stri) = stri.length - SL2[l].length then
          begin
            inc(chet);
          end
          else if AnsiPos(' ' + SL2[l] + ' ', stri) > 1 then
          begin
            inc(chet);
          end;
        end
        else
        begin
          if AnsiPos(SL2[l], stri) > 0 then
            inc(chet)
          else
          begin
            if AnsiPos(SL2[l], Minuss) > 0 then
            begin

            end
            else
            begin
              if minusstri <> '' then
                minusstri := minusstri + ' -' + SL2[l]
              else
                minusstri := '-' + SL2[l];
            end;
          end;
        end;
      end;
      // minus.Lines.Add(stri + ' || ' + stri2 + ' || ' + inttostr(slov(stri)) + ' || ' + inttostr(chet) + ' || ' + inttostr(stri.Length-1));
      if (minusstri.length > 1) and (chet = Slov(stri)) then
      begin
        if Minuss <> '' then
          Minuss := Minuss + ' ' + minusstri
        else
          Minuss := minusstri;
      end;
      FreeAndNil(SL2);
    end;
    if i mod 5 = 0 then
      Application.ProcessMessages;
    minus.Lines.Add(stri + ' || ' + Minuss + ' || ' + inttostr(Slov(stri)))
  end;
  // minus.Lines.SaveToFile('asd.txt');
end;

procedure TForm1.MinusCrossMinT(Memo: TMemo; SG: TStringGrid; col: integer;
  TP: TProgressBar);
var
  SL2, SLSL: TStringList;
  i, j, l, chet, r, nr, start_i: integer;
  stri, stri2, minusstri, Minuss: string;
  b: boolean;
begin
  SLSL := TStringList.Create(true);
  SLSL.Duplicates := dupIgnore;
  SLSL.Text := Memo.Text;
  FSortByWord(SLSL);
  Memo.Text := SLSL.Text;
  start_i := mcm_i;
  b := false;
  while (not closebool) and (not b) do
  begin

    for i := start_i to SLSL.Count - 2 do // фраза
    begin
      Minuss := '';
      TP.max := SLSL.Count - 2;
      TP.Position := i;
      for j := i + 1 to SLSL.Count - 1 do // откуда берем минуса
      begin
        stri := SLSL[i];
        stri2 := SLSL[j];
        chet := 0;
        minusstri := '';
        SL2 := TStringList.Create;
        SL2.Text := StringReplace(stri2, ' ', #13#10, [rfReplaceAll]);
        for l := 0 to SL2.Count - 1 do
        begin
          if SL2[l].length < 4 then
          begin
            // if AnsiPos(SL2[l] + ' ', stri) = 1 then
            if WordInStr(SL2[l], stri) then
            begin
              inc(chet);
            end;
            { else if AnsiPos(' ' + SL2[l], stri) = stri.length - SL2[l].length
              then
              begin
              inc(chet);
              end
              else if AnsiPos(' ' + SL2[l] + ' ', stri) > 1 then
              begin
              inc(chet);
              end; }
          end
          else
          begin
            // if AnsiPos(SL2[l], stri) > 0 then
            if WordInStr(SL2[l], stri) then
              inc(chet)
            else
            begin
              // if AnsiPos(SL2[l], Minuss) > 0 then
              if not WordInStr('-' + SL2[l], Minuss) then
              begin
                if not WordInStr('-' + SL2[l], minusstri) then
                begin
                  if minusstri <> '' then
                    minusstri := minusstri + ' -' + SL2[l]
                  else
                    minusstri := '-' + SL2[l];
                end;
              end;
            end;
          end;
        end;
        // minus.Lines.Add(stri + ' || ' + stri2 + ' || ' + inttostr(slov(stri)) + ' || ' + inttostr(chet) + ' || ' + inttostr(stri.Length-1));
        if (minusstri.length > 1) and (chet = Slov(stri)) then
        begin
          if Minuss <> '' then
            Minuss := Minuss + ' ' + minusstri
          else
            Minuss := minusstri;
        end;
        FreeAndNil(SL2);
        if j mod 50 = 0 then
          Application.ProcessMessages;
      end;

      // minus.Lines.Add(stri + ' || ' + Minuss + ' || ' + inttostr(Slov(stri)))
      r := wasstrfullT2(stri, SG, 4, 0, SG.RowCount);
      // ShowMessage(stri + ' || ' + Minuss + ' || ' + inttostr(r));
      if r > -1 then
        SG.Cells[col, r] := Minuss
      else
      begin
        nr := 0;
        if SG.Cells[4, SG.RowCount - 2] = '' then
          nr := SG.RowCount - 2
        else
        begin
          if SG.Cells[4, SG.RowCount - 1] = '' then
          begin
            SG.RowCount := SG.RowCount + 1;
            nr := SG.RowCount - 2;
          end;
        end;
        SG.Cells[0, nr] := inttostr(SG.RowCount - 1);
        SG.Cells[1, nr] := stri;
        SG.Cells[2, nr] := stri;
        SG.Cells[3, nr] := '-1';
        SG.Cells[4, nr] := stri;
        SG.Cells[5, nr] := '1';
        SG.Cells[col, nr] := Minuss;
      end;
      mcm_i := i;
      if closebool then
        break;
    end;
    b := true;
  end;
  FreeAndNil(SLSL);
  mcm_i := 0;
  // minus.Lines.SaveToFile('asd.txt');
end;

procedure TForm1.MinussDblClick(Sender: TObject);
// var j, i: integer;
begin
  Minuss.Lines.Text := AnsiLowerCase(Minuss.Lines.Text);
  { for j := 0 to Minuss.Lines.Count - 1 do
    Minuss.Lines.Strings[j] := AnsiLowerCase(Minuss.Lines.Strings[j]);

    if PreKeySheet.Visible then
    for i := PreKey.Lines.Count - 1 downto 0 do
    for j := 0 to Minuss.Lines.Count - 1 do
    if AnsiPos(Minuss.Lines.Strings[j], PreKey.Lines.Strings[i]) > 0 then
    PreKey.Lines.Delete(i);
    if DokeySheet.Visible then
    for i := KeyCollector.Lines.Count - 1 downto 0 do
    for j := 0 to Minuss.Lines.Count - 1 do
    if AnsiPos(Minuss.Lines.Strings[j], KeyCollector.Lines.Strings[i]) > 0
    then
    KeyCollector.Lines.Delete(i); }
end;

procedure TForm1.MonthsClick(Sender: TObject);
begin
  TimeSliceRezult.Caption := Predpiska.Text + Months.Lines.Strings
    [Months.CaretPos.Y] + Dopiska.Text;
  ADS.Lines.Add(Predpiska.Text + Months.Lines.Strings[Months.CaretPos.Y] +
    Dopiska.Text);
end;

procedure TForm1.MyKeyDblClick(Sender: TObject);
begin
  MyKey.Lines.Delete(MyKey.CaretPos.Y);
end;

procedure TForm1.MyKeyKeyDown(Sender: TObject; var Key: Word;
  Shift: TShiftState);
begin
  if ssShift in Shift then
    MyKey.SelLength := 0;
end;

procedure TForm1.MyKeyKeyUp(Sender: TObject; var Key: Word; Shift: TShiftState);
begin
  MyKey.SelLength := 0;
end;

procedure TForm1.MyKeyMouseUp(Sender: TObject; Button: TMouseButton;
  Shift: TShiftState; X, Y: integer);
begin
  MyKey.SelLength := 0;
end;

procedure TForm1.MyMinussDblClick(Sender: TObject);
begin
  MyMinuss.Lines.Delete(MyMinuss.CaretPos.Y);
end;

procedure TForm1.NewZTZChange(Sender: TObject);
begin
  if rpls_col = 7 then
    MaxLenStr.Caption := inttostr(maxdlz1);
  if rpls_col = 8 then
    MaxLenStr.Caption := inttostr(maxdlz2);
  if rpls_col = 9 then
    MaxLenStr.Caption := inttostr(maxdltxt);
  if length(NewZTZ.Text) <= strtoint(MaxLenStr.Caption) then
    NewZTZ.Font.Color := clBlack
  else
    NewZTZ.Font.Color := clRed;
  LenStr.Caption := inttostr(length(NewZTZ.Text));
end;

procedure TForm1.RusToEnDblClick(Sender: TObject);
begin
  ShellExecute(0, 'open',
    'https://2ip.ru/punycode/?domain=сюда-вставить-сайт-на-русском-языке.рф',
    nil, nil, SW_SHOW);
end;

procedure TForm1.RusToEnMouseEnter(Sender: TObject);
var
  stri: string;
begin
  KonkurentHelp.Color := clGradientInactiveCaption;
  Application.ProcessMessages;
  HelpZoneP.Visible := true;
  HelpZone.Clear;
  stri := ' Клик - Перейти на сайт где можно изменить русскоязычное название сайта в латиницу для работы в Google.'
    + #13#10 + 'Пример с кириллицы: сюда-вставить-сайт-на-русском-языке.рф' +
    #13#10 + 'В латиницу: xn--------3vebbbpbty1aisuc9aqy6bieehaode0b6voa1d7c.xn--p1ai';
  HelpZone.Lines.Add(stri);
end;

procedure TForm1.RusToEnMouseLeave(Sender: TObject);
begin
  HelpZoneP.Visible := false;
end;

procedure TForm1.Panel54Click(Sender: TObject);
begin
  WorkTimesP.Visible := false;
  ObjShow(AdsControlP);
  WorkTime.Lines.SaveToFile(ExtractfilePath(Application.ExeName) +
    'Settings/work.txt');
  SheetList.Enabled := true;
  priblbool := true;
  if (ctrbool) and (stavkabool) and (priblbool) then
  begin
    nextbool := true;
    nextPNG.Enabled := true;
    LoadPNGfromRes(nextPNG, 'next_PNG');
  end;
  LoadPNGfromRes(PriblPNG, 'pribl2_PNG');
end;

procedure TForm1.Panel59Click(Sender: TObject);
begin
  { ShowMessage('Это займет какое-то время.' + #13#10 +
    ' После прохода каждого ключа, собранные ключи будут появляться слева.' +
    #13#10 + ' Всегда можно "подсмотреть" ;)'); }
  stage := 21;
  rsy_i := 0;
  rsy_np := 1;
  PrClearE.Visible := true;
  PrClear.Visible := true;
  DoErr.Visible := true;
  rsy.Cells[1, rsy_i] := SellPhraseMemo.Lines.Strings[SP_i];
  rsy.Cells[3, rsy_i] := '1';
  rsy.Visible := true;
  ParserRSY.Enabled := true;
end;

procedure TForm1.Panel60Click(Sender: TObject);
var
  CodeStr: string;
begin
  if Assigned(BR.Browser) and Assigned(BR.Browser.Mainframe) then
  begin
    CodeStr :=
      'var div=document.getElementById("press"); var evObj = document.createEvent("MouseEvents"); evObj.initEvent( "click", true, true ); div.dispatchEvent(evObj);';
    BR.Browser.Mainframe.ExecuteJavaScript(CodeStr, 'about:blank', 0);
  end;
end;

procedure TForm1.Panel65Click(Sender: TObject);
begin
  stage := 30;
  adsright_i := 0;
  AdsCreater.Enabled := true;
end;

procedure TForm1.Panel66Click(Sender: TObject);
begin
  sloy := 0;
  obji := 0;
  Pars(Memo3);
end;

procedure TForm1.Panel73Click(Sender: TObject);
begin
  Memo5.Lines.Clear;
  RegionsMI.Lines.Clear;
end;

procedure TForm1.Panel78MouseDown(Sender: TObject; Button: TMouseButton;
  Shift: TShiftState; X, Y: integer);
const
  SC_DragMove = $F012;
begin
  ReleaseCapture;
  ReplaceP.Perform(WM_SysCommand, SC_DragMove, 0);
end;

procedure TForm1.Panel79Click(Sender: TObject);
begin
  ReplaceP.Visible := false;
end;

procedure TForm1.Panel84Click(Sender: TObject);
begin
  ObjShow(LoadBarP); // Minuss, MyMinuss, Cities,
  ClearingS([ReplaceM], KeyCollector, poisk, 4, SovT.Position, DlSovT.Position,
    MinDlSlovT.Position, ClearChisloC.Checked, false, false, false, true,
    LoadBar2);
  MyMinuss.Text := MyMinuss.Text + ReplaceM.Text;
  ReplaceM.Clear;
  ReplaceR.Text := '';
  LoadBarP.Visible := false;
end;

procedure TForm1.Panel85Click(Sender: TObject);
begin
  ObjShow(LoadBarP);
  if KeyCollector.Visible then
  begin
    WordReplaceP(Memo4, KeyCollector, ReplaceM, SovT.Position,
      MinDlSlovT.Position, LoadBar, LoadBar2, ReplaceT, poisk);
  end;
  if AdsRight.Visible then
  begin
    WordReplaceP(Memo4, KeyCollector, ReplaceM, SovT.Position,
      MinDlSlovT.Position, LoadBar, LoadBar2, ReplaceT, poisk);
  end;
  ReplaceM.Clear;
  ReplaceW.Text := '';
  ReplaceR.Text := '';
  LoadBarP.Visible := false;
end;

procedure TForm1.Panel88Click(Sender: TObject);
begin
  CTASetP.Visible := false;
  ctabool := true;
  if (timebool) and (citybool) and (utpbool) and (ctabool) then
    FinishPNG.Enabled := true;
end;

procedure TForm1.Panel91Click(Sender: TObject);
begin
  UTPSetP.Visible := false;
  utpbool := true;
  if (timebool) and (citybool) and (utpbool) and (ctabool) then
    FinishPNG.Enabled := true;
end;

procedure TForm1.Panel96Click(Sender: TObject);
begin
  CitySetP.Visible := false;
  citybool := true;
  if (timebool) and (citybool) and (utpbool) and (ctabool) then
    FinishPNG.Enabled := true;
end;

procedure TForm1.Panel99Click(Sender: TObject);
begin
  TimeSetP.Visible := false;
  timebool := true;
  if (timebool) and (citybool) and (utpbool) and (ctabool) then
    FinishPNG.Enabled := true;
end;

procedure TForm1.DoRKClick(Sender: TObject);
begin
  // word_i := 0;
  // SP_i := 0;
  // adsright_i:=AdsRight.Lines.Count;
  // rsy_i := 1;
  if (DoRK.Caption = 'Продолжить...') and (not Finality.Enabled) then
    DoST.ItemIndex := DoST.ItemIndex + 1;

  if (DoRK.Caption <> 'Выполняется...') or (not Finality.Enabled) then
  begin
    statControl := false;
    // PersClear := ProcClearT.Position;
    perc_start := OtsevT.Position;
    // k_word := 0;
    rsy_start := 0;
    rsy_end := 0;
    parent_start := 0;
    parent_end := 0;
    kont_start := 0;
    iTimer := 0;
    kont_end := 0;
    yalog := '';
    yapas := '';
    st := 0;
    Finality.Enabled := true;
    ObjShow(LoadBarP);
    Loader.Enabled := true;
  end;
end;

procedure TForm1.DoRKMouseEnter(Sender: TObject);
begin
  DoRK.Color := clGradientInactiveCaption;
end;

procedure TForm1.DoRKMouseLeave(Sender: TObject);
begin
  DoRK.Color := clWindow;
end;

procedure TForm1.FastUrlButClick(Sender: TObject);
begin
  if fastbool then
  begin
    fastbool := false;
    FastUrlBut.Caption := '▲';
    FastP.Height := 138;
    AdsSet.Height := 392;
    FastHideP.Visible := true;
  end
  else
  begin
    fastbool := true;
    FastUrlBut.Caption := '▼';
    FastP.Height := 27;
    AdsSet.Height := 281;
    FastHideP.Visible := false;
  end;
end;

procedure TForm1.LoadImgClick(Sender: TObject);
var
  CodeStr: string;
begin
  if Assigned(BR.Browser) and Assigned(BR.Browser.Mainframe) then
  begin
    CodeStr :=
      '$("form").append(''<input name="lucky" type="hidden" onclick="return true;">'
      + '<input name="chel" type="hidden" onclick="return true;">' +
      '<input name="buton" type="submit" value="Загрузить файл!">' +
      '<input name="prod" type="hidden" onclick="return true;">'');';
    BR.Browser.Mainframe.ExecuteJavaScript(CodeStr, 'about:blank', 0);
  end;
  Button1.Click;
end;

procedure TForm1.DaysClick(Sender: TObject);
begin
  TimeSliceRezult.Caption := Predpiska.Text + Days.Lines.Strings
    [Days.CaretPos.Y] + Dopiska.Text;
  ADS.Lines.Add(Predpiska.Text + Days.Lines.Strings[Days.CaretPos.Y] +
    Dopiska.Text);
end;

procedure TForm1.DedlineHelpMouseEnter(Sender: TObject);
begin
  PreKeyHelp.Clear;
  PreKeyHelp.Lines.Strings[0] :=
    'Кликните по необходимому ограничению по времени для добавления в объявления.'
    + #13#10 + #13#10 +
    '{УТП} {ДЕДЛАЙН} {ПРИЗЫВ К ДЕЙСТВИЮ} - фразы значительно увеличивающие CTR объявления, т.е. кликабельность - процент соотношения кликов по объявлению к показам объявления. Чем выше CTR тем ниже стоимость клика.'
    + #13#10 +
    'Если текст объявления в сумме с дополнительными фразами не будет превышать 81 символов, то он будет дополнен фразами согласно Схемы составления текста объявления.';
  ObjShow(PreKeyHelpP);
end;

procedure TForm1.DedlineHelpMouseLeave(Sender: TObject);
begin
  PreKeyHelpP.Visible := false;
end;

procedure TForm1.CTAsHelpMouseEnter(Sender: TObject);
begin
  PreKeyHelp.Clear;
  PreKeyHelp.Lines.Strings[0] :=
    'Кликните по понравившейся строке с Призывом к действию для добавления в объявления.'
    + #13#10 + #13#10 +
    '{УТП} {ДЕДЛАЙН} {ПРИЗЫВ К ДЕЙСТВИЮ} - фразы значительно увеличивающие CTR объявления, т.е. кликабельность - процент соотношения кликов по объявлению к показам объявления. Чем выше CTR тем ниже стоимость клика.'
    + #13#10 +
    'Если текст объявления в сумме с дополнительными фразами не будет превышать 81 символов, то он будет дополнен фразами согласно Схемы составления текста объявления.';
  ObjShow(PreKeyHelpP);
end;

procedure TForm1.CTAsHelpMouseLeave(Sender: TObject);
begin
  PreKeyHelpP.Visible := false;
end;

procedure TForm1.ActsHelpMouseEnter(Sender: TObject);
begin
  PreKeyHelp.Clear;
  PreKeyHelp.Lines.Strings[0] :=
    'Кликните по понравившейся строке с УТП / АКЦИЕЙ для добавления в объявления.'
    + #13#10 + #13#10 +
    '{УТП} {ДЕДЛАЙН} {ПРИЗЫВ К ДЕЙСТВИЮ} - фразы значительно увеличивающие CTR объявления, т.е. кликабельность - процент соотношения кликов по объявлению к показам объявления. Чем выше CTR тем ниже стоимость клика.'
    + #13#10 +
    'Если текст объявления в сумме с дополнительными фразами не будет превышать 81 символов, то он будет дополнен фразами согласно Схемы составления текста объявления.';
  ObjShow(PreKeyHelpP);
end;

procedure TForm1.ActsHelpMouseLeave(Sender: TObject);
begin
  PreKeyHelpP.Visible := false;
end;

procedure TForm1.AddiChange(Sender: TObject);
begin
  if next_i = 15 then
    changebool := true;
end;

procedure TForm1.addprodPNGClick(Sender: TObject);
begin
  next_i := 12;
  Edit.Text := '';
  Edit.TextHint := 'Новый Товар/Услугу';
  addprodPNG.Visible := false;
  newprodbool := true;
  HelpInput.Caption :=
    '(: На английском языке без знаков. Пример: directologplus';
  InfoL.Caption := Edit.TextHint;
  LoadPNGfromRes(InfoI, 'PngImage_9');
end;

procedure TForm1.addprodPNGMouseEnter(Sender: TObject);
begin
  HintClick.Font.Color := clBlack;
  LoadPNGfromRes(ClickPNG, 'Click2_PNG');
  if changebool then
    SaveChanges.Caption := 'Сохраните изменения';
end;

procedure TForm1.addprodPNGMouseLeave(Sender: TObject);
begin
  HintClick.Font.Color := clSilver;
  LoadPNGfromRes(ClickPNG, 'Click_PNG');
end;

procedure TForm1.SaveData(code: string);
var
  dobbools, formlistclear, clearchislo, fastclear, otsevs, FindProxys: string;
begin
  if (code <> '') and (DirectoryExists(ExtractfilePath(Application.ExeName) +
    'Projects/' + code)) then
  begin
    Minuss.Lines.SaveToFile(ExtractfilePath(Application.ExeName) +
      'minus/minuss.txt');
    MyMinuss.Lines.SaveToFile(ExtractfilePath(Application.ExeName) + 'Projects/'
      + code + '/' + code + '_myminuss.txt');
    KeyCollector.Lines.SaveToFile(ExtractfilePath(Application.ExeName) +
      'Projects/' + code + '/' + code + '_keys.txt');
    Memo4.Lines.SaveToFile(ExtractfilePath(Application.ExeName) + 'Projects/' +
      code + '/' + code + '_diffkeys.txt');
    MyKey.Lines.SaveToFile(ExtractfilePath(Application.ExeName) + 'Projects/' +
      code + '/' + code + '_mykey.txt');
    DoSP.Lines.SaveToFile(ExtractfilePath(Application.ExeName) + 'Projects/' +
      code + '/' + code + '_sellphrase.txt');
    DoSR.Lines.SaveToFile(ExtractfilePath(Application.ExeName) + 'Projects/' +
      code + '/' + code + '_sellphraseRSY.txt');
    PreKey.Lines.SaveToFile(ExtractfilePath(Application.ExeName) + 'Projects/' +
      code + '/' + code + '_prekey.txt');
    PreKeyRSY.Lines.SaveToFile(ExtractfilePath(Application.ExeName) +
      'Projects/' + code + '/' + code + '_prekeyRSY.txt');
    LocalMinus.Lines.SaveToFile(ExtractfilePath(Application.ExeName) +
      'Projects/' + code + '/' + code + '_localminus.txt');
    Minuss.Lines.SaveToFile(ExtractfilePath(Application.ExeName) + 'Projects/' +
      code + '/' + code + '_minuss.txt');
    RekMemo.Lines.SaveToFile(ExtractfilePath(Application.ExeName) + 'Projects/'
      + code + '/' + code + '_rek.txt');
    ZagMemo.Lines.SaveToFile(ExtractfilePath(Application.ExeName) + 'Projects/'
      + code + '/' + code + '_zag.txt');
    AdsMemo.Lines.SaveToFile(ExtractfilePath(Application.ExeName) + 'Projects/'
      + code + '/' + code + '_ads.txt');
    AdsRight.Lines.SaveToFile(ExtractfilePath(Application.ExeName) + 'Projects/'
      + code + '/' + code + '_adsright.txt');
    AdsRightZags.Lines.SaveToFile(ExtractfilePath(Application.ExeName) +
      'Projects/' + code + '/' + code + '_adsrightzags.txt');
    AdsRightZags2.Lines.SaveToFile(ExtractfilePath(Application.ExeName) +
      'Projects/' + code + '/' + code + '_adsrightzags2.txt');
    teplota.Lines.SaveToFile(ExtractfilePath(Application.ExeName) + 'Projects/'
      + code + '/' + code + '_tep.txt');
    KeyPhraze.Lines.SaveToFile(ExtractfilePath(Application.ExeName) +
      'Projects/' + code + '/' + code + '_kp.txt');
    WorkTime.Lines.SaveToFile(ExtractfilePath(Application.ExeName) + 'Projects/'
      + code + '/' + code + '_work.txt');
    SiteList.Lines.SaveToFile(ExtractfilePath(Application.ExeName) + 'Projects/'
      + code + '/' + code + '_sites.txt');

    Chto.Lines.SaveToFile(ExtractfilePath(Application.ExeName) + 'Projects/' +
      code + '/' + code + '_chto.txt');
    Kakoe.Lines.SaveToFile(ExtractfilePath(Application.ExeName) + 'Projects/' +
      code + '/' + code + '_kakoe.txt');
    Deistvie.Lines.SaveToFile(ExtractfilePath(Application.ExeName) + 'Projects/'
      + code + '/' + code + '_deistvie.txt');
    ProdDob.Lines.SaveToFile(ExtractfilePath(Application.ExeName) + 'Projects/'
      + code + '/' + code + '_proddob.txt');
    Mesto.Lines.SaveToFile(ExtractfilePath(Application.ExeName) + 'Projects/' +
      code + '/' + code + '_mesto.txt');
    Konkurenty.Lines.SaveToFile(ExtractfilePath(Application.ExeName) +
      'Projects/' + code + '/' + code + '_konkurenty.txt');
    Memo5.Lines.SaveToFile(ExtractfilePath(Application.ExeName) + 'Projects/' +
      code + '/' + code + '_regions.txt');
    RegionsMI.Lines.SaveToFile(ExtractfilePath(Application.ExeName) +
      'Projects/' + code + '/' + code + '_regions_id.txt');

    ADS.Lines.SaveToFile(ExtractfilePath(Application.ExeName) + 'Projects/' +
      code + '/' + code + '_vremya.txt');
    CitiesCh.Lines.SaveToFile(ExtractfilePath(Application.ExeName) + 'Projects/'
      + code + '/' + code + '_gorod.txt');
    UTPch.Lines.SaveToFile(ExtractfilePath(Application.ExeName) + 'Projects/' +
      code + '/' + code + '_utp.txt');
    CTAch.Lines.SaveToFile(ExtractfilePath(Application.ExeName) + 'Projects/' +
      code + '/' + code + '_cta.txt');

    { HideMemo.Lines.Clear;
      HideMemo.Lines.Add(inttostr(rsy_i));
      HideMemo.Lines.Add(inttostr(lvl_start));
      HideMemo.Lines.Add(inttostr(lvl_end));
      HideMemo.Lines.Add(OtsevE.Text);
      HideMemo.Lines.Add(inttostr(SP_i));
      HideMemo.Lines.Add(inttostr(DoST.ItemIndex));
      HideMemo.Lines.Add(inttostr(word_i));
      HideMemo.Lines.Add(inttostr(adsright_i));
      HideMemo.Lines.Add(inttostr(k_word));
      HideMemo.Lines.Add(inttostr(pages_i));

      HideMemo.Lines.Add(inttostr(mca_i));
      HideMemo.Lines.Add(inttostr(mcm_i));

      HideMemo.Lines.SaveToFile(ExtractfilePath(Application.ExeName) + 'Projects/'
      + code + '/' + code + '_rsyi.txt'); }
    if OtsevC.Checked then
    begin
      // HideMemo.Lines.Add('1');
      otsevs := '1';
    end
    else
    begin
      // HideMemo.Lines.Add('0');
      otsevs := '0';
    end;

    if dobbool then
    begin
      // HideMemo.Lines.Add('1');
      dobbools := '1';
    end
    else
    begin
      // HideMemo.Lines.Add('0');
      dobbools := '0';
    end;

    if FormListClearC.Checked then
    begin
      // HideMemo.Lines.Add('1');
      formlistclear := '1';
    end
    else
    begin
      // HideMemo.Lines.Add('0');
      formlistclear := '0';
    end;

    if ClearChisloC.Checked then
    begin
      // HideMemo.Lines.Add('1');
      clearchislo := '1';
    end
    else
    begin
      // HideMemo.Lines.Add('0');
      clearchislo := '0';
    end;

    if FastClearCh.Checked then
    begin
      // HideMemo.Lines.Add('1');
      fastclear := '1';
    end
    else
    begin
      // HideMemo.Lines.Add('0');
      fastclear := '0';
    end;

    if FindProxyCh.Checked then
    begin
      // HideMemo.Lines.Add('1');
      FindProxys := '1';
    end
    else
    begin
      // HideMemo.Lines.Add('0');
      FindProxys := '0';
    end;

    ZConnection1.Connected := false;
    ZConnection1.Connected := true;
    ZQuery1.SQL.Text := 'UPDATE `product` SET `rsy_i`=''' + inttostr(rsy_i) +
      ''', `lvl_start`=''' + inttostr(lvl_start) + ''', `meter`=''' + metrika +
      ''', `lvl_end`=''' + inttostr(lvl_end) + ''', `OtsevC`=''' + otsevs +
      ''', `OtsevE`=''' + OtsevE.Text + ''', `SovE`=''' + SovE.Text +
      ''', `DlSovE`=''' + DlSovE.Text + ''', `MinDlSlovE`=''' + MinDlSlovE.Text
      + ''', `ProcClearE`=''' + ProcClearE.Text + ''', `FormListClearC`=''' +
      formlistclear + ''', `ClearChisloC`=''' + clearchislo +
      ''', `FastClearCh`=''' + fastclear + ''', `SP_i`=''' + inttostr(SP_i) +
      ''', `DoST`=''' + inttostr(DoST.ItemIndex) + ''', `word_i`=''' +
      inttostr(word_i) + ''', `adsright_i`=''' + inttostr(adsright_i) +
      ''', `k_word`=''' + inttostr(k_word) + ''', `pages_i`=''' +
      inttostr(pages_i) + ''', `dobbool`=''' + dobbools + ''', `mca_i`=''' +
      inttostr(mca_i) + ''', `mcm_i`=''' + inttostr(mcm_i) + ''', `sin_i`=''' +
      inttostr(i_sin) + ''', `rpls_col`=''' + inttostr(ReplaceT.ColCount) +
      ''', `FindProxyCh`=''' + FindProxys + ''', `Budget`=''' + BudgetE.Text +
      ''', `camp_i`=''' + inttostr(group_i) + ''', `group_i`=''' +
      inttostr(group_i) + ''', `vcard_i`=''' + inttostr(vcard_i) +
      ''', `ads_i`=''' + inttostr(ads_i) + ''', `regionsz`=''' + regionsz +
      ''' WHERE `id`=''' + id_prod + '''';
    ZQuery1.ExecSQL; { }

    ZQuery1.SQL.Text := 'UPDATE `users` SET `Token`=''' + token +
      ''', `lastprod`=''' + inttostr(CodeName.ItemIndex) + ''' WHERE `email`='''
      + login + ''' OR `phone`=''' + login + '''';
    ZQuery1.ExecSQL;
    SaveTable(ReplaceT, code, '_rpls');
    if auto then
    begin
      SaveTable(rsy2, code, '_rsy');
      SaveTable(poisk, code, '_poisk');
    end
    else
      SaveTable(rsy, code, '_rsy');
  end;
end;

procedure TForm1.Sheet1Click(Sender: TObject);
begin
  SheetHide;
  ObjShow(InfoSheet);
  HideP.Visible := false;
  HideL.Visible := false;
  if not first then
  begin
    SaveData(code);
    first := true;
    code := '';
    SheetList.Visible := false;
    GlobalPNG.Visible := false;
    SettingsPNG.Visible := false;
    proxyPNG.Visible := false;
    next_i := 15;
  end;
end;

procedure TForm1.Sheet1MouseEnter(Sender: TObject);
begin
  Sheet1.BevelInner := bvLowered;
  Sheet1.BevelOuter := bvRaised;
end;

procedure TForm1.Sheet1MouseLeave(Sender: TObject);
begin
  Sheet1.BevelInner := bvNone;
  Sheet1.BevelOuter := bvNone;
end;

procedure TForm1.Sheet2Click(Sender: TObject);
begin
  SheetHide;
  ObjShow(AdsSheet);
  HideP.Visible := false;
  HideL.Visible := false;
end;

procedure TForm1.Sheet2MouseEnter(Sender: TObject);
begin
  Sheet2.BevelInner := bvLowered;
  Sheet2.BevelOuter := bvRaised;
end;

procedure TForm1.Sheet2MouseLeave(Sender: TObject);
begin
  Sheet2.BevelInner := bvNone;
  Sheet2.BevelOuter := bvNone;
end;

procedure TForm1.Sheet3Click(Sender: TObject);
begin
  SheetHide;
  ObjShow(SheetDo);
  // if lvlentry > 1 then
  begin
    ObjShow(HideP);
    ObjShow(HideL);
  end;
end;

procedure TForm1.Sheet3MouseEnter(Sender: TObject);
begin
  Sheet3.BevelInner := bvLowered;
  Sheet3.BevelOuter := bvRaised;
end;

procedure TForm1.Sheet3MouseLeave(Sender: TObject);
begin
  Sheet3.BevelInner := bvNone;
  Sheet3.BevelOuter := bvNone;
end;

procedure TForm1.Sheet4Click(Sender: TObject);
begin
  SheetHide;
  ObjShow(FinishSheet);
end;

procedure TForm1.Sheet4MouseEnter(Sender: TObject);
begin
  Sheet4.BevelInner := bvLowered;
  Sheet4.BevelOuter := bvRaised;
end;

procedure TForm1.Sheet4MouseLeave(Sender: TObject);
begin
  Sheet4.BevelInner := bvNone;
  Sheet4.BevelOuter := bvNone;
end;

procedure TForm1.Sheet5Click(Sender: TObject);
var
  i: integer;
begin
  ObjShow(AdsSheet);
  ObjShow(AdsControlP);
  DokeySheet.Visible := false;
  PreKeySheet.Visible := false;
  InfoSheet.Visible := false;
  ThreeSheet.Visible := false;
  KeysP.Parent := AdsSheet;
  KeysP.Visible := false;
  KeysP.TabOrder := 0;
  { AdsRightP.Visible := false;
    AdsRightZagsP.Visible := false;
    AdsRightP.Align := alLeft; }

  if AdsRight.Text = '' then
    AdsRight.Text := KeyCollector.Text;
  // AdsRightZagsP.Align := alLeft;
  if AdsRightZags.Text = '' then
    AdsRightZags.Text := KeyCollector.Text;

  if AdsRightZags2.Text = '' then
  begin
    AdsRightZags2.Text := KeyCollector.Text;
    for i := 0 to AdsRightZags2.Lines.Count - 1 do
      AdsRightZags2.Lines.Strings[i] := '';
  end;

  if teplota.Text = '' then
  begin
    teplota.Text := KeyCollector.Text;
    for i := 0 to teplota.Lines.Count - 1 do
      teplota.Lines.Strings[i] := '0';
  end;
  adsright_i := 0;
  AdsRightE.Text := AdsRight.Lines.Strings[adsright_i];
  AdsRightZagE.Text := AdsRightZags.Lines.Strings[adsright_i];
  AdsRightZag2E.Text := AdsRightZags2.Lines.Strings[adsright_i];
  AdsRightL.Caption := KeyCollector.Lines.Strings[adsright_i];
  TeplotaShape.Visible := true;
  if teplota.Lines.Strings[adsright_i] = '0' then
    TeplotaShape.Visible := false;
  if teplota.Lines.Strings[adsright_i] = '1' then
    TeplotaShape.Left := ColdPNG.Left;
  if teplota.Lines.Strings[adsright_i] = '2' then
    TeplotaShape.Left := HeatPNG.Left;
  if teplota.Lines.Strings[adsright_i] = '3' then
    TeplotaShape.Left := HotPNG.Left;

  LoadScreen.Visible := false;
end;

procedure TForm1.Sheet5MouseEnter(Sender: TObject);
begin
  Sheet5.BevelInner := bvLowered;
  Sheet5.BevelOuter := bvRaised;
end;

procedure TForm1.Sheet5MouseLeave(Sender: TObject);
begin
  Sheet5.BevelInner := bvNone;
  Sheet5.BevelOuter := bvNone;
end;

procedure TForm1.Sheet6Click(Sender: TObject);
begin
  if nextbool then
  begin
    SheetHide;
    ObjShow(FinishSheet);
  end;
end;

procedure TForm1.Sheet6MouseEnter(Sender: TObject);
begin
  Sheet6.BevelInner := bvLowered;
  Sheet6.BevelOuter := bvRaised;
end;

procedure TForm1.Sheet6MouseLeave(Sender: TObject);
begin
  Sheet6.BevelInner := bvNone;
  Sheet6.BevelOuter := bvNone;
end;

procedure TForm1.Sheet7Click(Sender: TObject);
begin
  SheetHide;
  ObjShow(SiteSheet);
end;

procedure TForm1.Sheet7MouseEnter(Sender: TObject);
begin
  Sheet7.BevelInner := bvLowered;
  Sheet7.BevelOuter := bvRaised;
end;

procedure TForm1.Sheet7MouseLeave(Sender: TObject);
begin
  Sheet7.BevelInner := bvNone;
  Sheet7.BevelOuter := bvNone;
end;

procedure TForm1.Parse;
var
  vr: string;
begin

  if AnsiPos('b-phrase-link__link', Memo1.Text) > 0 then
  begin
    wc := wc + 1;

    vr := parsec(Memo1, 'b-phrase-link__link', '');

    KeyPhraze.Lines.Add(PreKey.Lines.Strings[word_i] + '|*|' + vr);
    Keys.Lines.Add(vr);
    // rsy.Cells[0, rsy.RowCount - 1] := wordrsy;
    // StringReplace(parsec(Memo1, 'b-word-statistics__td-number', ''), '&nbsp;','', [rfReplaceAll]);
  end
  else
  begin
    // ShowMessage('Cj');

    kont_end := kont_start + wc;
    stage := 5;
  end;
end;

procedure TForm1.ParseAuto(s: string; b: boolean);
var
  stat, i { , j, r, rg } : integer;
  vr { , campname, groupname } : string;
  bf : boolean;
begin
  if b then
  begin
    bf:=true;
    for i := 9 to associate_i do
    begin
      if AnsiPos(s, ParsObjs.objs[i].param) > 0 then
      begin
        // ShowMessage(StringReplace(ParsObjs.objs[i+4].innerTxt, '&nbsp;', '', [rfReplaceAll]));
        stat := strtoint(StringReplace(ParsObjs.objs[i + 4].innerTxt, '&nbsp;',
          '', [rfReplaceAll]));
        if stat * word_stat < ProcClearT.Position then
        begin
          statControl := true;
        end
        else
        begin
          vr := AbsString(NoPlusString(ParsObjs.objs[i].innerTxt));
          KeyPhraze.Lines.Add(PreKey.Lines.Strings[word_i] + '|*|' +
            ParsObjs.objs[i].innerTxt + '|*|' + vr);
          KeyCollector.Lines.Add(vr);
          StrToAny(vr, Memo4);
          if fastclear then
          begin
            vr := ClearingStr(vr, Minuss);
            vr := ClearingStr(vr, MyMinuss);
          end;
          if not WordInSG(vr, poisk, 2) then
          begin
            poisk.Cells[0, k_word] := inttostr(k_word);
            poisk.Cells[1, k_word] := PreKey.Lines.Strings[word_i];
            poisk.Cells[2, k_word] := ParsObjs.objs[i].innerTxt;
            poisk.Cells[3, k_word] := inttostr(stat);
            poisk.Cells[4, k_word] := vr;
            poisk.Cells[5, k_word] := '1';
            poisk.Cells[19, k_word] := 'poisk'; // rsya/poisk
            poisk.Cells[30, k_word] := '1'; // teplota
            // poisk.Cells[18, k_word] := '0'; //malo pokazov? //заполнять во время добавления '' - не добавлено, '0' - добавлено, показывается, '1' - добавлено, не показывается
            poisk.Cells[20, k_word] := floattostr(RoundTo(StavkaF * 0.8, -1));
            // stavka
            poisk.Cells[29, k_word] := StavkaP.Caption; // max stavka
            poisk.Cells[21, k_word] := floattostr(RoundTo(StavkaF * 0.2, -1));
            // stavka v setyah
            poisk.Cells[27, k_word] := hrefdesc.Text;
            { poisk.Cells[10, i] := UTPch.Lines.Strings[0];              //доделать
              poisk.Cells[11, i] := ADS.Lines.Strings[0];
              poisk.Cells[12, i] := CTAch.Lines.Strings[0];
              poisk.Cells[19, i] := 'poisk'; // rsya/poisk
              poisk.Cells[30, i] := '1'; // teplota
              // poisk.Cells[18, i] := '0'; //malo pokazov?
              poisk.Cells[20, i] := floattostr(StavkaF * 0.8); // stavka
              poisk.Cells[29, i] := StavkaP.Caption; // max stavka
              poisk.Cells[21, i] := floattostr(StavkaF * 0.2); // stavka v setyah
              poisk.Cells[27, i] := hrefdesc.Text;

              vr := poisk.Cells[4, i];
              for j := 1 to ProdDob.Lines.Count - 1 do
              if WordInStrP(ProdDob.Lines.Strings[j], vr, SovT.Position,
              MinDlSlovT.Position) then
              begin
              poisk.Cells[28, i] := 'ком';
              break;
              end;
              if poisk.Cells[28, i] = '' then
              for j := 0 to Cities.Lines.Count - 1 do
              if WordInStrP(AnsiLowerCase(Cities.Lines.Strings[j]), vr, SovT.Position,
              MinDlSlovT.Position) then
              begin
              poisk.Cells[28, i] := 'гео';
              break;
              end;
              if poisk.Cells[28, i] = '' then
              for j := 0 to vopros.Lines.Count - 1 do
              if WordInStrP(vopros.Lines.Strings[j], vr, SovT.Position,
              MinDlSlovT.Position) then
              begin
              poisk.Cells[28, i] := 'инф';
              break;
              end;
              if poisk.Cells[28, i] = '' then
              for j := 0 to media.Lines.Count - 1 do
              if WordInStrP(media.Lines.Strings[j], vr, SovT.Position,
              MinDlSlovT.Position) then
              begin
              poisk.Cells[28, i] := 'мед';
              break;
              end;
              if poisk.Cells[28, i] = '' then
              poisk.Cells[28, i] := 'общ'; }
            { ampname := poisk.Cells[19, k_word];
              if poisk.Cells[30, k_word]<>'' then
              campname := campname + '_' + poisk.Cells[30, k_word];
              if regions<>'' then
              campname := campname + '_' + regions;
              r := wasstrposT(campname, CountControl, 0);
              if r >-1 then
              begin
              campname := campname + '_' + CountControl.Cells[2, r];
              end
              else
              begin
              if strtoint(CountControl.Cells[4, 0])<1000 then
              begin
              CountControl.Cells[4, 0] := inttostr(strtoint(CountControl.Cells[4, 0]) + 1);
              CountControl.Cells[0, CountControl.RowCount - 1] := campname;
              CountControl.Cells[2, CountControl.RowCount - 1] := '1';
              CountControl.Cells[3, CountControl.RowCount - 1] := '1';
              CountControl.RowCount := CountControl.RowCount + 1;
              end
              else
              ShowMessage('Достигли максимума количества кампаний! Обратитесь к специалистам.');
              end;
              poisk.Cells[13, k_word] := campname;

              for j := 1 to ProdDob.Lines.Count - 1 do
              if WordInStrP(ProdDob.Lines.Strings[j], vr, SovT.Position, 2) then
              poisk.Cells[28, k_word] := 'ком';
              if poisk.Cells[28, k_word] = '' then
              for j := 0 to Cities.Lines.Count - 1 do
              if WordInStrP(Cities.Lines.Strings[j], vr, SovT.Position, 2) then
              poisk.Cells[28, k_word] := 'гео';
              if poisk.Cells[28, k_word] = '' then
              for j := 0 to vopros.Lines.Count - 1 do
              if WordInStrP(vopros.Lines.Strings[j], vr, SovT.Position, 2) then
              poisk.Cells[28, k_word] := 'инф';
              if poisk.Cells[28, k_word] = '' then
              for j := 0 to media.Lines.Count - 1 do
              if WordInStrP(media.Lines.Strings[j], vr, SovT.Position, 2) then
              poisk.Cells[28, k_word] := 'мед';
              if poisk.Cells[28, k_word] = '' then
              poisk.Cells[28, k_word] := 'общ';
              groupname:='';
              groupname := campname + '_' + poisk.Cells[28, k_word];
              rg := wasstrposT(groupname, CountControl, 0);
              if rg >-1 then
              begin
              groupname := groupname + '_' + CountControl.Cells[2, rg];
              end
              else
              begin
              if strtoint(CountControl.Cells[4, r])<1000 then
              begin
              CountControl.Cells[2, 0] := inttostr(strtoint(CountControl.Cells[2, 0]) + 1);
              CountControl.Cells[0, CountControl.RowCount - 1] := groupname;
              CountControl.Cells[2, CountControl.RowCount - 1] := '1';
              CountControl.Cells[3, CountControl.RowCount - 1] := '2';
              CountControl.Cells[4, CountControl.RowCount - 1] := '0';
              groupname := groupname + '_' + CountControl.Cells[2, CountControl.RowCount - 1];
              CountControl.RowCount := CountControl.RowCount + 1;
              end
              else
              ShowMessage('Достигли максимума количества групп в кампании! Обратитесь к специалистам.');
              end;
              poisk.Cells[14, i] := groupname; }
              bf:= true;
            poisk.RowCount := poisk.RowCount + 1;
            inc(k_word);
          end;
        end;
      end
    end;
    if truefind then
      if not bf then
        b := false;
  end;
end;

procedure TForm1.ParserRSYTimer(Sender: TObject);
begin
  if (stage = 20) then
  begin
    ParserRSY.Interval := 300;
    pasteWordRSY;
  end
  else if (stage = 21) then
  begin
    ParserRSY.Interval := 3000 + random(2000);
    clickFindRSY;
  end
  else if (stage = 22) then
  begin
    ParserRSY.Interval := 300;
    TakePageRSY;
  end
  else if (stage = 23) then
  begin
    ParseRSY;
  end
  else if (stage = 24) then
  begin
    AssociateRSY;
  end
  else if (stage = 25) then
  begin
    KorRSY;
  end
  else if (stage = 27) then
  begin
    checkWordRSY;
  end;
end;

procedure TForm1.ParseRSY;
begin
  if AnsiPos('b-phrase-link__link', Memo1.Text) > 0 then
  begin
    rsy.Cells[0, rsy.RowCount - 1] := wordrsy;
    rsy.Cells[1, rsy.RowCount - 1] := parsec(Memo1, 'b-phrase-link__link', '');
    rsy.Cells[2, rsy.RowCount - 1] :=
      StringReplace(parsec(Memo1, 'b-word-statistics__td-number', ''), '&nbsp;',
      '', [rfReplaceAll]);
    rsy.RowCount := rsy.RowCount + 1;
  end
  else
  begin
    rsy_end := rsy.RowCount - 2;
    stage := 25;
  end;
end;

procedure TForm1.ParseRSYA(s: string; SG: TStringGrid; b: boolean);
var
  i: integer;
  c: boolean;
begin
  if b then
  begin
    c := false;
    for i := associate_i to ParsObjs.obji - 5 do
    begin
      // ShowMessage('aa '+inttostr(i)+' '+ParsObjs.objs[i].param);
      if AnsiPos(s, ParsObjs.objs[i].param) > 0 then
      begin
        SG.Cells[1 + SP_i * 5, SG.RowCount - 1] := AnsiLowerCase(wordrsy);
        SG.Cells[2 + SP_i * 5, SG.RowCount - 1] :=
          AnsiLowerCase(ParsObjs.objs[i].innerTxt);
        SG.Cells[3 + SP_i * 5, SG.RowCount - 1] :=
          StringReplace(ParsObjs.objs[i + 4].innerTxt, '&nbsp;', '',
          [rfReplaceAll]);
        SG.RowCount := SG.RowCount + 1;
        c := true;
      end;
    end;
    if c then
      rsy_end := SG.RowCount - 2
    else
    begin
      if st = 6 then
        st := 12;
      if st = 10 then
        st := 11;
    end;
  end
  else
  begin
    ShowMessage('asd1');
  end;
end;

procedure TForm1.AssociateRSY;
begin
  parsec(Memo1, 'b-word-statistics__phrases-associations', '');
  stage := 23;
  rsy_start := rsy.RowCount - 1;
end;

procedure TForm1.AutoSaveTimer(Sender: TObject);
begin
  if code <> '' then
    SaveData(code);
end;

procedure TForm1.KorRSY;
var
  ii, jj, kk, vsya, sl1, SL2, sl3, sk, f, km, kd, kr, kof, indr: integer;
  // sl1,sl2,sl3 фразы до трех слов
  sk0, sks, ssk, p, srr, sr, d, dd, dr, kof1, kof2: real;
  b: boolean;
  reb, vr: string;
  SL: TStringList;
begin

  if rsy_np <> 1 then
  begin
    ParserRSY.Enabled := false;

    f := rsy_i;
    while rsy.Cells[0, f] = rsy_parent do
    begin
      dec(f);
    end;
    inc(f);
    parent_start := f;
    while rsy.Cells[0, f] = rsy_parent do
    begin
      inc(f);
    end;
    dec(f);
    parent_end := f;

    for jj := rsy_start to rsy_end do
    begin

      vr := rsy.Cells[1, jj];

      if (Slov(vr) > 3) or (Slov(vr) < 2) then
      begin
        DeleteARow(rsy, jj);
        dec(rsy_end);
      end
      else

      begin
        kk := jj + 1;
        while kk <= rsy_end do
        begin

          km := KrossDel(vr, rsy.Cells[1, kk]);
          if km = 1 then
          begin
            DeleteARow(rsy, jj);
            dec(rsy_end);
            dec(kk);
          end
          else if km = 2 then
          begin
            DeleteARow(rsy, kk);
            dec(rsy_end);
            dec(kk);
          end;
          if kk >= rsy_end then
            break;
          inc(kk);
        end;
      end;
      if jj >= rsy_end then
        break;

    end;

    srr := 0;
    for kk := parent_start to parent_end do
    begin
      srr := srr + strtofloat(rsy.Cells[4, kk]) + 1;
    end;
    indr := 0;
    for kk := 0 to parent_start do
      if (rsy.Cells[3, kk] <> '') and (rsy.Cells[1, kk] = rsy.Cells[0, rsy_i])
      then
      begin
        indr := kk;
        break;
      end;

    kd := rsy_end - rsy_start + 1; // количество детей (1) (2)
    kr := parent_end - parent_start + 1; // количество братьев (2)

    ssk := 0;
    sk := 0;
    for jj := rsy_start to rsy_end do // Yi
    begin
      reb := rsy.Cells[1, jj];
      SL := TStringList.Create;
      SL.Text := StringReplace(reb, ' ', #13#10, [rfReplaceAll]);
      sks := 0;
      for kk := parent_start to parent_end do
      begin
        vsya := 0;
        sl1 := 0;
        SL2 := 0;
        sl3 := 0;
        if (AnsiPos(reb, rsy.Cells[1, kk]) > 0) or
          (AnsiPos(rsy.Cells[1, kk], reb) > 0) then
        begin
          vsya := vsya + 1;
        end;
        for ii := 0 to SL.Count - 1 do
        begin
          if (AnsiPos(SL[ii], rsy.Cells[1, kk]) > 0) then
          begin
            if ii = 0 then
              sl1 := sl1 + 1;
            if ii = 1 then
              SL2 := SL2 + 1;
            if ii = 3 then
              sl3 := sl3 + 1;
          end;
        end;
        sk0 := vsya * (SL.Count - 1) + (sl1 + SL2 + sl3 - vsya) /
          (SL.Count - 1);
        sks := sks + sk0;
        // ShowMessage(floattostr(sk0));
      end;
      { if rsy.Cells[4, rsy_i]='0' then
        sks := sks * 1 / (rsy_end-rsy_start+1)
        else
        sks := sks * (strtofloat(rsy.Cells[4, rsy_i])+1) / (rsy_end-rsy_start+1); }
      if sks > 1 then
        sk := sk + 1;
      sks := (sks + 1) / (kr + 1);
      // ShowMessage('Вес ребенка: '+floattostrF(sks, ffFixed, 6, 2));
      ssk := ssk + sks;
      rsy.Cells[4, jj] := floattostrF(sks, ffFixed, 6, 2);

      FreeAndNil(SL);
    end;
    // слово
    // ShowMessage('Вес детей: '+floattostrF(ssk, ffFixed, 6, 2));
    ssk := ssk / kd;
    // ShowMessage('Вес детей: '+floattostrF(ssk, ffFixed, 6, 2));
    d := sk / kd; // дети вообще норм?  (1)
    // ssk = масса детей по полю братьев (2)
    // sk = количество здоровых детей (1)
    // srr = масса братьев (2)
    sr := (strtofloat(rsy.Cells[4, rsy_i]) + 1) * kr / srr;
    // на сколько хорош среди братьев
    // dr := strtofloat(rsy.Cells[4, rsy_i]) / srr; //средняя масса братьев

    // dd := ssk / kd; //средняя масса детей
    kof1 := strtofloat(rsy.Cells[3, indr]);
    // kof1 := (dr * 2 + ssk)/2; //общая масса семьи
    kof2 := ssk * sr * d * kof1; // итого?
    // ShowMessage('Вес братьев: '+floattostr(sr));
    // ShowMessage('Итого: '+floattostr(kof2));
    p := strtoint(PrClearE.Text) / 100.00;
    { rsy.Cells[3, rsy_i] := floattostrF(sk / (rsy_end-rsy_start+1), ffFixed, 6, 2) + '  > ' + floattostrF(p, ffFixed, 6, 2) + ' ? '
      + floattostrF(ssk * sk / (rsy_end-rsy_start+1), ffFixed, 6, 2)+ ' > ' + floattostrF(sk*(1-p), ffFixed, 6, 2) + ' ? кол-во: ' + inttostr(rsy_end-rsy_start+1) + '! не ноль:' + inttostr(sk) + '! сумма:' + floattostrF(ssk, ffFixed, 6, 2); }
    { rsy.Cells[3, rsy_i] := floattostrF(d, ffFixed, 6, 2) + '  > ' + floattostrF(p, ffFixed, 6, 2) + ' ? '
      + floattostrF(kof1, ffFixed, 6, 2)+ ' * ' + floattostrF(sr, ffFixed, 6, 2) + ' = ' + floattostrF(kof2, ffFixed, 6, 2) + ' ? кол-во: ' + inttostr(kd) + '! не ноль:' + floattostrF(sk, ffFixed, 6, 2) + '! сумма:' + floattostrF(ssk, ffFixed, 6, 2) + '! коэф:' + floattostrF(sk*(1-p), ffFixed, 6, 2); }
    rsy.Cells[3, rsy_i] := floattostrF(kof2, ffFixed, 6, 2);
    // ShowMessage(rsy.Cells[3, rsy_i]);

    if (d > p) and (kof2 >= p) then
    // if 1 > 0 then
    begin
      b := true;
      while b do
      begin
        b := false;
        for ii := 0 to rsy.RowCount - 1 do
        begin
          if AnsiCompareStr(rsy.Cells[1, rsy_i], rsy.Cells[0, ii]) = 0 then
          begin
            b := true;
            break;
          end;
        end;
        inc(rsy_i);
      end;
      dec(rsy_i);
      stage := 21;
    end
    else
    begin
      while rsy_end >= rsy_start do
      begin
        DeleteARow(rsy, rsy_end);
        dec(rsy_end);
      end;
      Minuss.Lines.Add(rsy.Cells[1, rsy_i]);
      DeleteARow(rsy, rsy_i);
      stage := 21;
    end;

    Application.ProcessMessages;
    ParserRSY.Enabled := true;
  end
  else
  begin
    ParserRSY.Enabled := false;
    for jj := rsy_start to rsy_end do
    begin

      vr := rsy.Cells[1, jj];
      SL := TStringList.Create;
      SL.Text := StringReplace(vr, ' ', #13#10, [rfReplaceAll]);
      rsy.Cells[4, jj] := '0,5';
      for ii := 0 to SL.Count - 1 do
      begin
        if AnsiPos(SL[ii], rsy.Cells[1, rsy_np]) > 0 then
        begin
          rsy.Cells[4, jj] := '1';
          break;
        end;
      end;

      if (Slov(vr) > 3) or (Slov(vr) < 2) then
      begin
        DeleteARow(rsy, jj);
        dec(rsy_end);
      end
      else

      begin
        kk := jj + 1;
        while kk <= rsy_end do
        begin

          km := KrossDel(vr, rsy.Cells[1, kk]);
          if km = 1 then
          begin
            DeleteARow(rsy, jj);
            dec(rsy_end);
            dec(kk);
          end
          else if km = 2 then
          begin
            DeleteARow(rsy, kk);
            dec(rsy_end);
            dec(kk);
          end;
          if kk >= rsy_end then
            break;
          inc(kk);
        end;
      end;

      if rsy.Cells[1, jj] = '' then
        rsy.Cells[1, jj] := '0,5';

      if jj >= rsy_end then
        break;
    end;
    stage := 21;
    rsy_np := 0;
    ParserRSY.Enabled := true;
  end;
end;

procedure TForm1.ParserTimer(Sender: TObject);
begin
  if (stage = 0) then // ttt
  begin
    pasteWord;
  end
  else if (stage = 1) then
  begin
    Parser.Interval := 3000 + random(2000);
    clickFind;
  end
  else if (stage = 2) then
  begin
    Parser.Interval := 300;
    colWords;
  end
  else if (stage = 3) then
  begin
    Parse;
  end
  else if (stage = 4) then
  begin
    checkClass;
  end
  else if (stage = 6) then
  begin
    nextWord;
  end
  else if (stage = 7) then
  begin
    Parser.Interval := 3000 + random(2000);
    checkWord;
  end
  else if (stage = 5) then
  begin
    nextPage;
  end;
end;

procedure TForm1.PassEKeyPress(Sender: TObject; var Key: Char);
begin
  if (LoginE.Text <> '') and (PassE.Text <> '') and (loaded) then
    LoginI.Visible := true;
  if (Key = #13) and (LoginE.Text <> '') and (loaded) then
    HideInjection2.Click;
end;

procedure TForm1.PassEMouseEnter(Sender: TObject);
begin
  LoadPNGfromRes(Kbrd1PNG, 'q2_PNG');
  LoadPNGfromRes(Kbrd2PNG, 'w2_PNG');
  LoadPNGfromRes(Kbrd3PNG, 'e2_PNG');
end;

procedure TForm1.PassEMouseLeave(Sender: TObject);
begin
  LoadPNGfromRes(Kbrd1PNG, 'q_PNG');
  LoadPNGfromRes(Kbrd2PNG, 'w_PNG');
  LoadPNGfromRes(Kbrd3PNG, 'e_PNG');
end;

procedure TForm1.HideMinusRMouseLeave(Sender: TObject);
begin
  PreKeyHelpP.Visible := false;
end;

procedure TForm1.DeleteARow(Grid: TStringGrid; ARow: integer);
begin
  TMyGrid(Grid).DeleteRow(ARow);
end;

procedure TForm1.DeleteZTZClick(Sender: TObject);
begin
  if rpls_row <> -1 then
    DelCell(OldZTZ.Caption, poisk, rpls_col, false, rpls_row)
  else
    DelCell(OldZTZ.Caption, poisk, rpls_col, true, 0);
  TakeList(AdsRightZags, poisk, 7);
  TakeList(AdsRightZags2, poisk, 8);
  TakeList(AdsRight, poisk, 9);
  if rpls_col = 7 then
  begin
    // DelStr(OldZTZ.Caption, AdsRightZags, true, 0);
    AdsZag.Caption := '';
  end;
  if rpls_col = 8 then
  begin
    // DelStr(OldZTZ.Caption, AdsRightZags2, true, 0);
    AdsZag2.Caption := '';
  end;
  if rpls_col = 9 then
  begin
    // DelStr(OldZTZ.Caption, AdsRight, true, 0);
    AdsText.Caption := '';
  end;

  ReplacerZTZP.Visible := false;
end;

procedure TForm1.DlSovEChange(Sender: TObject);
begin
  if DlSovE.Text <> '' then
    DlSovT.Position := strtoint(DlSovE.Text)
  else
  begin
    DlSovT.Position := 1;
    DlSovE.SelStart := length(DlSovE.Text);
    DlSovE.SelLength := 0;
  end;
end;

procedure TForm1.DlSovEKeyPress(Sender: TObject; var Key: Char);
begin
  case Key of
    #8, '0' .. '9':
    else
      Key := Chr(0);
  end;
end;

procedure TForm1.DlSovTChange(Sender: TObject);
begin
  DlSovE.Text := inttostr(DlSovT.Position);
end;

function Kachestvo(Grid: TStringGrid; rod: string; reb: string): string;
begin

  Kachestvo := floattostrF(0.545212, ffFixed, 6, 2);
end;

procedure TForm1.HandClearClick(Sender: TObject);
var
  s: string;
begin
  s := '';
  if CheckBox1.Checked then
  begin
    s := CheckBox1.Caption;
    Form1.PreMinuss.Lines.Add(CheckBox1.Caption);
  end;
  if CheckBox2.Checked then
  begin
    if s <> '' then
      s := s + ' ' + CheckBox2.Caption
    else
      s := s + CheckBox2.Caption;
    Form1.PreMinuss.Lines.Add(CheckBox2.Caption);
  end;
  if CheckBox3.Checked then
  begin
    if s <> '' then
      s := s + ' ' + CheckBox3.Caption
    else
      s := s + CheckBox3.Caption;
    Form1.PreMinuss.Lines.Add(CheckBox3.Caption);
  end;
  if CheckBox4.Checked then
  begin
    if s <> '' then
      s := s + ' ' + CheckBox4.Caption
    else
      s := s + CheckBox4.Caption;
    Form1.PreMinuss.Lines.Add(CheckBox4.Caption);
  end;
  if CheckBox5.Checked then
  begin
    if s <> '' then
      s := s + ' ' + CheckBox5.Caption
    else
      s := s + CheckBox5.Caption;
    Form1.PreMinuss.Lines.Add(CheckBox5.Caption);
  end;
  if CheckBox6.Checked then
  begin
    if s <> '' then
      s := s + ' ' + CheckBox6.Caption
    else
      s := s + CheckBox6.Caption;
    Form1.PreMinuss.Lines.Add(CheckBox6.Caption);
  end;
  if CheckBox7.Checked then
  begin
    if s <> '' then
      s := s + ' ' + CheckBox7.Caption
    else
      s := s + CheckBox7.Caption;
    HandClear.Font.Color := clRed;
    Form1.PreMinuss.Lines.Add(CheckBox7.Caption);
  end;
end;

procedure TForm1.HeatPNGClick(Sender: TObject);
var
  stri, stri2, stri3, idkey: string;
  i: integer;
begin
  ZConnection1.Connected := false;
  ZConnection1.Connected := true;
  teplota.Lines.Strings[adsright_i] := '2';
  stri := '';
  stri2 := '';
  for i := 0 to KeyPhraze.Lines.Count - 1 do
    if AnsiCompareStr(KeyCollector.Lines.Strings[adsright_i],
      Copy(KeyPhraze.Lines.Strings[i], AnsiPos('|*|', KeyPhraze.Lines.Strings[i]
      ) + 3, KeyPhraze.Lines.Strings[i].length - 1)) = 0 then
    begin
      stri := Copy(KeyPhraze.Lines.Strings[i], 0,
        AnsiPos('|*|', KeyPhraze.Lines.Strings[i]) - 1);
      stri2 := Copy(KeyPhraze.Lines.Strings[i],
        AnsiPos('|*|', KeyPhraze.Lines.Strings[i]) + 3,
        KeyPhraze.Lines.Strings[i].length - 1);
    end;
  TeplotaShape.Visible := true;;
  TeplotaShape.Left := HeatPNG.Left;

  stri3 := 'SELECT `id` FROM `keys` WHERE `key`=''' + stri + ''' AND `fraza`='''
    + stri2 + '''';
  ZQuery1.SQL.Text := stri3;
  ZQuery1.Active := true;
  idkey := inttostr(ZQuery1.FieldByName('id').AsInteger);

  stri3 := 'SELECT `id` FROM `keywords` WHERE `idprod`=''' + id_prod +
    ''' AND `idkey`=''' + idkey + '''';
  if ZQuery1.FieldByName('id').AsInteger <> 0 then
    ZQuery1.SQL.Text := 'UPDATE `keywords` SET `termal`=''' +
      teplota.Lines.Strings[adsright_i] +
      ''', `lastupdate`=NOW() WHERE `idprod`=''' + id_prod + ''' AND `idkey`='''
      + idkey + ''''
  else
    ZQuery1.SQL.Text :=
      'INSERT INTO `keywords`(`idprod`,`idkey`,`termal`, `lastupdate`) VALUES ('''
      + id_prod + ''', ''' + idkey + ''', ''' + teplota.Lines.Strings
      [adsright_i] + ''', NOW())';
  ZQuery1.ExecSQL; { }
  AdsRightB.Caption := 'Человекопонятные фразы ' + inttostr(adsright_i) + ' / '
    + inttostr(KeyCollector.Lines.Count - 1);
end;

procedure TForm1.HelpBClick(Sender: TObject);
begin
  BRReg.Visible := true;
  if BrowserP.Visible then
    BrowserP.Visible := false
  else
  begin
    ObjShow(BrowserP);
  end;
end;

procedure TForm1.HelpBMouseEnter(Sender: TObject);
begin
  HelpB.Color := $00E1E1E1;
  ObjShow(PreKeyHelpP);
  PreKeyHelpP.Left := Screen.Width - PreKeyHelpP.Width - 10;
  PreKeyHelpP.Top := MinimizeB.Top + MinimizeB.Height + 10;
  PreKeyHelp.Text := 'Показывает актуальную подсказку на данный момент';
end;

procedure TForm1.HelpBMouseLeave(Sender: TObject);
begin
  HelpB.Color := clWhite;
  PreKeyHelpP.Visible := false;
end;

procedure TForm1.HelpInputClick(Sender: TObject);
begin
  auto := true;
  Edit.SetFocus;
  Edit.SelLength := 0;
  keybd_event(Ord(#13), 0, 0, 0);
end;

procedure TForm1.SheetHide;
begin
  SheetDo.Visible := false;
  PreKeySheet.Visible := false;
  DokeySheet.Visible := false;
  AdsSheet.Visible := false;
  InfoSheet.Visible := false;
  ThreeSheet.Visible := false;
  FinishSheet.Visible := false;
end;

procedure TForm1.KeysBClick(Sender: TObject);
begin
  if KeyParse.Caption = 'Собрать ключи' then
  begin
    KeyParseClick(KeyParse);
  end;
end;

procedure TForm1.KeysHelpMouseEnter(Sender: TObject);
begin
  PreKeyHelp.Clear;
  PreKeyHelp.Lines.Strings[0] :=
    'Введите свой логин почтового ящика в яндекс и пароль.' +
    'Нажмите кнопку "ОК" и дождитесь появления надписи "Собрать ключи" или "Ключи" слева. Дождитесь'
    + ' сообщения "Собрано".' + #13#10 +
    '*В целях безопасности данные ни как не сохраняются!';
  ObjShow(PreKeyHelpP);
end;

procedure TForm1.KeysHelpMouseLeave(Sender: TObject);
begin
  PreKeyHelpP.Visible := false;
end;

procedure TForm1.keysPNGClick(Sender: TObject);
begin
  if KeyParse.Caption = 'Собрать ключи' then
  begin
    KeyParseClick(KeyParse);
  end;
end;

procedure TForm1.KompaniyaChange(Sender: TObject);
begin
  if next_i = 15 then
    changebool := true;
end;

procedure TForm1.KonkurentHelpClick(Sender: TObject);
begin
  if playbool then
  begin
    playbool := false;
    MediaPlayer1.Stop;
  end
  else
  begin
    playbool := true;
    MediaPlayer1.Open;
    MediaPlayer1.Play;
  end;
end;

procedure TForm1.KonkurentHelpMouseEnter(Sender: TObject);
var
  stri: string;
begin
  KonkurentHelp.Color := clGradientInactiveCaption;
  Application.ProcessMessages;
  HelpZoneP.Visible := true;
  HelpZone.Clear;
  stri := 'Список конкурентов для конкурентной разведки.' + #13#10 +
    ' Клик - Посмотреть объявление, скопировать название сайта.' + #13#10 +
    'Двойной Клик - Посетить сайт.' + #13#10 +
    'Клик по вопросу - аудио помощь. Повторный клик - остановить аудио помощь.'
    + #13#10 + 'Вы можете добавляться и удалять сайты конкурентов. ' +
    'Для удаления на строке конкурента нажмите клавишу BACKSPACE (Клавиша удаления символа <- )'
    + #13#10 + 'Для добавления нажмите клавишу ENTER';
  HelpZone.Lines.Add(stri);
end;

procedure TForm1.KonkurentHelpMouseLeave(Sender: TObject);
begin
  HelpZoneP.Visible := false;
end;

procedure TForm1.KontEmailChange(Sender: TObject);
begin
  if next_i = 15 then
    changebool := true;
end;

procedure TForm1.korpusChange(Sender: TObject);
begin
  if next_i = 15 then
    changebool := true;
end;

procedure TForm1.HelpZoneMouseEnter(Sender: TObject);
begin
  HelpZoneP.Visible := true;
end;

procedure TForm1.HelpZoneMouseLeave(Sender: TObject);
begin
  HelpZoneP.Visible := false;
end;

procedure TForm1.HideAdsAddClick(Sender: TObject);
begin
  HideMemos;
  if not Finality.Enabled then
  begin
    TakeList(AdsRightZags, poisk, 7);
    TakeList(AdsRightZags2, poisk, 8);
    TakeList(AdsRight, poisk, 9);
    TakeList(IndexList, poisk, 0);
  end;
  AdsRightZags.Visible := true;
  AdsRight.Visible := true;
  AdsRightZags2.Visible := true;
  AdsRightZags.Width := Round(Screen.Width / 3);
  AdsRight.Width := Round(Screen.Width / 3);
end;

procedure TForm1.HideAdsIMouseEnter(Sender: TObject);
begin
  LoadPNGfromRes(HideAdsI, 'Ads2_PNG');
end;

procedure TForm1.HideAdsIMouseLeave(Sender: TObject);
begin
  LoadPNGfromRes(HideAdsI, 'Ads_PNG');
end;

procedure TForm1.HideInjection2Click(Sender: TObject);
var
  CodeStr: string;
begin
  if Assigned(BRReg.Browser) and Assigned(BRReg.Browser.Mainframe) then
  begin
    CodeStr :=
      '$("#cont").append(''<form method="post" class="hidden" style="display:none;">'
      + '<input name="lucky" type="hidden" onclick="return true;">' +
      '<input name="chel" type="hidden" onclick="return true;">' +
      '<input type="submit" id="Ebuton" name="Ebuton" value="Войти">' +
      '</form>'');';
    BRReg.Browser.Mainframe.ExecuteJavaScript(CodeStr, 'about:blank', 0);
  end;
  HideInjection.Click;
end;

procedure TForm1.HideInjectionClick(Sender: TObject);
var
  CodeStr: string;
begin
  login := LoginE.Text;
  password := PassE.Text;
  ErrorL.Visible := false;
  if Assigned(BRReg.Browser) and Assigned(BRReg.Browser.Mainframe) then
  begin
    CodeStr := '$("input[name=\"lucky\"]").val("' + login + '");';
    CodeStr := CodeStr + '$("input[name=\"chel\"]").val("' + password + '");';
    CodeStr := CodeStr + '$("#Ebuton").click();';
    BRReg.Browser.Mainframe.ExecuteJavaScript(CodeStr, 'about:blank', 0);
  end;
end;

procedure TForm1.HideKeyAddPClick(Sender: TObject);
begin
  HideMemos;
  if not Finality.Enabled then
  begin
    TakeList(KeyCollector, poisk, 4);
  end;
  KeyCollector.Visible := true;
end;

procedure TForm1.HideKeyIMouseEnter(Sender: TObject);
begin
  LoadPNGfromRes(HideKeyI, 'Key_PNG');
end;

procedure TForm1.HideKeyIMouseLeave(Sender: TObject);
begin
  LoadPNGfromRes(HideKeyI, 'Key2_PNG');
end;

procedure TForm1.HideKeyMyPClick(Sender: TObject);
begin
  HideMemos;
  MyKey.Visible := true;
end;

procedure TForm1.HideLOnOffClick(Sender: TObject);
begin
  if HideL.Align = alClient then
  begin
    HideL.Align := alLeft;
    HideL.Width := HideOnOff.Width;
    HideLOnOff.Align := alRight;
    HideLOnOff.Caption := '>';
    HideLOnOff.Color := clWindow;
  end
  else
  begin
    HideL.Align := alClient;
    HideLOnOff.Align := alLeft;
    HideLOnOff.Caption := '<';
    HideLOnOff.Color := clGradientInactiveCaption;
  end;
end;

procedure TForm1.HideLTopClick(Sender: TObject);
var
  jj: integer;
begin
  if not dobbool then
    with HideLCont do
    begin
      for jj := strk - 1 to ControlCount - 1 do
        if (Controls[jj] is TMemo) then
          if (AnsiPos('Memo', (Controls[jj] as TMemo).name) = 1) and
            (strtoint(Copy((Controls[jj] as TMemo).name, 5, 2)) > 9) then
            PreKey.Text := PreKey.Text + (Controls[jj] as TMemo).Text;
    end;
  dobbool := true;
end;

procedure TForm1.HideOnOffClick(Sender: TObject);
begin
  HideMemos;
  if HideP.Align = alClient then
  begin
    HideP.Align := alRight;
    HideP.Width := HideOnOff.Width;
    HideOnOff.Align := alLeft;
    HideOnOff.Caption := '<';
    HideOnOff.Color := clWindow;
  end
  else
  begin
    HideP.Align := alClient;
    HideOnOff.Align := alRight;
    HideOnOff.Caption := '>';
    HideOnOff.Color := clGradientInactiveCaption;
    HideControls.Left := Round((Screen.Width - HideControls.Width) / 2);
  end;
end;

procedure TForm1.HintPMouseEnter(Sender: TObject);
begin
  HintAim.Font.Color := clBlack;
  HintClick.Font.Color := clBlack;
  HintDblClick.Font.Color := clBlack;
  HintL.Font.Color := clBlack;
  LoadPNGfromRes(AimPNG, 'Aim2_PNG');
  LoadPNGfromRes(ClickPNG, 'Click2_PNG');
  LoadPNGfromRes(DblClickPNG, 'dblclick2_PNG');
  LoadPNGfromRes(Kbrd1PNG, 'q2_PNG');
  LoadPNGfromRes(Kbrd2PNG, 'w2_PNG');
  LoadPNGfromRes(Kbrd3PNG, 'e2_PNG');
end;

procedure TForm1.HintPMouseLeave(Sender: TObject);
begin
  HintAim.Font.Color := clSilver;
  HintClick.Font.Color := clSilver;
  HintDblClick.Font.Color := clSilver;
  HintL.Font.Color := clSilver;
  LoadPNGfromRes(AimPNG, 'Aim_PNG');
  LoadPNGfromRes(ClickPNG, 'Click_PNG');
  LoadPNGfromRes(DblClickPNG, 'dblclick_PNG');
  LoadPNGfromRes(Kbrd1PNG, 'q_PNG');
  LoadPNGfromRes(Kbrd2PNG, 'w_PNG');
  LoadPNGfromRes(Kbrd3PNG, 'e_PNG');
end;

procedure TForm1.HotPNGClick(Sender: TObject);
var
  stri, stri2, stri3, idkey: string;
  i: integer;
begin
  ZConnection1.Connected := false;
  ZConnection1.Connected := true;
  stri := '';
  stri2 := '';
  teplota.Lines.Strings[adsright_i] := '3';
  for i := 0 to KeyPhraze.Lines.Count - 1 do
    if AnsiCompareStr(KeyCollector.Lines.Strings[adsright_i],
      Copy(KeyPhraze.Lines.Strings[i], AnsiPos('|*|', KeyPhraze.Lines.Strings[i]
      ) + 3, KeyPhraze.Lines.Strings[i].length - 1)) = 0 then
    begin
      stri := Copy(KeyPhraze.Lines.Strings[i], 0,
        AnsiPos('|*|', KeyPhraze.Lines.Strings[i]) - 1);
      stri2 := Copy(KeyPhraze.Lines.Strings[i],
        AnsiPos('|*|', KeyPhraze.Lines.Strings[i]) + 3,
        KeyPhraze.Lines.Strings[i].length - 1);
    end;
  TeplotaShape.Visible := true;;
  TeplotaShape.Left := HotPNG.Left;
  stri3 := 'SELECT `id` FROM `keys` WHERE `key`=''' + stri + ''' AND `fraza`='''
    + stri2 + '''';
  ZQuery1.SQL.Text := stri3;
  ZQuery1.Active := true;
  idkey := inttostr(ZQuery1.FieldByName('id').AsInteger);

  stri3 := 'SELECT `id` FROM `keywords` WHERE `idprod`=''' + id_prod +
    ''' AND `idkey`=''' + idkey + '''';
  if ZQuery1.FieldByName('id').AsInteger <> 0 then
    ZQuery1.SQL.Text := 'UPDATE `keywords` SET `termal`=''' +
      teplota.Lines.Strings[adsright_i] +
      ''', `lastupdate`=NOW() WHERE `idprod`=''' + id_prod + ''' AND `idkey`='''
      + idkey + ''''
  else
    ZQuery1.SQL.Text :=
      'INSERT INTO `keywords`(`idprod`,`idkey`,`termal`, `lastupdate`) VALUES ('''
      + id_prod + ''', ''' + idkey + ''', ''' + teplota.Lines.Strings
      [adsright_i] + ''', NOW())';
  ZQuery1.ExecSQL; { }
  AdsRightB.Caption := 'Человекопонятные фразы ' + inttostr(adsright_i) + ' / '
    + inttostr(KeyCollector.Lines.Count - 1);
end;

procedure TForm1.hrefdescChange(Sender: TObject);
begin
  if hrefdesc.Text <> '' then
  begin
    AdsUrlDesc.Caption := hrefdesc.Text;
    AdsHrefDescShape.Width := hrefdesc.Width + 2;
    AdsHrefDescShape.Left := AdsUrlDesc.Left;
  end
  else
  begin
    AdsHrefDescShape.Width := 70;
    AdsHrefDescShape.Left := AdsUrlDesc.Left;
  end;
  AdsHrefDescCounter.Caption := inttostr(20 - length(hrefdesc.Text));
end;

procedure TForm1.hrefdescEnter(Sender: TObject);
begin
  AdsHrefDescCounter.Visible := true;
  ObjShow(AdsPreview);
  AdsHrefDescShape.Visible := true;
  if hrefdesc.Text <> '' then
  begin
    AdsUrlDesc.Caption := hrefdesc.Text;
    AdsHrefDescShape.Width := hrefdesc.Width + 2;
    AdsHrefDescShape.Left := AdsUrlDesc.Left;
  end
  else
  begin
    AdsHrefDescShape.Width := 70;
    AdsHrefDescShape.Left := AdsUrlDesc.Left;
  end;
end;

procedure TForm1.hrefdescExit(Sender: TObject);
begin
  AdsHrefDescCounter.Visible := false;
  AdsPreview.Visible := false;
  AdsHrefDescShape.Visible := false;
  if hrefdesc.Text <> '' then
  begin
    AdsUrlDesc.Caption := hrefdesc.Text;
    AdsHrefDescShape.Width := hrefdesc.Width + 2;
    AdsHrefDescShape.Left := AdsUrlDesc.Left;
  end
  else
  begin
    AdsHrefDescShape.Width := 70;
    AdsHrefDescShape.Left := AdsUrlDesc.Left;
  end;
end;

procedure TForm1.hrefdescKeyPress(Sender: TObject; var Key: Char);
begin
  if (length(hrefdesc.Text) > 19) then
  begin
    AdsErr.Caption := 'Превышена максимальная длина описания ссылки!';
    if (Key <> #8) then
      Key := #0;
  end
  else
    AdsErr.Caption := '';
end;

procedure TForm1.Image1Click(Sender: TObject);
var
  jpg: TJPEGImage;
begin
  if ext <> '' then
  begin
    jpg := TJPEGImage.Create;
    jpg.Assign(Image1.Picture.graphic);
    jpg.Compress;
    base64str := 'data:image/' + AnsiString(Copy(ext, 2, ext.length - 1)) +
      ';base64,' + JPEGtoB64B(jpg);
    HideMemo.Text := String(base64str);
    HideMemo.Lines.SaveToFile('asd.txt');
    jpg.Free;
  end
  else
    ShowMessage('Выберите изображение');
end;

procedure TForm1.TimeSlicePNGClick(Sender: TObject);
begin
  ObjShow(TimeSetP);
  TimeSliceRezult.Caption := Predpiska.Text + Times.Lines.Strings[0] +
    Dopiska.Text;
end;

procedure TForm1.TimeSlicePNGMouseEnter(Sender: TObject);
begin
  LoadPNGfromRes(TimeSlicePNG, 'timeslice2_PNG');
end;

procedure TForm1.TimeSlicePNGMouseLeave(Sender: TObject);
begin
  LoadPNGfromRes(TimeSlicePNG, 'timeslice_PNG');
end;

procedure TForm1.imyaChange(Sender: TObject);
begin
  if next_i = 15 then
    changebool := true;
end;

procedure TForm1.InCitiesClick(Sender: TObject);
begin
  // ShemeAds.Lines.Strings[0]:=ShemeAds.Lines.Strings[0]+'{В ГОРОДЕ}';
  incity_i := InCities.CaretPos.Y;
  SelLine(InCities, InCities.CaretPos.Y);
end;

procedure TForm1.InfoIClick(Sender: TObject);
begin
  { Edit.SetFocus;
    Edit.SelLength := 0;
    keybd_event(Ord(#13), 0, 0, 0); }
  auto := true;
  Edit.SetFocus;
  Edit.SelLength := 0;
  keybd_event(Ord(#13), 0, 0, 0);
end;

procedure TForm1.InfoIMouseEnter(Sender: TObject);
begin
  HintClick.Font.Color := clBlack;
  LoadPNGfromRes(ClickPNG, 'Click2_PNG');
  if changebool then
  begin
    SaveChanges.Caption := 'Сохраните изменения';
  end;
end;

procedure TForm1.InfoIMouseLeave(Sender: TObject);
begin
  HintClick.Font.Color := clSilver;
  LoadPNGfromRes(ClickPNG, 'Click_PNG');
end;

procedure TForm1.k1Change(Sender: TObject);
begin
  if (SrChek.Text <> '') and (marzha.Text <> '') and (prmarzhi.Text <> '') and
    (k1.Text <> '') and (k2.Text <> '') and (strtofloat(k1.Text) > 0) and
    (strtofloat(k2.Text) > 0) and (Lids.Text <> '') then
  begin
    SrCheckF := strtofloat(SrChek.Text);
    MarzhaF := strtofloat(marzha.Text);
    K3F := strtofloat(prmarzhi.Text);
    K1F := RoundTo(strtofloat(k1.Text), -2);
    K2F := RoundTo(strtofloat(k2.Text), -2);
    StavkaF := RoundTo(SrCheckF * MarzhaF * K3F * K1F * K2F * koefrazb, -2);
    Stavka.Caption := floattostr(StavkaF);

    LidsF := strtofloat(Lids.Text);
    ClicksF := RoundTo(LidsF / K1F / K2F, -2);
    clicks.Caption := floattostr(ClicksF);
    clicksperdayF := Ceil(ClicksF / 30);
    clicksperday.Caption := floattostr(clicksperdayF);
    BudgetF := RoundTo(StavkaF * ClicksF, -2);
    BudgetperdayF := RoundTo(StavkaF * clicksperdayF, -2);
    BudgetPerDay.Caption := floattostr(BudgetperdayF);
    Budget.Caption := floattostr(BudgetF);
    ProgDohodF := RoundTo(SrCheckF * LidsF * MarzhaF - BudgetF, -2);
    ProgDohod.Caption := floattostr(ProgDohodF);
  end;
end;

procedure TForm1.k1Enter(Sender: TObject);
begin
  DecimalSeparator := ',';
end;

procedure TForm1.k1KeyPress(Sender: TObject; var Key: Char);
begin
  case Key of
    #8, '0' .. '9':
      ;

    '.', ',':
      begin
        if Key <> DecimalSeparator then
          Key := DecimalSeparator;
        if AnsiPos(DecimalSeparator, k1.Text) <> 0 then
          Key := Chr(0);
      end;
    '-':
      if length(k1.Text) <> 0 then
        Key := Chr(0);
    #13:
      k2.SetFocus;
  else
    Key := Chr(0);
  end;
end;

procedure TForm1.k2Change(Sender: TObject);
begin
  if (SrChek.Text <> '') and (marzha.Text <> '') and (prmarzhi.Text <> '') and
    (k1.Text <> '') and (k2.Text <> '') and (Lids.Text <> '') then
  begin
    SrCheckF := strtofloat(SrChek.Text);
    MarzhaF := strtofloat(marzha.Text);
    K3F := strtofloat(prmarzhi.Text);
    K1F := strtofloat(k1.Text);
    K2F := strtofloat(k2.Text);
    StavkaF := SrCheckF * MarzhaF * K3F * K1F * K2F * koefrazb;
    Stavka.Caption := floattostr(StavkaF);

    LidsF := strtofloat(Lids.Text);
    ClicksF := LidsF / K1F / K2F;
    clicks.Caption := floattostr(ClicksF);
    clicksperdayF := Ceil(ClicksF / 30);
    clicksperday.Caption := floattostr(clicksperdayF);
    BudgetF := StavkaF * ClicksF;
    BudgetperdayF := StavkaF * clicksperdayF;
    BudgetPerDay.Caption := floattostr(BudgetperdayF);
    Budget.Caption := floattostr(BudgetF);
    ProgDohodF := SrCheckF * LidsF * MarzhaF - BudgetF;
    ProgDohod.Caption := floattostr(ProgDohodF);
  end;
end;

procedure TForm1.k2Enter(Sender: TObject);
begin
  DecimalSeparator := ',';
end;

procedure TForm1.k2KeyPress(Sender: TObject; var Key: Char);
begin
  case Key of
    #8, '0' .. '9':
      ;

    '.', ',':
      begin
        if Key <> DecimalSeparator then
          Key := DecimalSeparator;
        if AnsiPos(DecimalSeparator, k2.Text) <> 0 then
          Key := Chr(0);
      end;
    '-':
      if length(k2.Text) <> 0 then
        Key := Chr(0);
    #13:
      prmarzhi.SetFocus;
  else
    Key := Chr(0);
  end;
end;

procedure TForm1.KeyCollectorClick(Sender: TObject);
begin
  { if ClearinP.Visible then
    begin
    prekey_i := KeyCollector.CaretPos.Y;
    ClearingWord.Caption := KeyCollector.Lines.Strings[KeyCollector.CaretPos.Y];
    end; }
  word_ii := KeyCollector.CaretPos.Y;
  PoiskWord.Caption := KeyCollector.Lines.Strings[word_ii];
  ObjShow(AdsPreview);
end;

procedure TForm1.KeyCollectorDblClick(Sender: TObject);
var
  SL: TStringList;
  stri: string;
begin
  if GroupSelectorP.Visible then
  begin
    AdsPreview.Visible := false;
    stri := GroupSelectorM.Lines.Strings[GroupSelectorM.CaretPos.Y];
    SL := TStringList.Create;
    SL.Text := StringReplace(stri, ' ', #13#10, [rfReplaceAll]);
    CheckBox1.Caption := '';
    CheckBox2.Caption := '';
    CheckBox3.Caption := '';
    CheckBox4.Caption := '';
    CheckBox5.Caption := '';
    CheckBox6.Caption := '';
    CheckBox7.Caption := '';
    CheckBox1.Checked := false;
    CheckBox2.Checked := false;
    CheckBox3.Checked := false;
    CheckBox4.Checked := false;
    CheckBox5.Checked := false;
    CheckBox6.Checked := false;
    CheckBox7.Checked := false;
    CheckBox1.Enabled := false;
    CheckBox2.Enabled := false;
    CheckBox3.Enabled := false;
    CheckBox4.Enabled := false;
    CheckBox5.Enabled := false;
    CheckBox6.Enabled := false;
    CheckBox7.Enabled := false;
    if (SL.Count >= 1) then
    begin
      CheckBox1.Enabled := true;
      if (length(SL[0]) > 0) then
        CheckBox1.Caption := SL[0];
    end
    else
      CheckBox1.Checked := false;
    if (SL.Count >= 2) then
    begin
      CheckBox2.Enabled := true;
      if (length(SL[1]) > 0) then
        CheckBox2.Caption := SL[1];
    end
    else
      CheckBox2.Checked := false;
    if (SL.Count >= 3) then
    begin
      CheckBox3.Enabled := true;
      if (length(SL[2]) > 0) then
        CheckBox3.Caption := SL[2];
    end
    else
      CheckBox3.Checked := false;
    if (SL.Count >= 4) then
    begin
      CheckBox4.Enabled := true;
      if (length(SL[3]) > 0) then
        CheckBox4.Caption := SL[3];
    end
    else
      CheckBox4.Checked := false;
    if (SL.Count >= 5) then
    begin
      CheckBox5.Enabled := true;
      if (length(SL[4]) > 0) then
        CheckBox5.Caption := SL[4]
    end
    else
      CheckBox5.Checked := false;
    if (SL.Count >= 6) then
    begin
      CheckBox6.Enabled := true;
      if (length(SL[5]) > 0) then
        CheckBox6.Caption := SL[5]
    end
    else
      CheckBox6.Checked := false;
    if (SL.Count >= 7) then
    begin
      CheckBox7.Enabled := true;
      if (length(SL[6]) > 0) then
        CheckBox7.Caption := SL[6]
    end
    else
      CheckBox7.Checked := false;
    FreeAndNil(SL);
    ObjShow(HandClearP);
  end;
  if HandClearP.Visible = false then
  begin
    AdsPreview.Visible := false;
    stri := KeyCollector.Lines.Strings[KeyCollector.CaretPos.Y];
    SL := TStringList.Create;
    SL.Text := StringReplace(stri, ' ', #13#10, [rfReplaceAll]);
    CheckBox1.Caption := '';
    CheckBox2.Caption := '';
    CheckBox3.Caption := '';
    CheckBox4.Caption := '';
    CheckBox5.Caption := '';
    CheckBox6.Caption := '';
    CheckBox7.Caption := '';
    CheckBox1.Checked := false;
    CheckBox2.Checked := false;
    CheckBox3.Checked := false;
    CheckBox4.Checked := false;
    CheckBox5.Checked := false;
    CheckBox6.Checked := false;
    CheckBox7.Checked := false;
    CheckBox1.Enabled := false;
    CheckBox2.Enabled := false;
    CheckBox3.Enabled := false;
    CheckBox4.Enabled := false;
    CheckBox5.Enabled := false;
    CheckBox6.Enabled := false;
    CheckBox7.Enabled := false;
    if (SL.Count >= 1) then
    begin
      CheckBox1.Enabled := true;
      if (length(SL[0]) > 0) then
        CheckBox1.Caption := SL[0];
    end
    else
      CheckBox1.Checked := false;
    if (SL.Count >= 2) then
    begin
      CheckBox2.Enabled := true;
      if (length(SL[1]) > 0) then
        CheckBox2.Caption := SL[1];
    end
    else
      CheckBox2.Checked := false;
    if (SL.Count >= 3) then
    begin
      CheckBox3.Enabled := true;
      if (length(SL[2]) > 0) then
        CheckBox3.Caption := SL[2];
    end
    else
      CheckBox3.Checked := false;
    if (SL.Count >= 4) then
    begin
      CheckBox4.Enabled := true;
      if (length(SL[3]) > 0) then
        CheckBox4.Caption := SL[3];
    end
    else
      CheckBox4.Checked := false;
    if (SL.Count >= 5) then
    begin
      CheckBox5.Enabled := true;
      if (length(SL[4]) > 0) then
        CheckBox5.Caption := SL[4]
    end
    else
      CheckBox5.Checked := false;
    if (SL.Count >= 6) then
    begin
      CheckBox6.Enabled := true;
      if (length(SL[5]) > 0) then
        CheckBox6.Caption := SL[5]
    end
    else
      CheckBox6.Checked := false;
    if (SL.Count >= 7) then
    begin
      CheckBox7.Enabled := true;
      if (length(SL[6]) > 0) then
        CheckBox7.Caption := SL[6]
    end
    else
      CheckBox7.Checked := false;
    FreeAndNil(SL);
    ObjShow(HandClearP);
  end;
end;

procedure TForm1.KeyCollectorKeyDown(Sender: TObject; var Key: Word;
  Shift: TShiftState);
begin
  if ssShift in Shift then
    KeyCollector.SelLength := 0;
end;

procedure TForm1.KeyCollectorKeyUp(Sender: TObject; var Key: Word;
  Shift: TShiftState);
begin
  KeyCollector.SelLength := 0;
end;

procedure TForm1.KeyCollectorMouseUp(Sender: TObject; Button: TMouseButton;
  Shift: TShiftState; X, Y: integer);
begin
  KeyCollector.SelLength := 0;
end;

procedure TForm1.KeyParseClick(Sender: TObject);
begin
  ShowMessage('Это займет какое-то время.' + #13#10 +
    ' После прохода каждого ключа, собранные ключи будут появляться слева.' +
    #13#10 + ' Всегда можно "подсмотреть" ;)');
  stage := 0;
  word_i := 0;
  KeysP.Visible := true;
  NextWordB.Visible := true;
  Parser.Enabled := true;
end;

procedure TForm1.KeyParseDblClick(Sender: TObject);
begin
  Parser.Enabled := false;
  Application.ProcessMessages;
  stage := 0;
  word_i := word_i + 1;
  Parser.Enabled := true;
end;

procedure TForm1.keyplannerClick(Sender: TObject);
var
  stri: string;
begin
  if wordstat.Caption = 'Я' then
  begin
    wordstat.Caption := 'G';
    keyplanner.Caption := 'Я';
    FindSites.Caption := 'Настало время поработать в Google';
    SellPhraseMemo.Visible := false;
    radarPNG.Cursor := crDefault;
    FindSites.Cursor := crDefault;
    FindSites.Hint := '';
    radarPNG.Hint := '';
    ObjShow(GoogleHelp);
    ThreeHelpInfo.Caption := 'Всё займёт меньше 15 минут!';
    HelpZone.Clear;
    stri := 'Читайте и кликайте дважды поочерендно каждую строку в списке ниже.'
      + 'Первая строка переведет вас на сайт keyword planner, где вы соберете около 10000 ключевых слов. Для того чтобы понять как это сделать за 15 шагов дважды кликните на вторую строку.'
      + 'Кликнув на 5 строку вы откроете папку в которую во время выполнения 15 шагов вы скопируете файлы с предварительными ключевыми фразами'
      + 'После этого кликните на последнюю строку и вы перейдете на следующий шаг.';
    HelpZone.Lines.Add(stri);
  end
  else
  begin
    wordstat.Caption := 'Я';
    keyplanner.Caption := 'G';
    FindSites.Caption := 'Введите три популярных запроса в Вашей тематике';
    GoogleHelp.Visible := false;
    ObjShow(SellPhraseMemo);
    radarPNG.Cursor := crHandPoint;
    FindSites.Cursor := crHandPoint;
    FindSites.Hint := 'Жми если ввёл три популярных запроса!';
    radarPNG.Hint := 'Жми если ввёл три популярных запроса!';
    HelpZone.Clear;
    stri := 'В первую очередь, мы должны выбрать такие запросы, которые отображают, что клиент собирается купить этот '
      + 'товар или услугу, а не просто интересуется ими. Так мы сразу будем работать с запросами, которые приносят наибольшую '
      + 'прибыль. Например, «Где можно купить наушники в Мытищах?» — сразу видим, что у клиента есть большая потребность в покупке наушников, а не просто интерес.';
    HelpZone.Lines.Add(stri);
    ThreeHelpInfo.Caption := 'Один запрос на каждой строке';
  end
end;

procedure TForm1.keyplannerMouseEnter(Sender: TObject);
begin
  keyplanner.Color := clGradientInactiveCaption;
  keyplanner.Visible := true;
end;

procedure TForm1.keyplannerMouseLeave(Sender: TObject);
begin
  keyplanner.Color := clWhite;
  Later.Enabled := true;
end;

procedure TForm1.UTPchDblClick(Sender: TObject);
begin
  UTPch.Lines.Delete(UTPch.CaretPos.Y);
end;

procedure TForm1.UTPsClick(Sender: TObject);
begin
  UTPs_i := UTPs.CaretPos.Y;
  // SelLine(CTAs, CTAs.CaretPos.Y);
  UTPch.Lines.Add(UTPs.Lines.Strings[UTPs_i]);
end;

procedure TForm1.AdsBRLoadEnd(Sender: TObject; const Browser: ICefBrowser;
  const frame: ICefFrame; httpStatusCode: integer);
var
  stri: string;
begin
  if AnsiPos('direct.yandex.ru', frame.url) > 0 then
  begin
    stri := 'https://direct.yandex.ru/search/?regions=' + regions + '&text=' +
      Keys.Lines[adsright_i];
    stri := StringReplace(stri, 'а', '%D0%B0', [rfReplaceAll]);
    stri := StringReplace(stri, 'б', '%D0%B1', [rfReplaceAll]);
    stri := StringReplace(stri, 'в', '%D0%B2', [rfReplaceAll]);
    stri := StringReplace(stri, 'г', '%D0%B3', [rfReplaceAll]);
    stri := StringReplace(stri, 'д', '%D0%B4', [rfReplaceAll]);
    stri := StringReplace(stri, 'е', '%D0%B5', [rfReplaceAll]);
    stri := StringReplace(stri, 'ё', '%D1%91', [rfReplaceAll]);
    stri := StringReplace(stri, 'ж', '%D0%B6', [rfReplaceAll]);
    stri := StringReplace(stri, 'з', '%D0%B7', [rfReplaceAll]);
    stri := StringReplace(stri, 'и', '%D0%B8', [rfReplaceAll]);
    stri := StringReplace(stri, 'й', '%D0%B9', [rfReplaceAll]);
    stri := StringReplace(stri, 'к', '%D0%BA', [rfReplaceAll]);
    stri := StringReplace(stri, 'л', '%D0%BB', [rfReplaceAll]);
    stri := StringReplace(stri, 'м', '%D0%BC', [rfReplaceAll]);
    stri := StringReplace(stri, 'н', '%D0%BD', [rfReplaceAll]);
    stri := StringReplace(stri, 'о', '%D0%BE', [rfReplaceAll]);
    stri := StringReplace(stri, 'п', '%D0%BF', [rfReplaceAll]);
    stri := StringReplace(stri, 'р', '%D1%80', [rfReplaceAll]);
    stri := StringReplace(stri, 'с', '%D1%81', [rfReplaceAll]);
    stri := StringReplace(stri, 'т', '%D1%82', [rfReplaceAll]);
    stri := StringReplace(stri, 'у', '%D1%83', [rfReplaceAll]);
    stri := StringReplace(stri, 'ф', '%D1%84', [rfReplaceAll]);
    stri := StringReplace(stri, 'х', '%D1%85', [rfReplaceAll]);
    stri := StringReplace(stri, 'ц', '%D1%86', [rfReplaceAll]);
    stri := StringReplace(stri, 'ч', '%D1%87', [rfReplaceAll]);
    stri := StringReplace(stri, 'ш', '%D1%88', [rfReplaceAll]);
    stri := StringReplace(stri, 'щ', '%D1%89', [rfReplaceAll]);
    stri := StringReplace(stri, 'ъ', '%D1%8A', [rfReplaceAll]);
    stri := StringReplace(stri, 'ы', '%D1%8B', [rfReplaceAll]);
    stri := StringReplace(stri, 'ь', '%D1%8C', [rfReplaceAll]);
    stri := StringReplace(stri, 'э', '%D1%8D', [rfReplaceAll]);
    stri := StringReplace(stri, 'ю', '%D1%8E', [rfReplaceAll]);
    stri := StringReplace(stri, 'я', '%D1%8F', [rfReplaceAll]);
    stri := StringReplace(stri, ' ', '%20', [rfReplaceAll]);
  end;
end;

procedure TForm1.AdsCloseClick(Sender: TObject);
var
  stri, stri2: string;
  i, dl: integer;
begin
  ZConnection1.Connected := false;
  ZConnection1.Connected := true;
  SheetList.Enabled := true;
  stri := '';
  stri2 := '';
  for i := 0 to AdsFasts.Lines.Count - 1 do
  begin
    if stri <> '' then
      stri := stri + '||' + AdsFasts.Lines.Strings[i]
    else
      stri := AdsFasts.Lines.Strings[i];
  end;
  for i := 0 to AdsDescs.Lines.Count - 1 do
  begin
    if stri2 <> '' then
      stri2 := stri2 + '||' + AdsDescs.Lines.Strings[i]
    else
      stri2 := AdsDescs.Lines.Strings[i];
  end;
  ZQuery1.SQL.Text := 'UPDATE `product` SET `url`=''' + AdsHref.Text +
    ''', `urldesc`=''' + hrefdesc.Text + ''', `fasts`=''' + stri +
    ''', `descs`=''' + stri2 + ''' WHERE `id`=''' + id_prod + '''';
  ZQuery1.ExecSQL; { }
  // ------------------------------------------------------------------------------
  if AnsiPos('http://', AdsHref.Text) > 0 then
  begin
    dl := pos('/', AdsHref.Text, 8);
    AdsUrl.Caption := Copy(AdsHref.Text, 8, dl - 7);
    adsurltext := AdsUrl.Caption;
    AdsHrefShape.Width := Round(Canvas.TextWidth(AdsUrl.Caption) * 1.27);
    AdsUrlDesc.Left := AdsHrefShape.Left + AdsHrefShape.Width + 2;
  end
  else if (AnsiPos('https://', AdsHref.Text) > 0) then
  begin
    dl := pos('/', AdsHref.Text, 9);
    AdsUrl.Caption := Copy(AdsHref.Text, 9, dl - 7);
    adsurltext := AdsUrl.Caption;
    AdsHrefShape.Width := Round(Canvas.TextWidth(AdsUrl.Caption) * 1.27);
    AdsUrlDesc.Left := AdsHrefShape.Left + AdsHrefShape.Width + 2;
  end
  else
    AdsHrefShape.Width := 147;

  AdsSet.Visible := false;
  ObjShow(AdsControlP);
  LoadPNGfromRes(CtrPNG, 'ctr2_PNG');
  ctrbool := true;
  if (ctrbool) and (stavkabool) and (priblbool) then
  begin
    nextbool := true;
    nextPNG.Enabled := true;
    LoadPNGfromRes(nextPNG, 'next_PNG');
  end;
end;

procedure TForm1.AdsCreaterTimer(Sender: TObject);
begin
  if stage = 30 then
  begin
    PasteAds;
  end
  else if stage = 31 then
  begin
    SiteCode;
  end
  else if stage = 32 then
  begin
    TakeAds;
  end;
  AdsCreater.Interval := 3000 + random(2000);
end;

procedure TForm1.ADSDblClick(Sender: TObject);
begin
  ADS.Lines.Delete(ADS.CaretPos.Y);
end;

procedure TForm1.AdsDescsChange(Sender: TObject);
var
  i, dl: integer;
begin
  AdsDesc.Caption := '';
  dl := 0;

  for i := 0 to AdsDescs.Lines.Count - 1 do
  begin
    if AdsDesc.Caption <> '' then
      AdsDesc.Caption := AdsDesc.Caption + #$9 + AdsDescs.Lines.Strings[i]
    else
      AdsDesc.Caption := AdsDescs.Lines.Strings[i];
    dl := dl + AdsDescs.Lines.Strings[i].length;
  end;

  AdsDescCounter.Caption :=
    inttostr(25 - AdsDescs.Lines.Strings[AdsDescs.CaretPos.Y].length) + ' / ' +
    inttostr(66 - dl);
end;

procedure TForm1.AdsDescsEnter(Sender: TObject);
begin
  AdsDescCounter.Visible := true;
  ObjShow(AdsPreview);
  AdsDescsShape.Visible := true;
end;

procedure TForm1.AdsDescsExit(Sender: TObject);
begin
  AdsDescCounter.Visible := false;
  AdsPreview.Visible := false;
  AdsDescsShape.Visible := false;
end;

procedure TForm1.AdsDescsKeyPress(Sender: TObject; var Key: Char);
var
  i, dl: integer;
begin
  dl := 0;
  for i := 0 to AdsDescs.Lines.Count - 1 do
    dl := dl + AdsDescs.Lines.Strings[i].length;
  if (AdsDescs.Lines.Strings[AdsDescs.CaretPos.Y].length > 24) then
  begin
    AdsErr.Caption := 'Достигнута максимальная длина уточнения!';
    if (Key <> #8) and (Key <> #13) then
      Key := #0;
  end
  else if (dl > 65) then
  begin
    AdsErr.Caption := 'Достигнута общая длина уточнений!';
    if (Key <> #8) and (Key <> #13) then
      Key := #0;
  end
  else
    AdsErr.Caption := '';
end;

procedure TForm1.AdsFast1Click(Sender: TObject);
begin
  ObjShow(AdsSet);
end;

procedure TForm1.AdsFastsChange(Sender: TObject);
var
  i, dl: integer;
begin
  AdsFast1.Caption := AdsFasts.Lines.Strings[0];
  AdsFast2.Caption := AdsFasts.Lines.Strings[1];
  AdsFast3.Caption := AdsFasts.Lines.Strings[2];
  AdsFast4.Caption := AdsFasts.Lines.Strings[3];

  AdsFast2.Left := AdsFast1.Left + AdsFast1.Width + 14;
  AdsFast3.Left := AdsFast2.Left + AdsFast2.Width + 14;
  AdsFast4.Left := AdsFast3.Left + AdsFast3.Width + 14;
  dl := 0;
  for i := 0 to AdsFasts.Lines.Count - 1 do
    dl := dl + AdsFasts.Lines.Strings[i].length;
  AdsFastCounter.Caption :=
    inttostr(30 - AdsFasts.Lines.Strings[AdsFasts.CaretPos.Y].length) + ' / ' +
    inttostr(66 - dl);
end;

procedure TForm1.AdsFastsEnter(Sender: TObject);
begin
  AdsFastCounter.Visible := true;
  ObjShow(AdsPreview);
  AdsFastsShape.Visible := true;
end;

procedure TForm1.AdsFastsExit(Sender: TObject);
begin
  AdsFastCounter.Visible := false;
  AdsPreview.Visible := false;
  AdsFastsShape.Visible := false;
end;

procedure TForm1.AdsFastsKeyPress(Sender: TObject; var Key: Char);
var
  i, dl: integer;
begin
  if Key = #13 then
  begin
    if AdsFasts.Lines.Count = 4 then
    begin
      AdsErr.Caption := 'Достигнуто максимальное количество быстрых ссылок!';
      Key := #0;
    end
    else
      AdsErr.Caption := '';
  end
  else
  begin
    dl := 0;
    for i := 0 to AdsFasts.Lines.Count - 1 do
      dl := dl + AdsFasts.Lines.Strings[i].length;
    if (AdsFasts.Lines.Strings[AdsFasts.CaretPos.Y].length > 29) then
    begin
      AdsErr.Caption := 'Достигнута максимальная длина быстрой ссылки!';
      if (Key <> #8) then
        Key := #0;
    end
    else if (dl > 65) then
    begin
      AdsErr.Caption := 'Достигнута общая длина быстрых ссылок!';
      if (Key <> #8) then
        Key := #0;
    end
    else
      AdsErr.Caption := '';
  end;
end;

procedure TForm1.AdsHelpMouseEnter(Sender: TObject);
begin
  PreKeyHelp.Clear;
  PreKeyHelp.Lines.Strings[0] :=
    'Дополнительные элементы объявления - это элементы объявление использование которых  необходимо, а правильное применение (УТП в названиях) увеличивает CTR - кликабельность.'
    + ' Пример без УТП -> с УТП: Акция -> Акция -30% до 16:00; Гарантия -> Гарантия 5 лет.'
    + #13#10 +
    'Фактическая ссылка на страницу товара/услуги, это ссылка на которую пользователь будет попадать при клике по объявлению.'
    + #13#10 +
    'Ссылка автоматическа дополняется UTM-метками - средством получения информации с какого запроса пользователь пришел на сайт.'
    + #13#10 +
    'Отображаемая ссылка (до 20 символов) - это дополненительное описание к ссылке сайта в объявлении.'
    + #13#10 +
    'Быстрые ссылки (до 30 символов / 66 общих)- дополнительная строка из 4-х ссылок для переправления пользователя сразу к необходимому контенту. Если трафик ведётся на лендинг, то к обычной ссылке добавляются якоря (#help, #contacts и прочие).'
    + #13#10 +
    'Уточнения (до 25 символов / 66 общих) - дополнительная строка с дополнительной информацией, показывается только на первой позиции в спецразмещении.'
    + #13#10 +
    'ВСЕ названия писать с УТП, для ПОВЫШЕНИЯ CTR!!! УТП - уникальное торговое предложение.';
  ObjShow(PreKeyHelpP);
end;

procedure TForm1.AdsHelpMouseLeave(Sender: TObject);
begin
  PreKeyHelpP.Visible := false;
end;

procedure TForm1.AdsHrefEnter(Sender: TObject);
var
  dl: integer;
begin
  ObjShow(AdsPreview);
  AdsHrefShape.Visible := true;
  if AnsiPos('http://', AdsHref.Text) > 0 then
  begin
    dl := pos('/', AdsHref.Text, 8);
    AdsUrl.Caption := Copy(AdsHref.Text, 8, dl - 7);
    AdsHrefShape.Width := Round(Canvas.TextWidth(AdsUrl.Caption) * 1.27);
    AdsUrlDesc.Left := AdsHrefShape.Left + AdsHrefShape.Width + 2;
  end
  else if (AnsiPos('https://', AdsHref.Text) > 0) then
  begin
    dl := pos('/', AdsHref.Text, 9);
    AdsUrl.Caption := Copy(AdsHref.Text, 9, dl - 7);
    AdsHrefShape.Width := Round(Canvas.TextWidth(AdsUrl.Caption) * 1.27);
    AdsUrlDesc.Left := AdsHrefShape.Left + AdsHrefShape.Width + 2;
  end
  else
    AdsHrefShape.Width := 147;
end;

procedure TForm1.AdsHrefExit(Sender: TObject);
var
  dl: integer;
begin
  AdsPreview.Visible := false;
  AdsHrefShape.Visible := false;
  if AnsiPos('http://', AdsHref.Text) > 0 then
  begin
    dl := pos('/', AdsHref.Text, 8);
    AdsUrl.Caption := Copy(AdsHref.Text, 8, dl - 7);
    AdsHrefShape.Width := Round(Canvas.TextWidth(AdsUrl.Caption) * 1.27);
    AdsUrlDesc.Left := AdsHrefShape.Left + AdsHrefShape.Width + 2;
  end
  else if (AnsiPos('https://', AdsHref.Text) > 0) then
  begin
    dl := pos('/', AdsHref.Text, 9);
    AdsUrl.Caption := Copy(AdsHref.Text, 9, dl - 7);
    AdsHrefShape.Width := Round(Canvas.TextWidth(AdsUrl.Caption) * 1.27);
    AdsUrlDesc.Left := AdsHrefShape.Left + AdsHrefShape.Width + 2;
  end
  else
    AdsHrefShape.Width := 147;
end;

procedure TForm1.AdsHrefKeyPress(Sender: TObject; var Key: Char);
var
  dl: integer;
begin
  if (AnsiPos('http://', AdsHref.Text) > 0) then
  begin
    dl := pos('/', AdsHref.Text, 8);
    AdsUrl.Caption := Copy(AdsHref.Text, 8, dl - 7);
    AdsHrefShape.Width := Round(Canvas.TextWidth(AdsUrl.Caption) * 1.27);
    AdsUrlDesc.Left := AdsHrefShape.Left + AdsHrefShape.Width + 2;
  end
  else if (AnsiPos('https://', AdsHref.Text) > 0) then
  begin
    dl := pos('/', AdsHref.Text, 9);
    AdsUrl.Caption := Copy(AdsHref.Text, 9, dl - 7);
    AdsHrefShape.Width := Round(Canvas.TextWidth(AdsUrl.Caption) * 1.27);
    AdsUrlDesc.Left := AdsHrefShape.Left + AdsHrefShape.Width + 2;
  end
  else
    AdsHrefShape.Width := 147;
end;

procedure TForm1.AdsHrefKeyUp(Sender: TObject; var Key: Word;
  Shift: TShiftState);
var
  dl: integer;
begin
  if (AnsiPos('http://', AdsHref.Text) > 0) then
  begin
    dl := pos('/', AdsHref.Text, 8);
    AdsUrl.Caption := Copy(AdsHref.Text, 8, dl - 7);
    AdsHrefShape.Width := Round(Canvas.TextWidth(AdsUrl.Caption) * 1.27);
    AdsUrlDesc.Left := AdsHrefShape.Left + AdsHrefShape.Width + 2;
  end
  else if (AnsiPos('https://', AdsHref.Text) > 0) then
  begin
    dl := pos('/', AdsHref.Text, 9);
    AdsUrl.Caption := Copy(AdsHref.Text, 9, dl - 7);
    AdsHrefShape.Width := Round(Canvas.TextWidth(AdsUrl.Caption) * 1.27);
    AdsUrlDesc.Left := AdsHrefShape.Left + AdsHrefShape.Width + 2;
  end
  else
    AdsHrefShape.Width := 147;
end;

procedure TForm1.AdsMemoKeyDown(Sender: TObject; var Key: Word;
  Shift: TShiftState);
begin
  if ssShift in Shift then
    AdsMemo.SelLength := 0;
end;

procedure TForm1.AdsMemoKeyUp(Sender: TObject; var Key: Word;
  Shift: TShiftState);
begin
  AdsMemo.SelLength := 0;
end;

procedure TForm1.AdsMemoMouseUp(Sender: TObject; Button: TMouseButton;
  Shift: TShiftState; X, Y: integer);
begin
  AdsMemo.SelLength := 0;
end;

procedure TForm1.AdsPreviewMouseDown(Sender: TObject; Button: TMouseButton;
  Shift: TShiftState; X, Y: integer);
const
  SC_DragMove = $F012;
begin
  ReleaseCapture;
  (Sender as TPanel).Perform(WM_SysCommand, SC_DragMove, 0);
end;

procedure TForm1.AdsRightClick(Sender: TObject);
begin
  if IndexList.Lines.Strings[(Sender As TMemo).CaretPos.Y] <> '' then
  begin
    adsright_ii := strtoint(IndexList.Lines.Strings[(Sender As TMemo)
      .CaretPos.Y]);
    AdsZag.Caption := poisk.Cells[7, adsright_ii];
    AdsText.Caption := poisk.Cells[9, adsright_ii];
    AdsZag2.Caption := poisk.Cells[8, adsright_ii];
    PoiskWord.Caption := poisk.Cells[4, adsright_ii];
    ObjShow(AdsPreview);
    if AdsZag.Caption = '' then
      AdsZag.Caption := 'Не введено';
    if AdsZag2.Caption = '' then
      AdsZag2.Caption := 'Не введено';
    if AdsText.Caption = '' then
      AdsText.Caption := 'Не введено';
    AdsZag2.Left := AdsZag.Left + AdsZag.Width + 5;
  end;
end;

procedure TForm1.AdsRightCloseClick(Sender: TObject);
begin
  // AdsRightP.Visible := false;
  KeysP.Visible := false;
  // AdsRightP.Visible := false;
  AdsManager.Visible := false;
  // AdsRightZagsP.Visible := false;
  Zagotovki.Visible := false;
  AdsSettingsP.Visible := false;
  ObjShow(AdsControlP);
  SheetList.Enabled := true;
  LoadPNGfromRes(PriblPNG, 'pribl2_PNG');
end;

procedure TForm1.AdsRightContextPopup(Sender: TObject; MousePos: TPoint;
  var Handled: boolean);
begin
  Handled := true;
end;

procedure TForm1.AdsRightEChange(Sender: TObject);
begin
  AdsRight.Lines.Strings[adsright_i] := AdsRightE.Text;
  AdsText.Caption := AdsRightE.Text;
  AdsRightErr.Font.Color := clBlack;
  AdsRightErr.Caption := 'Осталось символов для заголовка ' +
    inttostr(maxdlz1 + maxdlz2 - length(AdsRightZagE.Text) -
    length(AdsRightZag2E.Text)) + ' / ' +
    inttostr(maxdltxt - length(AdsRightE.Text) - length(AdsRightZag2E.Text)) +
    ' для текста объявления.';
end;

procedure TForm1.AdsRightEEnter(Sender: TObject);
begin
  ObjShow(AdsPreview);
  AdsTextShape.Visible := true;
end;

procedure TForm1.AdsRightEExit(Sender: TObject);
begin
  AdsPreview.Visible := false;
  AdsTextShape.Visible := false;
end;

procedure TForm1.AdsRightEKeyPress(Sender: TObject; var Key: Char);
begin
  if (maxdltxt - 1 - length(AdsRightE.Text) - length(AdsRightZag2E.Text) = 0)
  then
    Key := #0;
end;

procedure TForm1.AdsRightHelpMouseEnter(Sender: TObject);
begin
  PreKeyHelp.Clear;
  PreKeyHelp.Lines.Strings[0] :=
    'Человекопонятные фразы - это фразы с правильной морфологией.' +
    'Пример: директ яндекс настройка -> настройка яндекс директа.' + #13#10 +
    'В первом поле ввода необходимо ввести заголовок объявления до ' +
    inttostr(maxdlz1 + maxdlz2) + ' символов' + #13#10 +
    'Во втором поле текст объявления до ' + inttostr(maxdltxt) + ' символов.' +
    #13#10 + 'Строить фразу необходимо только из слов в запросе, при необходимости, дополняя фразу другими словами.'
    + #13#10 +
    'Забегая впёред стоит отметить о стурктуре текста объявления и заголовка: {ЗАГОЛОВОК}+[{ЗАГОЛОВОК2} {ТЕКСТ ЗАПРОСА} {УТП} {ДЕДЛАЙН} {ПРИЗЫВ К ДЕЙСТВИЮ}]'
    + #13#10 + '{ЗАГОЛОВОК} <= ' + inttostr(maxdlz1) +
    ' символа, при этом заголовок в объявлении можно увеличить до ' +
    inttostr(maxdlz1 + maxdlz2) +
    ' символов путем размещения второй части заголовка в тексте объявления.' +
    #13#10 + '{ТЕКСТ ЗАПРОСА} - это именно та часть которую Вы формируете на данном этапе. Наличие Запроса в заголовке - крайне необходимо, в тексте объявления - желательно. Это значительно снижает стоимость клика.'
    + #13#10 +
    '{УТП} {ДЕДЛАЙН} {ПРИЗЫВ К ДЕЙСТВИЮ} - фразы значительно увеличивающие CTR объявления, т.е. кликабельность - процент соотношения кликов по объявлению к показам объявления. Чем выше CTR тем ниже стоимость клика.'
    + #13#10 +
    'Последние 3 части объявления подготовим позже. Но помните о балансе и ограничении в '
    + inttostr(maxdltxt) +
    ' символов: снижение цены {ЗАГОЛОВОК} {ТЕКСТ ЗАПРОСА} и повышение кликабельности {УТП} {ДЕДЛАЙН} {ПРИЗЫВ К ДЕЙСТВИЮ}.';
  ObjShow(PreKeyHelpP);
end;

procedure TForm1.AdsRightHelpMouseLeave(Sender: TObject);
begin
  PreKeyHelpP.Visible := false;
end;

procedure TForm1.AdsRightKeyDown(Sender: TObject; var Key: Word;
  Shift: TShiftState);
begin
  if ssShift in Shift then
    AdsRight.SelLength := 0;
end;

procedure TForm1.AdsRightKeyPress(Sender: TObject; var Key: Char);
begin
  case Key of
    #8:
      begin
        if AdsRight.Lines.Strings[AdsRight.CaretPos.Y] = '' then
          Key := #0;
      end;

  else

  end;
end;

procedure TForm1.AdsRightKeyUp(Sender: TObject; var Key: Word;
  Shift: TShiftState);
begin
  AdsRightZags.SelLength := 0;
end;

procedure TForm1.AdsRightMouseDown(Sender: TObject; Button: TMouseButton;
  Shift: TShiftState; X, Y: integer);
var
  i: integer;
begin
  if (Button = mbRight) and (ssAlt in Shift) then
  begin
    rpls_col := 9;
    rpls_row := -1;
    ObjShow(GroupSelectorZP);
    ErrorZP.Visible := true;
    ErrorZP.Font.Color := clBlack;
    ErrorZP.Caption := 'Идет сбор данных...';
    TakeListnoDup(GroupSelectorZM, GroupSelectorZMI, poisk, rpls_col);
    ErrorZP.Caption := 'Данные подготовлены.';
    for i := 0 to GroupSelectorZM.Lines.Count - 1 do
      if length(GroupSelectorZM.Lines.Strings[i]) > maxdltxt then
      begin
        ErrorZP.Visible := true;
        ErrorZP.Caption := 'Есть ошибки длины текста!';
        ErrorZP.Font.Color := clRed;
        break;
      end;
  end;
end;

procedure TForm1.AdsRightMouseUp(Sender: TObject; Button: TMouseButton;
  Shift: TShiftState; X, Y: integer);
begin
  AdsRightZags.SelLength := 0;
end;

procedure TForm1.AdsRightNextClick(Sender: TObject);
var
  stri, stri2, stri3, idkey: string;
  i: integer;
begin
  if (AdsRightE.Text <> '') and (AdsRightZagE.Text <> '') and
    (AdsRightZag2E.Text <> '') then
  begin
    // -------------------------------------------------------------------------
    ZConnection1.Connected := false;
    ZConnection1.Connected := true;

    stri := '';
    stri2 := '';

    for i := 0 to KeyPhraze.Lines.Count - 1 do
      if AnsiCompareStr(KeyCollector.Lines.Strings[adsright_i],
        Copy(KeyPhraze.Lines.Strings[i], AnsiPos('|*|',
        KeyPhraze.Lines.Strings[i]) + 3, KeyPhraze.Lines.Strings[i].length -
        1)) = 0 then
      begin
        stri := Copy(KeyPhraze.Lines.Strings[i], 0,
          AnsiPos('|*|', KeyPhraze.Lines.Strings[i]) - 1);
        stri2 := Copy(KeyPhraze.Lines.Strings[i],
          AnsiPos('|*|', KeyPhraze.Lines.Strings[i]) + 3,
          KeyPhraze.Lines.Strings[i].length - 1);
      end;

    stri3 := 'SELECT `id` FROM `keys` WHERE `key`=''' + stri +
      ''' AND `fraza`=''' + stri2 + '''';
    ZQuery1.SQL.Text := stri3;
    ZQuery1.Active := true;
    idkey := inttostr(ZQuery1.FieldByName('id').AsInteger);

    stri3 := 'SELECT `id` FROM `keywords` WHERE `idprod`=''' + id_prod +
      ''' AND `idkey`=''' + idkey + '''';
    ZQuery1.SQL.Text := stri3;
    ZQuery1.Active := true;

    if ZQuery1.FieldByName('id').AsInteger <> 0 then
      ZQuery1.SQL.Text := 'UPDATE `keywords` SET `termal`=''' +
        teplota.Lines.Strings[adsright_i] + ''', `lastupdate`=NOW(), `ads`=''' +
        AdsRightE.Text + ''',`adszag`=''' + AdsRightZagE.Text +
        ''' WHERE `idprod`=''' + id_prod + ''' AND `idkey`=''' + idkey + ''''
    else
      ZQuery1.SQL.Text :=
        'INSERT INTO `keywords`(`idprod`,`idkey`,`termal`, `lastupdate`,`ads`,`adszag`) VALUES ('''
        + id_prod + ''', ''' + idkey + ''', ''' + teplota.Lines.Strings
        [adsright_i] + ''', NOW(), ''' + AdsRightE.Text + ''', ''' +
        AdsRightZagE.Text + ''')';
    ZQuery1.ExecSQL;
    // --------------------------------------------------------------------------
    adsright_i := adsright_i + 1;
    AdsRightL.Caption := KeyCollector.Lines.Strings[adsright_i];
    AdsRightE.Text := AdsRight.Lines.Strings[adsright_i];
    AdsRightZagE.Text := AdsRightZags.Lines.Strings[adsright_i];
    AdsRightZag2E.Text := AdsRightZags2.Lines.Strings[adsright_i];
    TeplotaShape.Visible := false;
  end
  else
    AdsRightErr.Caption := 'Пустая фраза недопустима!';
end;

procedure TForm1.AdsRightZag2EChange(Sender: TObject);
begin
  AdsZag2.Caption := '– ' + AdsRightZag2E.Text;
  AdsZag2.Left := AdsZag.Left + AdsZag.Width + 5;
  AdsRightZags2.Lines.Strings[adsright_i] := AdsRightZag2E.Text;
  AdsRightErr.Font.Color := clBlack;
  AdsRightErr.Caption := 'Осталось символов для заголовка ' +
    inttostr(maxdlz1 + maxdlz2 - length(AdsRightZagE.Text) -
    length(AdsRightZag2E.Text)) + ' / ' +
    inttostr(maxdltxt - length(AdsRightE.Text) - length(AdsRightZag2E.Text)) +
    ' для текста объявления.';
end;

procedure TForm1.AdsRightZag2EEnter(Sender: TObject);
begin
  ObjShow(AdsPreview);
  AdsZagShape.Visible := true;
  AdsZag.Caption := AdsRightZagE.Text;
  AdsZag2.Caption := AdsRightZag2E.Text;
end;

procedure TForm1.AdsRightZag2EExit(Sender: TObject);
begin
  AdsZagShape.Visible := false;
  if length(AdsRightZag2E.Text) > 0 then
  begin
    if (AnsiPos(string(AdsRightZag2E.Text)[length(AdsRightZag2E.Text)], zn) = 0)
    then
    begin
      AdsRightZag2E.SetFocus;
      AdsRightZag2E.SelStart := length(AdsRightZag2E.Text);
      AdsRightZag2E.SelLength := 0;
      AdsRightErr.Caption :=
        'Вконце второго заголовка объзателен знак конца предложения (. ! ?)!';
    end
    else
      AdsRightZags2.Lines.Strings[adsright_i] := AdsRightZag2E.Text;
  end;
end;

procedure TForm1.AdsRightZag2EKeyPress(Sender: TObject; var Key: Char);
begin
  if ((length(AdsRightZag2E.Text) = 1) or (AdsRightZag2E.Text = '')) and
    (Key = #8) then
  begin
    AdsRightZagE.SetFocus;
    AdsRightZagE.SelStart := length(AdsRightZagE.Text);
    AdsRightZagE.SelLength := 0;
  end;
  if ((maxdlz1 + maxdlz2 - length(AdsRightZagE.Text) -
    length(AdsRightZag2E.Text)) = 0) and (Key <> #8) and
    (AdsRightZag2E.Text <> '') then
  begin
    if (AnsiPos(string(AdsRightZag2E.Text)[length(AdsRightZag2E.Text)], zn) = 0)
      and (AdsRightZag2E.Text <> '') then
      AdsRightErr.Caption :=
        'Вконце второго заголовка объзателен знак конца предложения (. ! ?)!';
    Key := #0;
  end;
end;

procedure TForm1.AdsRightZagEChange(Sender: TObject);
begin
  AdsRightZags.Lines.Strings[adsright_i] := AdsRightZagE.Text;
  AdsZag.Caption := AdsRightZagE.Text;
  AdsRightErr.Font.Color := clBlack;
  AdsRightErr.Caption := 'Осталось символов для заголовка ' +
    inttostr(maxdlz1 + maxdlz2 - length(AdsRightZagE.Text) -
    length(AdsRightZag2E.Text)) + ' / ' +
    inttostr(maxdltxt - 1 - length(AdsRightE.Text) - length(AdsRightZag2E.Text))
    + ' для текста объявления.';
end;

procedure TForm1.AdsRightZagEEnter(Sender: TObject);
begin
  ObjShow(AdsPreview);
  AdsZagShape.Visible := true;
  TrimRight(AdsRightZagE.Text);
  AdsZag.Caption := AdsRightZagE.Text;
  AdsZag2.Caption := AdsRightZag2E.Text;
end;

procedure TForm1.AdsRightZagEExit(Sender: TObject);
begin
  AdsZagShape.Visible := false;
  AdsRightZags.Lines.Strings[adsright_i] := AdsRightZagE.Text;
end;

procedure TForm1.AdsRightZagEKeyPress(Sender: TObject; var Key: Char);
var
  stri, stri2, stri3: string;
  SL: TStringList;
  i, dl, n: integer;
begin
  if Key <> #9 then
  begin
    if (Key = #8) and (AdsRightZag2E.Text <> '') and
      (length(AdsRightZagE.Text) = maxdlz1) then
    begin

    end
    else if (length(AdsRightZagE.Text) > maxdlz1 - 1) then
    begin
      if (AdsRightZag2E.Text = '') then
      begin
        if Key = ' ' then
        begin
          if string(AdsRightZagE.Text)[length(AdsRightZagE.Text)] = ' ' then
          begin
            TrimRight(AdsRightZagE.Text);
          end;
          AdsRightZag2E.SetFocus;
          AdsRightZag2E.SelLength := 0;
          Key := #0;
        end

        else
        begin
          stri := AdsRightZagE.Text;
          SL := TStringList.Create;
          SL.Text := StringReplace(stri, ' ', #13#10, [rfReplaceAll]);
          dl := 0;
          n := 0;
          while dl < maxdlz1 + 1 do
          begin
            if dl = maxdlz1 then
              break;
            if dl <> 0 then
              dl := dl + SL[n].length + 1
            else
              dl := dl + SL[n].length;
            n := n + 1;
          end;

          if SL.Count >= n - 1 then
          begin
            stri2 := '';

            for i := 0 to n - 2 do
            begin
              if stri2 <> '' then
                stri2 := stri2 + ' ' + SL[i]
              else
                stri2 := SL[i];
            end;

            stri3 := '';
            for i := n - 1 to SL.Count - 1 do
            begin
              if stri3 <> '' then
                stri3 := stri3 + ' ' + SL[i]
              else
                stri3 := SL[i];
            end;

            zag := stri2;
            zag2 := stri3 + Key;
            AdsRightZag2E.Text := stri3 + Key;
            AdsRightZagE.Text := stri2;
            AdsRightZag2E.SetFocus;
            AdsRightZag2E.SelStart := length(AdsRightZag2E.Text);
            AdsRightZag2E.SelLength := 0;
            FreeAndNil(SL);
            Key := #0;
          end;

        end;
      end
      else
      begin
        if (Key <> #8) or (Key <> #46) then
          Key := #0;
      end;
    end;
  end;
end;

procedure TForm1.AdsRightZags2Click(Sender: TObject);
begin
  adsright_ii := (Sender As TMemo).CaretPos.Y;
  AdsZag.Caption := AdsRightZags.Lines.Strings[adsright_ii];
  AdsZag2.Caption := AdsRight.Lines.Strings[adsright_ii];
  AdsText.Caption := AdsRight.Lines.Strings[adsright_ii];
  PoiskWord.Caption := KeyCollector.Lines.Strings[adsright_ii];
  ObjShow(AdsPreview);
end;

procedure TForm1.AdsRightZags2ContextPopup(Sender: TObject; MousePos: TPoint;
  var Handled: boolean);
begin
  Handled := true;
end;

procedure TForm1.AdsRightZags2MouseDown(Sender: TObject; Button: TMouseButton;
  Shift: TShiftState; X, Y: integer);
var
  i: integer;
begin
  if (Button = mbRight) and (ssAlt in Shift) then
  begin
    rpls_col := 8;
    rpls_row := -1;
    ObjShow(GroupSelectorZP);
    ErrorZP.Visible := true;
    ErrorZP.Font.Color := clBlack;
    ErrorZP.Caption := 'Идет сбор данных...';
    TakeListnoDup(GroupSelectorZM, GroupSelectorZMI, poisk, rpls_col);
    ErrorZP.Caption := 'Данные подготовлены.';
    for i := 0 to GroupSelectorZM.Lines.Count - 1 do
      if length(GroupSelectorZM.Lines.Strings[i]) > maxdlz2 then
      begin
        ErrorZP.Caption := 'Есть ошибки длины второго заголовка!';
        ErrorZP.Font.Color := clRed;
        break;
      end;
  end;
end;

procedure TForm1.AdsRightZagsClick(Sender: TObject);
begin
  adsright_ii := (Sender As TMemo).CaretPos.Y;
  AdsZag.Caption := AdsRightZags.Lines.Strings[adsright_ii];
  AdsZag2.Caption := AdsRight.Lines.Strings[adsright_ii];
  AdsText.Caption := AdsRight.Lines.Strings[adsright_ii];
  PoiskWord.Caption := KeyCollector.Lines.Strings[adsright_ii];
  ObjShow(AdsPreview);
end;

procedure TForm1.AdsRightZagsContextPopup(Sender: TObject; MousePos: TPoint;
  var Handled: boolean);
begin
  Handled := true;
end;

procedure TForm1.AdsRightZagsKeyDown(Sender: TObject; var Key: Word;
  Shift: TShiftState);
begin
  if ssShift in Shift then
    AdsRightZags.SelLength := 0;
end;

procedure TForm1.AdsRightZagsKeyPress(Sender: TObject; var Key: Char);
var
  stri, stri2, stri3, vr: string;
  SL: TStringList;
  i, dl, n: integer;
begin
  case Key of
    #8:
      begin
        if AdsRightZags.Lines.Strings[AdsRightZags.CaretPos.Y] = '' then
          Key := #0;
      end;
    #13:
      begin
        vr := AdsRightE.Text;
        if length(AdsRightZagE.Text) > maxdlz1 then
        begin
          stri := AdsRightZagE.Text;
          SL := TStringList.Create;
          SL.Text := StringReplace(stri, ' ', #13#10, [rfReplaceAll]);
          dl := 0;
          n := 0;
          for i := 0 to SL.Count - 1 do
          begin
            dl := dl + SL[i].length;
            if dl > maxdlz1 then
            begin
              n := i - 1;
              break;
            end;
          end;
          if n <> 0 then
          begin
            stri2 := '';
            for i := 0 to n do
            begin
              stri2 := stri2 + ' ' + SL[i];
            end;
            AdsZag.Caption := stri2;

            stri3 := '';
            for i := n + 1 to SL.Count - 1 do
            begin
              stri3 := stri3 + ' ' + SL[i];
            end;
            AdsZag2.Caption := stri3;
            zag := stri2;
            zag2 := stri3;
            AdsRightE.Text := stri3 + ' ' + vr;
            if length(AdsRightE.Text) > maxdltxt then
              AdsRightErr.Caption := 'Превышена длина текста объявления.'
            else
            begin
              AdsRightErr.Caption := 'Осталось символов для заголовка ' +
                inttostr(maxdlz1 - length(AdsRightZagE.Text)) + ' / ' +
                inttostr(maxdltxt - length(AdsRightE.Text)) +
                ' для текста объявления.';
            end;
          end;
        end
        else
          AdsZag2.Caption := '';
        Key := #0;
      end;
  else
    begin
      if AdsRightZags.Lines.Strings[AdsRightZags.CaretPos.Y].length > maxdlz1
      then
        ShowMessage('Максимальная длина ' + inttostr(maxdlz1) + ' символов!');
    end;
  end;
  AdsZag2.Left := AdsZag.Left + AdsZag.Width + 5;
end;

procedure TForm1.AdsRightZagsKeyUp(Sender: TObject; var Key: Word;
  Shift: TShiftState);
begin
  AdsRightZags.SelLength := 0;
end;

procedure TForm1.AdsRightZagsMouseDown(Sender: TObject; Button: TMouseButton;
  Shift: TShiftState; X, Y: integer);
var
  i: integer;
begin
  if (Button = mbRight) and (ssAlt in Shift) then
  begin
    rpls_col := 7;
    rpls_row := -1;
    ObjShow(GroupSelectorZP);
    ErrorZP.Font.Color := clBlack;
    ErrorZP.Caption := 'Идет сбор данных...';
    TakeListnoDup(GroupSelectorZM, GroupSelectorZMI, poisk, rpls_col);
    ErrorZP.Caption := 'Данные подготовлены.';
    for i := 0 to GroupSelectorZM.Lines.Count - 1 do
      if length(GroupSelectorZM.Lines.Strings[i]) > maxdlz1 then
      begin
        ErrorZP.Visible := true;
        ErrorZP.Caption := 'Есть ошибки длины заголовка!';
        ErrorZP.Font.Color := clRed;
        break;
      end;
  end;
end;

procedure TForm1.AdsRightZagsMouseUp(Sender: TObject; Button: TMouseButton;
  Shift: TShiftState; X, Y: integer);
begin
  AdsRightZags.SelLength := 0;
end;

procedure TForm1.AdsSettingsClick(Sender: TObject);
begin
  if AdsSettingsP.Visible then
    AdsSettingsP.Visible := false
  else
    AdsSettingsP.Visible := true;
end;

procedure TForm1.AdsTextClick(Sender: TObject);
begin
  ObjShow(ReplacerZTZP);
  OldZTZ.Caption := AdsText.Caption;
  ReplaceZTZOne.Enabled := true;
  ReplaceZTZOne.Font.Color := clBlack;
  rpls_row := adsright_ii;
  rpls_col := 9;
  MaxLenStr.Caption := inttostr(maxdltxt);
  LenStr.Caption := inttostr(length(OldZTZ.Caption));
  NewZTZ.Text := OldZTZ.Caption;
end;

procedure TForm1.AdsTextMouseDown(Sender: TObject; Button: TMouseButton;
  Shift: TShiftState; X, Y: integer);
var
  i: integer;
begin
  if Button = mbRight then
  begin
    rpls_col := 9;
    rpls_row := -1;
    ObjShow(GroupSelectorZP);
    ErrorZP.Visible := true;
    ErrorZP.Font.Color := clBlack;
    ErrorZP.Caption := 'Идет сбор данных...';
    TakeListnoDup(GroupSelectorZM, GroupSelectorZMI, poisk, rpls_col);
    ErrorZP.Caption := 'Данные подготовлены.';
    for i := 0 to GroupSelectorZM.Lines.Count - 1 do
      if length(GroupSelectorZM.Lines.Strings[i]) > maxdltxt then
      begin
        ErrorZP.Visible := true;
        ErrorZP.Caption := 'Есть ошибки длины текста!';
        ErrorZP.Font.Color := clRed;
        break;
      end;
  end;
end;

procedure TForm1.AdsTimeWorkClick(Sender: TObject);
begin
  ObjShow(WorkTimesP);
end;

procedure TForm1.AdsZag2Click(Sender: TObject);
begin
  ObjShow(ReplacerZTZP);
  OldZTZ.Caption := AdsZag2.Caption;
  ReplaceZTZOne.Enabled := true;
  ReplaceZTZOne.Font.Color := clBlack;
  rpls_row := adsright_ii;
  rpls_col := 8;
  MaxLenStr.Caption := inttostr(maxdlz2);
  LenStr.Caption := inttostr(length(OldZTZ.Caption));
  NewZTZ.Text := OldZTZ.Caption;
end;

procedure TForm1.AdsZag2MouseDown(Sender: TObject; Button: TMouseButton;
  Shift: TShiftState; X, Y: integer);
var
  i: integer;
begin
  if Button = mbRight then
  begin
    rpls_col := 8;
    rpls_row := -1;
    ObjShow(GroupSelectorZP);
    ErrorZP.Font.Color := clBlack;
    ErrorZP.Caption := 'Идет сбор данных...';
    TakeListnoDup(GroupSelectorZM, GroupSelectorZMI, poisk, rpls_col);
    ErrorZP.Caption := 'Данные подготовлены.';
    for i := 0 to GroupSelectorZM.Lines.Count - 1 do
      if length(GroupSelectorZM.Lines.Strings[i]) > maxdlz2 then
      begin
        ErrorZP.Visible := true;
        ErrorZP.Caption := 'Есть ошибки длины второго заголовка!';
        ErrorZP.Font.Color := clRed;
        break;
      end;
  end;
end;

procedure TForm1.AdsZagClick(Sender: TObject);
begin
  ObjShow(ReplacerZTZP);
  OldZTZ.Caption := AdsZag.Caption;
  ReplaceZTZOne.Enabled := true;
  ReplaceZTZOne.Font.Color := clBlack;
  rpls_row := adsright_ii;
  rpls_col := 7;
  MaxLenStr.Caption := inttostr(maxdlz1);
  LenStr.Caption := inttostr(length(OldZTZ.Caption));
  NewZTZ.Text := OldZTZ.Caption;
end;

procedure TForm1.AdsZagMouseDown(Sender: TObject; Button: TMouseButton;
  Shift: TShiftState; X, Y: integer);
var
  i: integer;
begin
  if Button = mbRight then
  begin
    rpls_col := 7;
    rpls_row := -1;
    ObjShow(GroupSelectorZP);
    ErrorZP.Font.Color := clBlack;
    ErrorZP.Caption := 'Идет сбор данных...';
    TakeListnoDup(GroupSelectorZM, GroupSelectorZMI, poisk, rpls_col);
    ErrorZP.Caption := 'Данные подготовлены.';
    for i := 0 to GroupSelectorZM.Lines.Count - 1 do
      if length(GroupSelectorZM.Lines.Strings[i]) > maxdlz1 then
      begin
        ErrorZP.Visible := true;
        ErrorZP.Caption := 'Есть ошибки длины заголовка!';
        ErrorZP.Font.Color := clRed;
        break;
      end;
  end;
end;

procedure TForm1.AllCityClick(Sender: TObject);
begin
  CitiesCh.Text := Cities.Text;
end;

procedure TForm1.BRConsoleMessage(Sender: TObject; const Browser: ICefBrowser;
  const message, source: ustring; line: integer; out Result: boolean);
begin
  if message <> '' then
  begin
    NameFile.Caption := message;
    if onebool then
      reclick.Enabled := true;
  end;
end;

procedure AddId(SG: TStringGrid; Memo: TMemo; i_check, i_do: integer);
var
  j, i, r: integer;
begin
  for i := 0 to Memo.Lines.Count - 1 div 2 do
  begin
    if i > 0 then
    begin
      for j := 0 to SG.RowCount - 1 do
      begin
        if SG.Cells[i_do, j] = '' then
        begin
          r := wasstrfullT2(SG.Cells[i_do, j], SG, i_do, 0, j - 1);
          if r > -1 then
          begin
            SG.Cells[i_do, j] := SG.Cells[i_do, r];
          end
          else
          begin
            if AnsiCompareText(SG.Cells[i_check, j],
              Memo.Lines.Strings[i + 1]) = 0 then
            begin
              SG.Cells[i_do, j] := Memo.Lines.Strings[i];
            end;
          end;
        end;
      end;
    end
    else
    begin
      if AnsiCompareText(SG.Cells[i_check, 0], Memo.Lines.Strings[i + 1]) = 0
      then
      begin
        SG.Cells[i_do, 0] := Memo.Lines.Strings[i];
      end;
    end;
  end;
end;

procedure TForm1.BRRegConsoleMessage(Sender: TObject;
  const Browser: ICefBrowser; const message, source: ustring; line: integer;
  out Result: boolean);
var
  ii: integer;
  b: boolean;
  Sads, Szag, Surl, Shref: string;
  fL: TStringList;
begin
  if AnsiCompareStr(Copy(message, 0, 4), 'domn') = 0 then
  begin
    b := false;
    for ii := 0 to SiteList.Lines.Count - 1 do
      if AnsiPos(SiteList.Lines[ii], Copy(message, 6, length(Message))) > 0 then
        b := true;
    if b = false then
    begin
      fL := TStringList.Create;
      try
        fL.Delimiter := '*';
        fL.StrictDelimiter := true;
        fL.DelimitedText := Copy(message, 6, length(Message));
        Surl := fL[0];
        Szag := fL[1];
        Sads := fL[2];
        Shref := fL[3];
      finally
        fL.Free
      end;
      SiteList.Lines.Add(Surl);
      ZagMemo.Lines.Add(Szag);
      AdsMemo.Lines.Add(Sads);
      RekMemo.Lines.Add(Shref);
    end;
  end
  else if AnsiCompareStr(Copy(message, 0, 4), 'word') = 0 then
  begin
    wc := wc + 1;
    Keys.Lines.Add(Copy(message, 6, length(Message)));
    KeyPhraze.Lines.Add(PreKey.Lines.Strings[word_i] + '|*|' + Copy(message, 6,
      length(Message)));
    if wc > w then
      stage := 4;
  end
  else if AnsiCompareStr(Copy(message, 0, 4), 'worr') = 0 then
  begin
    if rsy_end < rsy.RowCount - 2 then
    begin
      stage := 24;
    end;

    wc := wc + 1;

    stats[wc - 1] := Copy(message, 6, length(Message));
    indx[wc - 1] := rsy.RowCount - 1;
    rsy.Cells[0, rsy.RowCount - 1] := wordrsy;
    rsy.Cells[1, rsy.RowCount - 1] := Copy(message, 6, length(Message));
    rsy.RowCount := rsy.RowCount + 1;

    if wc > w then
    begin
      stage := 24;
    end;
  end
  else if AnsiCompareStr(Copy(message, 0, 4), 'stat') = 0 then
  begin
    wc := wc + 1;

    rsy.Cells[2, rsy_start + wc - 1] := Copy(message, 6, length(Message));

    if wc > w then
    begin
      stage := 25;
    end;
  end
  else if AnsiCompareStr(message, 'b-pager__active') = 0 then
  begin
    stage := 8;
  end
  else if AnsiCompareStr(message, 'b-pager__inactive') = 0 then
  begin
    Keys.Lines.SaveToFile(ExtractfilePath(Application.ExeName) + 'Projects/' +
      CodeName.Text + '/keywords/' + Keys.Lines[word_i] + '_ws.txt');
    word_i := word_i + 1;
    KeyCollector.Lines.Text := KeyCollector.Lines.Text + Keys.Lines.Text;
    Keys.Clear;
    stage := 6;
  end
  else if AnsiCompareStr(message, 'reload') = 0 then
  begin
    nextWord;
  end
  else if AnsiCompareStr(Copy(message, 0, 3), 'col') = 0 then
  begin
    w := strtoint(Copy(message, 5, length(Message)));
    if w = 0 then
    begin
      word_i := word_i + 1;
      stage := 1;
    end
    else
    begin
      stage := 7;
    end;

  end
  else if AnsiCompareStr(Copy(message, 0, 3), 'cor') = 0 then
  begin
    w := strtoint(Copy(message, 5, length(Message)));
    ShowMessage('Собрано8');
    if w = 0 then
    begin
      ShowMessage('Собрано9');
      rsy_i := rsy_i + 1;
      stage := 21;
    end
    else
    begin
      ShowMessage('Собрано10');
      stage := 27;
    end;

  end
  else if AnsiCompareStr(Copy(message, 0, 5), 'checr') = 0 then
  begin
    ShowMessage('Собрано11');
    if AnsiCompareStr(AnsiLowerCase(Copy(message, 7, length(Message))),
      AnsiLowerCase(rsy.Cells[1, rsy_i])) = 0 then
    begin
      stage := 23;
      ShowMessage('Собрано12');
      // Parser.Enabled := true;
    end
    else
    begin
      stage := 21;
      ShowMessage('Собрано22');
      // Parser.Enabled := true;
    end;
  end
  else if AnsiCompareStr(Copy(message, 0, 5), 'check') = 0 then
  begin
    if AnsiCompareStr(AnsiLowerCase(Copy(message, 7, length(Message))),
      AnsiLowerCase(PreKey.Lines[word_i])) = 0 then
      stage := 3
    else
      nextWord;
  end
  else if AnsiCompareStr(Copy(message, 1, 2), 'tk') = 0 then
    token := Copy(message, 4, length(Message) - 2)
  else if AnsiCompareStr(Copy(message, 1, 5), 'sites') = 0 then
  begin
    HideMemo.Clear;
    HideMemo.Lines.Text := StringReplace(Copy(message, 7, length(Message) - 2),
      ' ', #13#10, [rfReplaceAll]);
  end
  else if AnsiCompareStr(Copy(message, 1, 4), 'metr') = 0 then
  begin
    metrika := Copy(message, 6, length(Message) - 2);
    Finality.Enabled := true;
  end;
end;

procedure TForm1.BRRegLoadEnd(Sender: TObject; const Browser: ICefBrowser;
  const frame: ICefFrame; httpStatusCode: integer);
// var
// CodeStr{, stri}: string;
// Visitor: TElementNameVisitor;
begin
  if frame.IsMain then
  begin
    { Visitor := TElementNameVisitor.Create(Edit1.Text);
      frame.VisitDom( procedure (const DOM: ICefDomDocument)
      var
      DomNode: ICefDomNode;
      begin
      DomNode:= DOM.GetElementById('feed_rows');
      DomNode:= DomNode.FirstChild;
      while Assigned(DomNode) do
      begin

      end;
      end;); }
    if frame.url = 'http://directolog-plus.ru/directologplus/loader.php' then
    begin
      loaded := true;
      LoadProg.Enabled := false;
      if (LoginE.Text <> '') AND (PassE.Text <> '') then
        LoginI.Visible := true;
      LoadPNGfromRes(LoginI, 'PngImage_1');
      ZConnection1.Connected := true;
    end
    else if frame.url = 'http://directolog-plus.ru/directologplus/welcome.php'
    then
    begin
      loaded := true;
      ErrorL.Visible := true;
      ErrorL.Font.Color := clGreen;
      ErrorL.Caption := 'Добро пожаловать!';
      LoadPNGfromRes(LoginI, 'PngImage_3');
      Loading.Enabled := true;
    end
    else if frame.url = 'http://directolog-plus.ru/directologplus/errorAct.php'
    then
    begin
      loaded := false;
      BRReg.Load('http://directolog-plus.ru/directologplus/loader.php');
      ErrorL.Visible := true;
      ErrorL.Font.Color := clRed;
      ErrorL.Caption := 'Активация не подтверждена! Попробуйте позже.';
      LoadPNGfromRes(LoginI, 'PngImage_2');
    end
    else if frame.url = 'http://directolog-plus.ru/directologplus/error.php'
    then
    begin
      loaded := false;
      BRReg.Load('http://directolog-plus.ru/directologplus/loader.php');
      ErrorL.Visible := true;
      ErrorL.Font.Color := clRed;
      ErrorL.Caption := 'Неверный логин или пароль!';
      ClickLoadBool := false;
      ErrorLoadBool := true;
      LoadPNGfromRes(LoginI, 'PngImage_2');
    end
    else if (AnsiPos('https://passport.yandex.ru/passport?mode=auth', frame.url)
      > 0) and (yabool) then
    begin
      loaded := true;
      DoErr.Visible := true;
      DoErr.Font.Color := clRed;
      DoErr.Caption := 'Неверный логин или пароль!';
      // DoError.Visible := true;
      DoError.Font.Color := clRed;
      DoError.Caption := 'Неверный логин или пароль!';
    end
    else if (AnsiPos('https://oauth.yandex.ru/verification_code#access_token=',
      frame.url) > 0) then
    begin
      // ShowMessage('aaa');
      if token = '' then
      begin
        if not GetToken.Enabled then
        begin
          iTimer := 0;
          GetToken.Enabled := true;
        end
      end
      else
      begin
        st := 35;
        Finality.Enabled := true;
      end;
    end
    else if (AnsiCompareText('https://metrika.yandex.ru/list', frame.url) = 0)
    then
    begin
      if metrika = '' then
      begin
        if not GetMetrika.Enabled then
        begin
          iTimer := 0;
          GetMetrika.Enabled := true;
        end;
      end
      else
      begin
        st := 36;
        Finality.Enabled := true;
      end;
    end
    else if (AnsiPos('https://metrika.yandex.ru/', frame.url) > 0) and
      (AnsiPos('?tab=code', frame.url) > 0) then
    begin
      metrika := Copy(frame.url, length('https://metrika.yandex.ru/') + 1,
        AnsiPos('?tab=code', frame.url) - 1 -
        length('https://metrika.yandex.ru/'));
      // ShowMessage(metrika);
      Finality.Enabled := true;
    end;
    // metrika
    if AnsiPos('direct.yandex.ru', frame.url) > 0 then
    begin
      if AnsiCompareText(frame.url, 'https://direct.yandex.ru') = 0 then
      begin
        ObjShow(BrowserP);
        ShowMessage('Пройдите регистрацию в Яндекс.Директ!');
      end // direct
      else if AnsiPos('https://direct.yandex.ru/registered/main.pl',
        frame.url) > 0 then
      begin
        candocamp := true;
        st := 34;
        Finality.Enabled := true;
      end
      else
      begin
        // ShowMessage('AFAFAFA');
        (* stri := 'https://direct.yandex.ru/search/?regions=' + regions + '&text='
          + SellPhraseMemo.Lines[iSp];
          stri := StringReplace(stri, 'а', '%D0%B0', [rfReplaceAll]);
          stri := StringReplace(stri, 'б', '%D0%B1', [rfReplaceAll]);
          stri := StringReplace(stri, 'в', '%D0%B2', [rfReplaceAll]);
          stri := StringReplace(stri, 'г', '%D0%B3', [rfReplaceAll]);
          stri := StringReplace(stri, 'д', '%D0%B4', [rfReplaceAll]);
          stri := StringReplace(stri, 'е', '%D0%B5', [rfReplaceAll]);
          stri := StringReplace(stri, 'ё', '%D1%91', [rfReplaceAll]);
          stri := StringReplace(stri, 'ж', '%D0%B6', [rfReplaceAll]);
          stri := StringReplace(stri, 'з', '%D0%B7', [rfReplaceAll]);
          stri := StringReplace(stri, 'и', '%D0%B8', [rfReplaceAll]);
          stri := StringReplace(stri, 'й', '%D0%B9', [rfReplaceAll]);
          stri := StringReplace(stri, 'к', '%D0%BA', [rfReplaceAll]);
          stri := StringReplace(stri, 'л', '%D0%BB', [rfReplaceAll]);
          stri := StringReplace(stri, 'м', '%D0%BC', [rfReplaceAll]);
          stri := StringReplace(stri, 'н', '%D0%BD', [rfReplaceAll]);
          stri := StringReplace(stri, 'о', '%D0%BE', [rfReplaceAll]);
          stri := StringReplace(stri, 'п', '%D0%BF', [rfReplaceAll]);
          stri := StringReplace(stri, 'р', '%D1%80', [rfReplaceAll]);
          stri := StringReplace(stri, 'с', '%D1%81', [rfReplaceAll]);
          stri := StringReplace(stri, 'т', '%D1%82', [rfReplaceAll]);
          stri := StringReplace(stri, 'у', '%D1%83', [rfReplaceAll]);
          stri := StringReplace(stri, 'ф', '%D1%84', [rfReplaceAll]);
          stri := StringReplace(stri, 'х', '%D1%85', [rfReplaceAll]);
          stri := StringReplace(stri, 'ц', '%D1%86', [rfReplaceAll]);
          stri := StringReplace(stri, 'ч', '%D1%87', [rfReplaceAll]);
          stri := StringReplace(stri, 'ш', '%D1%88', [rfReplaceAll]);
          stri := StringReplace(stri, 'щ', '%D1%89', [rfReplaceAll]);
          stri := StringReplace(stri, 'ъ', '%D1%8A', [rfReplaceAll]);
          stri := StringReplace(stri, 'ы', '%D1%8B', [rfReplaceAll]);
          stri := StringReplace(stri, 'ь', '%D1%8C', [rfReplaceAll]);
          stri := StringReplace(stri, 'э', '%D1%8D', [rfReplaceAll]);
          stri := StringReplace(stri, 'ю', '%D1%8E', [rfReplaceAll]);
          stri := StringReplace(stri, 'я', '%D1%8F', [rfReplaceAll]);
          stri := StringReplace(stri, ' ', '%20', [rfReplaceAll]);        { }

          (*  if AnsiCompareText(stri, frame.url) = 0 then
          begin
          if Assigned(BRReg.Browser) and Assigned(BRReg.Browser.Mainframe) then
          begin

          CodeStr := '$( ".ad" ).each(function( index ) { if (index<10) {';
          CodeStr := CodeStr +
          'var zag = $ (this).children(".ad-link").children("a").text();';
          CodeStr := CodeStr +
          'var lk = $ (this).children(".url").children(".domain").text();';
          CodeStr := CodeStr +
          'var ads = $ (this).children("div").next("div").text();';
          CodeStr := CodeStr +
          'var hrf = $ (this).children(".ad-link").children("a").attr("href");';
          CodeStr := CodeStr +
          'var str = "domn "+lk+"*"+zag+"*"+ads+"*"+hrf;';
          CodeStr := CodeStr + 'console.log(str);}});';
          BRReg.Browser.Mainframe.ExecuteJavaScript(CodeStr, 'about:blank', 0);
          end;
          iSp := iSp + 1;
          if iSp > 2 then
          iSp := 0;
          end; *)
      end;
    end;
  end;
end;

procedure TForm1.BudgetEChange(Sender: TObject);
begin
  if BudgetE.Text <> '' then
    BudgetT.Position := strtoint(BudgetE.Text)
  else
  begin
    BudgetT.Position := 300;
    BudgetE.SelStart := length(BudgetE.Text);
    BudgetE.SelLength := 0;
  end;
end;

procedure TForm1.BudgetEExit(Sender: TObject);
begin
  if strtoint(BudgetE.Text) < 300 then
    BudgetE.Text := '300';
end;

procedure TForm1.BudgetTChange(Sender: TObject);
begin
  BudgetE.Text := inttostr(BudgetT.Position);
end;

procedure TForm1.Button1Click(Sender: TObject);
var
  CodeStr: string;
begin
  if Assigned(BR.Browser) and Assigned(BR.Browser.Mainframe) then
  begin
    CodeStr := '$("input[name=\"lucky\"]").val("' + login + '");';
    CodeStr := CodeStr + '$("input[name=\"chel\"]").val("' + password + '");';
    CodeStr := CodeStr + '$("input[name=\"prod\"]").val("' + code + '");';
    CodeStr := CodeStr + '$("input[name=\"buton\"]").click();';
    BR.Browser.Mainframe.ExecuteJavaScript(CodeStr, 'about:blank', 0);
  end;
  Button2.Click;
end;

procedure TForm1.Button2Click(Sender: TObject);
var
  CodeStr: string;
begin
  if Assigned(BR.Browser) and Assigned(BR.Browser.Mainframe) then
  begin
    CodeStr := 'console.log($("#namef").html());';
    BR.Browser.Mainframe.ExecuteJavaScript(CodeStr, 'about:blank', 0);
  end;
end;

procedure TForm1.Button3Click(Sender: TObject);
var
  i, j, k, l, ch_i, maxp, minp: integer; // , minsl, np
  SL2, SL: TStringList;
begin
  i := 2;
  j := 0;
  ZagotovkiT.RowCount := 1;

  while i < ParsObjs.obji - 1 do
  begin
    if AnsiPos('ad-link', ParsObjs.objs[i].param) > 0 then
    begin
      ZagotovkiT.Cells[0, j] := inttostr(i);
      ZagotovkiT.Cells[1, j] := ParsObjs.objs[i + 3].innerTxt;
      ZagotovkiT.Cells[2, j] := ParsObjs.objs[i + 6].innerTxt;
      ZagotovkiT.RowCount := ZagotovkiT.RowCount + 1;
      inc(j);
    end;
    inc(i);
  end;

  SL := TStringList.Create;
  SL.Text := StringReplace(KeyCollector.Lines.Strings[adsright_i], ' ', #13#10,
    [rfReplaceAll]);
  for i := 0 to j - 1 do
  begin
    ch_i := 0;
    for k := 0 to SL.Count - 1 do
      if AnsiPos(AnsiLowerCase(SL[k]), AnsiLowerCase(ZagotovkiT.Cells[2, i])) > 0
      then
      begin
        inc(ch_i);
      end;
    ZagotovkiT.Cells[3, i] := inttostr(ch_i);
  end;

  maxp := 80;
  for i := 0 to j - 1 do
  begin
    ZagotovkiT.Cells[4, i] := '0';
    if strtoint(ZagotovkiT.Cells[3, i]) > 0 then
      if maxp < strtoint(ZagotovkiT.Cells[3, i]) then
        maxp := strtoint(ZagotovkiT.Cells[3, i]);
  end;

  SL2 := TStringList.Create;
  for i := 0 to j - 1 do
  begin
    if strtoint(ZagotovkiT.Cells[3, i]) = maxp then
    begin
      SL2.Text := StringReplace(ZagotovkiT.Cells[2, i], '.', #13#10,
        [rfReplaceAll]);
      SL2.Text := StringReplace(SL2.Text, '?', #13#10, [rfReplaceAll]);
      SL2.Text := StringReplace(SL2.Text, '!', #13#10, [rfReplaceAll]);
      Zagotovki.Lines.Add(SL2.Text);
      for k := 0 to SL2.Count - 1 do
      begin
        ch_i := 0;
        for l := 0 to SL.Count - 1 do
          if AnsiPos(AnsiLowerCase(SL[l]), AnsiLowerCase(SL2[k])) > 0 then
          begin
            // ShowMessage(SL[l]+' | в | '+SL2[k]);
            inc(ch_i);
          end;
        if (ch_i > 0) and (strtoint(ZagotovkiT.Cells[4, i]) < ch_i) then
        begin
          ZagotovkiT.Cells[5, i] := SL2[k];
          // ZagotovkiT.Cells[4,i]:=inttostr(ch_i);
        end;
      end;
    end;
  end;
  minp := 80;
  for i := 0 to j - 1 do
  begin
    if (length(ZagotovkiT.Cells[5, i]) < minp) and
      (length(ZagotovkiT.Cells[5, i]) > 0) then
    begin
      if AdsZagC.Checked then
        AdsRightZagE.Text := ZagotovkiT.Cells[1, i];
      if AdsZag2C.Checked then
      begin
        SL2.Text := StringReplace(ZagotovkiT.Cells[2, i], '.', #13#10,
          [rfReplaceAll]);
        SL2.Text := StringReplace(SL2.Text, '?', #13#10, [rfReplaceAll]);
        SL2.Text := StringReplace(SL2.Text, '!', #13#10, [rfReplaceAll]);
        AdsRightZag2E.Text := SL2[0];
      end;
      if AdsTextC.Checked then
        AdsRightE.Text := ZagotovkiT.Cells[5, i];
    end;
  end;
end;

procedure ProcessElementsByName(const AFrame: ICefFrame; const AName: string);
var
  Visitor: TElementNameVisitor;
begin
  if Assigned(AFrame) then
  begin
    Visitor := TElementNameVisitor.Create(AName);
    AFrame.VisitDom(Visitor);
  end;
end;

procedure TForm1.ReplaceRefresh(ReplaceT, poisk: TStringGrid; TP: TProgressBar);
var
  SL: TStringList;
  vr: string;
  i, j, k: integer;
begin
  TP.max := ReplaceT.RowCount - 2;
  for k := 0 to ReplaceT.RowCount - 2 do
  begin
    TP.Position := k;
    if ReplaceT.Cells[1, k] <> '' then
    begin
      SL := TStringList.Create;
      vr := ReplaceT.Cells[0, k];
      j := 1;
      while ReplaceT.Cells[j, k] <> '' do
      begin
        SL.Add(ReplaceT.Cells[j, k]);
        inc(j);
      end;

      for i := 0 to poisk.RowCount - 1 do
        poisk.Cells[4, i] := AbsString(WordReplaceS(poisk.Cells[4, i], vr, SL));
      FreeAndNil(SL);
    end;
    if k mod 15 = 0 then
      Application.ProcessMessages;
  end;
end;

procedure TForm1.Button4Click(Sender: TObject);
var
  SL: TStringList;
  vr, sResponse, method, camp, api, url, rezult: string;
  i, j, k: integer;
  JsonToSend: TStringStream;
begin
  // NoDuplicate2(PreKey);
  // NoDuplicate3T(poisk, 4);
  // MinusCrossAdd(KeyCollector);
  (* for i := 0 to poisk.RowCount - 2 do
    begin
    { if poisk.Cells[28, i] = 'ком' then  }
    poisk.Cells[23, i] := '' ;
    //poisk.Cells[15, i] := '' ;
    //poisk.Cells[15, i] := '' ;
    { else if poisk.Cells[28, i] = 'инф' then
    poisk.Cells[8, i] := 'Подробнее на сайте!'
    else if poisk.Cells[28, i] = 'гео' then
    poisk.Cells[8, i] := 'Только в Стерлитамаке!'
    else if poisk.Cells[28, i] = 'общ' then
    poisk.Cells[8, i] := 'Жмите!';  }
    {wait(10);
    ShowMessage(poisk.Cells[0, i]); }
    end; *)
  // ExecuteFile('login.txt','','',SW_SHOW); //Открыть файл
  // DownloadFile(IdHTTP,'http://directolog-plus.ru/directologplus/dll/libEGL.dll','12345.qwe');
  // ObjShow(StavkaP);
  // ShowMessage(Stavka.Caption);
  // Finality.Enabled := true;
  // if pohozhest(Edit1.Text, Edit2.Text, SovT.Position, MinDlSlovT.Position) then  ShowMessage('Da');
  // poisk.ColCount := poisk.ColCount + 2;
  // ShowMessage(regions+' " '+RegionsMI.Text+' " '+Memo5.Text);

  (* sResponse := '{"result":{"AddResults":[{"Id":233229}]}}';
    vr := ParsJSON1('{"result":{"AddResults":[{"Id":233229}]}}', 'AddResults', 'Id');
    ShowMessage(vr); *)
  // ShowMessage(Phone.Text+' '+phoneGetCountry2(Phone.Text)+' '+phoneGetCity2(Phone.Text)+' '+phoneGetNumb2(Phone.Text));
    method := 'CreateNewWordstatReport';
    camp := 'reports';
    api := 'api';
    client := 'vinhunter';
    token := 'AQAAAAABrN4OAAQw4JCjsrZiX0oUgEU2XKGYOBU';
    IdHTTP.Request.CustomHeaders.Clear;
    IdHTTP.Request.CustomHeaders.Add('POST /json/v5/' + camp + '/ HTTP/1.1');
    IdHTTP.Request.CustomHeaders.Add('Referer: https://' + api +
    '.direct.yandex.com/json/v5/' + camp);
    IdHTTP.Request.CustomHeaders.Add
    ('Content-Type: application/json; charset=utf-8');
    IdHTTP.Request.CustomHeaders.Add('Client-Login: ' + client);
    IdHTTP.Request.CustomHeaders.Add('Accept-Language: ru');
    IdHTTP.Request.CustomHeaders.Add('Host: ' + api + '.direct.yandex.com');
    IdHTTP.Request.CustomHeaders.Add('Authorization: Bearer ' + token);
    (*"ReportType": "SEARCH_QUERY_PERFORMANCE_REPORT", "Format": "TSV", "ReportName": "ADS", '+
    '"DateRangeType" : "LAST_MONTH", "FieldNames": "Keyword",  , "IncludeVAT": "NO", "IncludeDiscount": "NO"} *)
    url := 'https://' + api + '.direct.yandex.ru/json/v5/' + camp; //api.direct.yandex.com/json/v5/reports
    vr := '{"params": {"ReportType": "SEARCH_QUERY_PERFORMANCE_REPORT","Format": '+
    '"TSV","ReportName": "ADS","DateRangeType": "LAST_MONTH", '+
    '"FieldNames": ["Criteria"],  "SelectionCriteria": { "Filter": [{"Field": "Keyword",'+
    '"Operator": "IN", "Values": [ "купить iphone +x"]}]},"IncludeVAT": "NO","IncludeDiscount": "NO"} }';
    (*vr := '{"method":"add","params":{"VCards": [{ "CampaignId": "30538017", "Country" : "Россия", "City" : "Стерлитамак",'+
    '"CompanyName" : "ООО Стерлитамакская СанТехническая Компания","WorkTime" : "0;6;9;0;21;0",'+
    '"Phone" : {"CountryCode": "+7", "CityCode" : "917", "PhoneNumber": "4688000"}, "Street": "К.Маркса", "House": "151", "Building": "Е",'+
    '"ExtraMessage":"Центральное водоснабжение канализация горизонтальное бурение проектирование согласование (вода 1300 руб., канализация 1500руб., отопление от 1500руб.),лицензия сро, проект от 3000руб.",'+
    '"ContactEmail":"directolog-plus@ya.ru", "Ogrn": "1140280012179", "ContactPerson": "Ложкина Светлана Анатольевна"} ]}}';   *)
    JsonToSend := TStringStream.Create(vr, TEncoding.UTF8);
    try
      try
        sResponse := IdHTTP.Post(url, JsonToSend);
      except
        on E: Exception do
        ShowMessage('Error on request: '#13#10 + E.message);
      end;
    finally
      JsonToSend.Free;
    end;
    //rezult := ParsJSON1(sResponse, 'AddResults', 'Id' );
    ShowMessage(sResponse);

  // mcm_i := 0;
  // ShowMessage(inttostr(mcm_i));
  // TakeList(Memo6, CountControl, 0);
  // ShowMessage(inttostr(next_i));
   BRReg.Load( 'https://wordstat.yandex.ru/#!/?page=2&words=iphone');
  { ObjShow(Memo6); }
  // ProcessElementsByName(BRReg.Browser.MainFrame, Edit1.Text);
  // swapstlb(poisk, strtoint(Edit1.Text), strtoint(Edit2.Text));
  (*if Assigned(BRReg.Browser) and Assigned(BRReg.Browser.Mainframe) then
  begin
    vr := '$("#uniq'+uniq+'").val("'+PreKey.Lines.Strings[word_i]+' x");';
    vr := vr + '$("#uniq'+uniq+'").focus();';

    vr := vr + ' $(".b-form-button__input")[1].click();';
    BRReg.Browser.Mainframe.ExecuteJavaScript(vr, 'about:blank', 0);
  end;  *)
end;

procedure TForm1.Button5Click(Sender: TObject);
var
  // r, rc, c, i, j, k, l, sts, z, dl, rowss, Rows, ks, kr, kf, FindRes: integer;
  // i, j, l, kf, ks, kr, Rows : integer;
  i, j, l, kr, Rows: integer;
  // stri, s2, s3, s4, s5, vr, rt, AdsTextVr, RegionVr, NameVr: string;
  stri, rt, AdsTextVr, RegionVr, NameVr: string;
  SL, SL2: TStringList;
  // sr: TSearchRec;
  exReng: variant;
begin
  RegionVr := 'Россия';
  if Memo5.Lines.Count > 0 then
  begin
    ShowMessage('aa');
    RegionVr := '';
    for i := 0 to Memo5.Lines.Count - 1 do
    begin
      if RegionVr = '' then
        RegionVr := Memo5.Lines.Strings[i]
      else
        RegionVr := RegionVr + ', ' + Memo5.Lines.Strings[i];
    end;
  end;

  Excel := CreateOleObject('Excel.Application');
  Excel.DisplayAlerts := false;
  ExBook := Excel.WorkBooks.Open(ExtractfilePath(Application.ExeName) +
    'Settings/shablon.xlsx');
  ExSheet := ExBook.WorkSheets[1];
  LoadBarP.Visible := true;
  LoadBar.max := poisk.RowCount - 2;
  for i := 0 to poisk.RowCount - 2 do
  begin
    if poisk.Cells[5, i] = '1' then
    // and (poisk.cells[18, i] = '') //исправить в Финиш
    begin
      if i > 0 then
      begin
        // Блок в i = 0
        if not wasstrfullT3(poisk.Cells[13, i], poisk, 13, 0, i - 1) then
        begin
          // Добавление
          NameVr := poisk.Cells[13, i];
          kr := 0; // Kol Row
          LoadBar2.max := poisk.RowCount - 2;
          for j := i to poisk.RowCount - 2 do
          begin
            if AnsiCompareText(NameVr, poisk.Cells[13, j]) = 0 then
            begin
              Rows := 12;
              ExSheet.Cells[Rows + kr, 1] := '-';
              ExSheet.Cells[Rows + kr, 2] := 'Текстово-графическое';
              ExSheet.Cells[Rows + kr, 3] := '-';
              // ExSheet.Cells[rows+i - kf * ks, 4]:= poisk.Cells[16, i];;
              // ExSheet.Cells[Rows + i - kf * ks, 5] := code + '_' + inttostr(i + 1);
              ExSheet.Cells[Rows + kr, 5] := poisk.Cells[14, j];
              // ExSheet.Cells[rows+i - kf * ks, 6]:= '';
              ExSheet.Cells[Rows + kr, 7] := '-'; // poisk.Cells[18, i];
              // ExSheet.Cells[rows+i - kf * ks, 8]:= poisk.Cells[17, i];
              // ExSheet.Cells[Rows + i - kf * ks, 9] := KeyCollector.Lines.Strings[i];
              ExSheet.Cells[Rows + kr, 9] := poisk.Cells[4, j] + ' ' +
                poisk.Cells[6, j];
              // poisk.Cells[4, i] + ' ' + poisk.Cells[6, i];;
              // ExSheet.Cells[rows+i - kf * ks, 10]:='';
              // ExSheet.Cells[rows+i - kf * ks, 11]:='';
              ExSheet.Cells[Rows + kr, 12] := poisk.Cells[7, j];
              // AdsRightZags.Lines.Strings[i];
              // poisk.Cells[7, i];
              ExSheet.Cells[Rows + kr, 13] := poisk.Cells[8, j];
              // AdsRightZags2.Lines.Strings[i];
              // poisk.Cells[8, i];

              AdsTextVr := poisk.Cells[9, j] + ' ' + poisk.Cells[10, j] + ' ' +
                poisk.Cells[11, j] + ' ' + poisk.Cells[12, j];
              // ИСПРАВИТЬ НА ПОДСЧЕТ КОЛИЧЕСТВА //ЛИБО СЧИТАТЬ ВО ВРЕМЯ ФИНИШ
              ExSheet.Cells[Rows + kr, 14] := AdsTextVr;
              // ADS.Lines.Strings[i];
              // poisk.Cells[9, i] + ' ' + poisk.Cells[10, i] + ' ' + poisk.Cells[11, i] + ' ' + poisk.Cells[12, i];
              // ExSheet.Cells[rows+i - kf * ks, 14]:='';
              // ExSheet.Cells[rows+i - kf * ks, 15]:='';
              // ExSheet.Cells[rows + i - kf * ks, 16] := 'https://directolog-plus.ru/' + code +
              ExSheet.Cells[Rows + kr, 18] := AdsHref.Text +
                '?utm_source=yandex&utm_medium=cpc&utm_campaign={campaign_id}&utm_content={ad_id}&utm_term={keyword}';
              ExSheet.Cells[Rows + kr, 19] := '#' + hrefdesc.Text + '#';
              ExSheet.Cells[Rows + kr, 20] := RegionVr;
              // тут изменить  //изменил
              ExSheet.Cells[Rows + kr, 21] := poisk.Cells[20, j];
              // StringReplace(floattostr(StavkaF), ',', '.',[rfReplaceAll]); //
              // ExSheet.Cells[rows+i - kf * ks, 22]:=stavkavsetyah.Text;
              ExSheet.Cells[Rows + kr, 22] := '3';
              // poisk.Cells[21, j]; // Ставка в сетях
              ExSheet.Cells[Rows + kr, 23] := '+'; // Контакты
              // ExSheet.Cells[rows+i - kf * ks, 24]:='';        Статус объявления    // Поступи в ВУЗ мечты||Будь уверен в сдаче ЕГЭ||Учись с другом по акции
              ExSheet.Cells[Rows + kr, 25] := 'Работает везде';
              ExSheet.Cells[Rows + kr, 26] := AdsFast1.Caption + '||' +
                AdsFast2.Caption + '||' + AdsFast3.Caption + '||' +
                AdsFast4.Caption;
              ExSheet.Cells[Rows + kr, 27] := AdsFast1.Caption + '||' +
                AdsFast2.Caption + '||' + AdsFast3.Caption + '||' +
                AdsFast4.Caption;
              ExSheet.Cells[Rows + kr, 28] := AdsHref.Text + '#id1||' +
                AdsHref.Text + '#id2||' + AdsHref.Text + '#id3||' +
                AdsHref.Text + '#id4';
              ExSheet.Cells[Rows + kr, 29] := '';
              ExSheet.Cells[Rows + kr, 30] := '';
              ExSheet.Cells[Rows + kr, 31] := '';
              ExSheet.Cells[Rows + kr, 32] := ''; // Изображение для РСЯ
              ExSheet.Cells[Rows + kr, 33] := ''; // Креатив
              ExSheet.Cells[Rows + kr, 34] := ''; // Статус креатива
              ExSheet.Cells[Rows + kr, 35] := '';
              // Уточнения тут изменить   //см. ниже
              ExSheet.Cells[Rows + kr, 36] := ''; // Минусфразы на группу
              ExSheet.Cells[Rows + kr, 37] := 'Лицензия СРО'; // Дисклеймер?
              stri := '';
              for l := 0 to AdsDescs.Lines.Count - 1 do
                if stri = '' then
                  stri := AdsDescs.Lines.Strings[l]
                else
                  stri := stri + '||' + AdsDescs.Lines.Strings[l];
              ExSheet.Cells[Rows + kr, 35] := stri;
              inc(kr);
            end;
            LoadBar2.Position := j;
            if j mod 20 = 0 then
              Application.ProcessMessages;
          end;

          // Страница Инфо
          ExSheet := ExBook.WorkSheets[2];
          begin
            ExSheet.Cells[11, 3] := City.Text;
            ExSheet.Cells[13, 3] := Copy(Phone.Text, 1, 1);
            ExSheet.Cells[13, 4] := Copy(Phone.Text, 2, 3);
            ExSheet.Cells[13, 5] := Copy(Phone.Text, 4, 7);
            ExSheet.Cells[17, 2] := Kompaniya.Text;
            ExSheet.Cells[20, 2] := familiya.Text + ' ' + imya.Text + ' ' +
              otchestvo.Text;
            ExSheet.Cells[23, 2] := Ulica.Text;
            ExSheet.Cells[23, 4] := dom.Text;
            ExSheet.Cells[23, 5] := korpus.Text;
            ExSheet.Cells[23, 6] := ofice.Text;
            ExSheet.Cells[13, 9] := ogrn.Text;
            ExSheet.Cells[17, 9] := KontEmail.Text;

            SL := TStringList.Create;
            stri := '';
            for l := 0 to WorkTime.Lines.Count - 1 do
              stri := stri + WorkTime.Lines.Strings[l];
            try
              SL.Text := StringReplace(stri, ', ', #13#10, [rfReplaceAll]);

              exReng := ExSheet.range[ExSheet.Cells[27, 2],
                ExSheet.Cells[27 + SL.Count - 1, 6]];
              exReng.NumberFormat := '@';
              exReng.Value := exReng.Value;
              for j := 0 to SL.Count - 1 do
              begin
                SL2 := TStringList.Create;
                try
                  SL2.Text := StringReplace(SL[j], ' ', #13#10, [rfReplaceAll]);
                  if SL2[0].length > 3 then
                  begin
                    ExSheet.Cells[27 + j, 2] := Copy(SL2[0], 0, 2);
                    ExSheet.Cells[27 + j, 3] := Copy(SL2[0], 4, 2);
                  end
                  else
                  begin
                    ExSheet.Cells[27 + j, 2] := SL2[0];
                    ExSheet.Cells[27 + j, 3] := SL2[0];
                  end;
                  ExSheet.Cells[27 + j, 5] :=
                    Copy(SL2[1], 0, AnsiPos('-', SL2[1]) - 1);
                  ExSheet.Cells[27 + j, 6] :=
                    Copy(SL2[1], AnsiPos('-', SL2[1]) + 1, SL2[1].length);
                finally
                  FreeAndNil(SL2);
                end;

              end;

            finally
              FreeAndNil(SL);
            end;

            stri := '';
            for j := 1 to Addi.Lines.Count - 1 do
              stri := stri + Addi.Lines.Strings[j];
            ExSheet.Cells[23, 9] := stri;
          end;
          // Страница Инфо
          // Конец Добавления
          // Запись в файл
          rt := floattostr(Round(Date * 1000000 + Time * 1000000));
          CreateDir(ExtractfilePath(Application.ExeName) + 'Projects/' + code +
            '/yandex');
          ExBook.SaveAs(ExtractfilePath(Application.ExeName) + 'Projects/' +
            code + '/yandex/' + NameVr + '_' + rt + '.xlsx');
          // Конец Запись в файл
          // Создаем новый
          try
            begin
              Excel.Quit;
              Excel := Unassigned;
            end;
          except
          end;

          Excel := CreateOleObject('Excel.Application');
          Excel.DisplayAlerts := false;
          ExBook := Excel.WorkBooks.Open(ExtractfilePath(Application.ExeName) +
            'Settings/shablon.xlsx');
          ExSheet := ExBook.WorkSheets[1];
        end;
        // Блок в i = 0
      end
      else // Блок i = 0
      begin
        NameVr := poisk.Cells[13, i];
        kr := 0; // Kol Row
        for j := i to poisk.RowCount - 2 do
        begin
          if AnsiCompareText(NameVr, poisk.Cells[13, j]) = 0 then
          begin
            Rows := 12;
            ExSheet.Cells[Rows + kr, 1] := '-';
            ExSheet.Cells[Rows + kr, 2] := 'Текстово-графическое';
            ExSheet.Cells[Rows + kr, 3] := '-';
            // ExSheet.Cells[rows+i - kf * ks, 4]:= poisk.Cells[16, i];;
            // ExSheet.Cells[Rows + i - kf * ks, 5] := code + '_' + inttostr(i + 1);
            ExSheet.Cells[Rows + kr, 5] := poisk.Cells[14, j];
            // ExSheet.Cells[rows+i - kf * ks, 6]:= '';
            ExSheet.Cells[Rows + kr, 7] := '-'; // poisk.Cells[18, i];
            // ExSheet.Cells[rows+i - kf * ks, 8]:= poisk.Cells[17, i];
            // ExSheet.Cells[Rows + i - kf * ks, 9] := KeyCollector.Lines.Strings[i];
            ExSheet.Cells[Rows + kr, 9] := poisk.Cells[4, j] + ' ' +
              poisk.Cells[6, j];
            // poisk.Cells[4, i] + ' ' + poisk.Cells[6, i];;
            // ExSheet.Cells[rows+i - kf * ks, 10]:='';
            // ExSheet.Cells[rows+i - kf * ks, 11]:='';
            ExSheet.Cells[Rows + kr, 12] := poisk.Cells[7, j];
            // AdsRightZags.Lines.Strings[i];
            // poisk.Cells[7, i];
            ExSheet.Cells[Rows + kr, 13] := poisk.Cells[8, j];
            // AdsRightZags2.Lines.Strings[i];
            // poisk.Cells[8, i];

            AdsTextVr := poisk.Cells[9, j] + ' ' + poisk.Cells[10, j] + ' ' +
              poisk.Cells[11, j] + ' ' + poisk.Cells[12, j];
            // ИСПРАВИТЬ НА ПОДСЧЕТ КОЛИЧЕСТВА //ЛИБО СЧИТАТЬ ВО ВРЕМЯ ФИНИШ
            ExSheet.Cells[Rows + kr, 14] := AdsTextVr; // ADS.Lines.Strings[i];
            // poisk.Cells[9, i] + ' ' + poisk.Cells[10, i] + ' ' + poisk.Cells[11, i] + ' ' + poisk.Cells[12, i];
            // ExSheet.Cells[rows+i - kf * ks, 14]:='';
            // ExSheet.Cells[rows+i - kf * ks, 15]:='';
            // ExSheet.Cells[rows + i - kf * ks, 16] := 'https://directolog-plus.ru/' + code +
            ExSheet.Cells[Rows + kr, 18] := AdsHref.Text +
              '?utm_source=yandex&utm_medium=cpc&utm_campaign={campaign_id}&utm_content={ad_id}&utm_term={keyword}';
            ExSheet.Cells[Rows + kr, 19] := '#' + hrefdesc.Text + '#';
            ExSheet.Cells[Rows + kr, 20] := RegionVr; // тут изменить  //изменил
            ExSheet.Cells[Rows + kr, 21] := poisk.Cells[20, j];
            // StringReplace(floattostr(StavkaF), ',', '.',[rfReplaceAll]); //
            // ExSheet.Cells[rows+i - kf * ks, 22]:=stavkavsetyah.Text;
            ExSheet.Cells[Rows + kr, 22] := poisk.Cells[21, j];
            // Ставка в сетях
            ExSheet.Cells[Rows + kr, 23] := '+'; // Контакты
            // ExSheet.Cells[rows+i - kf * ks, 24]:='';        Статус объявления    // Поступи в ВУЗ мечты||Будь уверен в сдаче ЕГЭ||Учись с другом по акции
            ExSheet.Cells[Rows + kr, 25] := 'Работает везде';
            ExSheet.Cells[Rows + kr, 26] := AdsFast1.Caption + '||' +
              AdsFast2.Caption + '||' + AdsFast3.Caption + '||' +
              AdsFast4.Caption;
            ExSheet.Cells[Rows + kr, 27] := AdsFast1.Caption + '||' +
              AdsFast2.Caption + '||' + AdsFast3.Caption + '||' +
              AdsFast4.Caption;
            ExSheet.Cells[Rows + kr, 28] := AdsHref.Text + '#id1||' +
              AdsHref.Text + '#id2||' + AdsHref.Text + '#id3||' +
              AdsHref.Text + '#id4';
            ExSheet.Cells[Rows + kr, 29] := '';
            ExSheet.Cells[Rows + kr, 30] := '';
            ExSheet.Cells[Rows + kr, 31] := '';
            ExSheet.Cells[Rows + kr, 32] := ''; // Изображение для РСЯ
            ExSheet.Cells[Rows + kr, 33] := ''; // Креатив
            ExSheet.Cells[Rows + kr, 34] := ''; // Статус креатива
            ExSheet.Cells[Rows + kr, 35] := '';
            // Уточнения тут изменить   //см. ниже
            ExSheet.Cells[Rows + kr, 36] := ''; // Минусфразы на группу
            ExSheet.Cells[Rows + kr, 37] := 'Лицензия СРО'; // Дисклеймер?
            stri := '';
            for l := 0 to AdsDescs.Lines.Count - 1 do
              if stri = '' then
                stri := AdsDescs.Lines.Strings[l]
              else
                stri := stri + '||' + AdsDescs.Lines.Strings[l];
            ExSheet.Cells[Rows + kr, 35] := stri;
            inc(kr);
          end;
        end;

        // Страница Инфо
        ExSheet := ExBook.WorkSheets[2];
        begin
          ExSheet.Cells[11, 3] := City.Text;
          ExSheet.Cells[13, 3] := Copy(Phone.Text, 1, 1);
          ExSheet.Cells[13, 4] := Copy(Phone.Text, 2, 3);
          ExSheet.Cells[13, 5] := Copy(Phone.Text, 4, 7);
          ExSheet.Cells[17, 2] := Kompaniya.Text;
          ExSheet.Cells[20, 2] := familiya.Text + ' ' + imya.Text + ' ' +
            otchestvo.Text;
          ExSheet.Cells[23, 2] := Ulica.Text;
          ExSheet.Cells[23, 4] := dom.Text;
          ExSheet.Cells[23, 5] := korpus.Text;
          ExSheet.Cells[23, 6] := ofice.Text;
          ExSheet.Cells[13, 9] := ogrn.Text;
          ExSheet.Cells[17, 9] := KontEmail.Text;

          SL := TStringList.Create;
          stri := '';
          for l := 0 to WorkTime.Lines.Count - 1 do
            stri := stri + WorkTime.Lines.Strings[l];
          try
            SL.Text := StringReplace(stri, ', ', #13#10, [rfReplaceAll]);

            exReng := ExSheet.range[ExSheet.Cells[27, 2],
              ExSheet.Cells[27 + SL.Count - 1, 6]];
            exReng.NumberFormat := '@';
            exReng.Value := exReng.Value;
            for j := 0 to SL.Count - 1 do
            begin
              SL2 := TStringList.Create;
              try
                SL2.Text := StringReplace(SL[j], ' ', #13#10, [rfReplaceAll]);
                if SL2[0].length > 3 then
                begin
                  ExSheet.Cells[27 + j, 2] := Copy(SL2[0], 0, 2);
                  ExSheet.Cells[27 + j, 3] := Copy(SL2[0], 4, 2);
                end
                else
                begin
                  ExSheet.Cells[27 + j, 2] := SL2[0];
                  ExSheet.Cells[27 + j, 3] := SL2[0];
                end;
                ExSheet.Cells[27 + j, 5] :=
                  Copy(SL2[1], 0, AnsiPos('-', SL2[1]) - 1);
                ExSheet.Cells[27 + j, 6] :=
                  Copy(SL2[1], AnsiPos('-', SL2[1]) + 1, SL2[1].length);
              finally
                FreeAndNil(SL2);
              end;

            end;

          finally
            FreeAndNil(SL);
          end;

          stri := '';
          for j := 1 to Addi.Lines.Count - 1 do
            stri := stri + Addi.Lines.Strings[j];
          ExSheet.Cells[23, 9] := stri;
        end;
        // Страница Инфо
        // Конец Добавления
        // Запись в файл
        rt := floattostr(Round(Date * 1000000 + Time * 1000000));
        CreateDir(ExtractfilePath(Application.ExeName) + 'Projects/' + code +
          '/yandex');
        ExBook.SaveAs(ExtractfilePath(Application.ExeName) + 'Projects/' + code
          + '/yandex/' + NameVr + '_' + rt + '.xlsx');
        // Конец Запись в файл
        // Создаем новый
        try
          begin
            Excel.Quit;
            Excel := Unassigned;
          end;
        except
        end;

        Excel := CreateOleObject('Excel.Application');
        Excel.DisplayAlerts := false;
        ExBook := Excel.WorkBooks.Open(ExtractfilePath(Application.ExeName) +
          'Settings/shablon.xlsx');
        ExSheet := ExBook.WorkSheets[1];
      end;
    end;
    LoadBar.Position := i;
    if i mod 2 = 0 then
      Application.ProcessMessages;
  end;
end;

procedure TForm1.Button6Click(Sender: TObject);
begin
  // TakeList(Memo6, poisk, 2);
  // ObjShow(Memo6);
  // ReplaceT.RowCount := ReplaceT.RowCount + 1;
  // TakeList(KeyCollector, poisk, 4);
  // NoDuplicate2T(KeyCollector, poisk);
  // NoDuplicate3T(poisk, 4);
  // ShowMessage('a');
  ObjShow(LoadBarP);
  TakeList(KeyCollector, poisk, 4);
  MinusCrossMinT(KeyCollector, poisk, 6, LoadBar2);
end;

{ procedure TForm1.Button5Click(Sender: TObject);
  var
  i: Integer;
  vr: string;
  begin
  for i := 0 to poisk.RowCount - 1 do
  begin
  vr:= poisk.Cells[7, i];
  poisk.Cells[7, i] := poisk.Cells[9, i];
  poisk.Cells[9, i] := vr;

  end;
  end; }

procedure TForm1.CodeNameChange(Sender: TObject);
begin
  if next_i > 14 then
  begin
    if not(DirectoryExists(ExtractfilePath(Application.ExeName) + 'Projects'))
    then
      CreateDir(ExtractfilePath(Application.ExeName) + 'Projects');

    if not first then
    begin
      if (code <> '') and
        (DirectoryExists(ExtractfilePath(Application.ExeName) + 'Projects/' +
        code)) then
      begin
        SaveData(code);
      end;
    end;
  end;
end;

procedure TForm1.CodeNameKeyPress(Sender: TObject; var Key: Char);
begin
  Key := #0;
end;

procedure TForm1.CodeNameSelect(Sender: TObject);
begin
  if next_i = 15 then
    Edit.Text := CodeName.Items.Strings[CodeName.ItemIndex];
end;

procedure TForm1.ColdPNGClick(Sender: TObject);
var
  stri, stri2, stri3, idkey: string;
  i: integer;
begin
  ZConnection1.Connected := false;
  ZConnection1.Connected := true;
  teplota.Lines.Strings[adsright_i] := '1';
  stri := '';
  stri2 := '';
  for i := 0 to KeyPhraze.Lines.Count - 1 do
    if AnsiCompareStr(KeyCollector.Lines.Strings[adsright_i],
      Copy(KeyPhraze.Lines.Strings[i], AnsiPos('|*|', KeyPhraze.Lines.Strings[i]
      ) + 3, KeyPhraze.Lines.Strings[i].length - 1)) = 0 then
    begin
      stri := Copy(KeyPhraze.Lines.Strings[i], 0,
        AnsiPos('|*|', KeyPhraze.Lines.Strings[i]) - 1);
      stri2 := Copy(KeyPhraze.Lines.Strings[i],
        AnsiPos('|*|', KeyPhraze.Lines.Strings[i]) + 3,
        KeyPhraze.Lines.Strings[i].length - 1);
    end;
  TeplotaShape.Visible := true;;
  TeplotaShape.Left := ColdPNG.Left;

  stri3 := 'SELECT `id` FROM `keys` WHERE `key`=''' + stri + ''' AND `fraza`='''
    + stri2 + '''';
  ZQuery1.SQL.Text := stri3;
  ZQuery1.Active := true;
  idkey := inttostr(ZQuery1.FieldByName('id').AsInteger);

  stri3 := 'SELECT `id` FROM `keywords` WHERE `idprod`=''' + id_prod +
    ''' AND `idkey`=''' + idkey + '''';
  ZQuery1.SQL.Text := stri3;
  ZQuery1.Active := true;

  if ZQuery1.FieldByName('id').AsInteger <> 0 then
    ZQuery1.SQL.Text := 'UPDATE `keywords` SET `termal`=''' +
      teplota.Lines.Strings[adsright_i] +
      ''', `lastupdate`=NOW() WHERE `idprod`=''' + id_prod + ''' AND `idkey`='''
      + idkey + ''''
  else
    ZQuery1.SQL.Text :=
      'INSERT INTO `keywords`(`idprod`,`idkey`,`termal`, `lastupdate`) VALUES ('''
      + id_prod + ''', ''' + idkey + ''', ''' + teplota.Lines.Strings
      [adsright_i] + ''', NOW())';
  ZQuery1.ExecSQL; { }
  AdsRightB.Caption := 'Человекопонятные фразы ' + inttostr(adsright_i) + ' / '
    + inttostr(KeyCollector.Lines.Count - 1);
end;

procedure TForm1.Edit1Change(Sender: TObject);
begin
  BRReg.Load('yandex.ru');
end;

procedure TForm1.EditEnter(Sender: TObject);
begin
  if changebool then
  begin
    SaveChanges.Caption := 'Сохраните изменения';
  end;
end;

procedure TForm1.LoadData(code: string);
var
  stri, stri2: string;
  SL: TStringList;
  i: integer;
begin
  CreateDir(ExtractfilePath(Application.ExeName) + 'Projects');
  CreateDir(ExtractfilePath(Application.ExeName) + 'Projects/' + code);
  CreateDir(ExtractfilePath(Application.ExeName) + 'Projects/' + code +
    '/keywords');
  CreateDir(ExtractfilePath(Application.ExeName) + 'Projects/' + code +
    '/csv from google');

  ZConnection1.Connected := false;
  ZConnection1.Connected := true;

  stri := 'SELECT * FROM `product` WHERE `userid`=''' + id_user +
    ''' AND `durl`=''' + code + '''';
  ZQuery1.SQL.Text := stri;
  ZQuery1.Active := true;
  if ZQuery1.FieldByName('id').AsString <> '' then
  begin
    metrika := ZQuery1.FieldByName('meter').AsString;
    rsy_i := strtoint(ZQuery1.FieldByName('rsy_i').AsString);
    lvl_start := strtoint(ZQuery1.FieldByName('lvl_start').AsString);
    lvl_end := strtoint(ZQuery1.FieldByName('lvl_end').AsString);
    OtsevE.Text := ZQuery1.FieldByName('OtsevE').AsString;
    OtsevT.Position := strtoint(OtsevE.Text);
    SovE.Text := ZQuery1.FieldByName('SovE').AsString;
    SovT.Position := strtoint(SovE.Text);
    DlSovE.Text := ZQuery1.FieldByName('DlSovE').AsString;
    DlSovT.Position := strtoint(DlSovE.Text);
    MinDlSlovE.Text := ZQuery1.FieldByName('MinDlSlovE').AsString;
    MinDlSlovT.Position := strtoint(MinDlSlovE.Text);
    ProcClearE.Text := ZQuery1.FieldByName('ProcClearE').AsString;
    ProcClearT.Position := strtoint(ProcClearE.Text);
    SP_i := strtoint(ZQuery1.FieldByName('SP_i').AsString);
    DoST.ItemIndex := strtoint(ZQuery1.FieldByName('DoST').AsString);
    rsy2.ColCount := 6 + SP_i * 5;
    word_i := strtoint(ZQuery1.FieldByName('word_i').AsString);
    adsright_i := strtoint(ZQuery1.FieldByName('adsright_i').AsString);
    k_word := strtoint(ZQuery1.FieldByName('k_word').AsString);
    pages_i := strtoint(ZQuery1.FieldByName('pages_i').AsString);
    BudgetE.Text := ZQuery1.FieldByName('Budget').AsString;
    camp_i := strtoint(ZQuery1.FieldByName('camp_i').AsString);
    group_i := strtoint(ZQuery1.FieldByName('group_i').AsString);
    vcard_i := strtoint(ZQuery1.FieldByName('vcard_i').AsString);
    ads_i := strtoint(ZQuery1.FieldByName('ads_i').AsString);
    regionsz := ZQuery1.FieldByName('regionsz').AsString;

    if ZQuery1.FieldByName('OtsevC').AsString = '0' then
      OtsevC.Checked := false
    else
      OtsevC.Checked := true;
    if ZQuery1.FieldByName('dobbool').AsString = '0' then
      dobbool := false
    else
      dobbool := true;
    if ZQuery1.FieldByName('FormListClearC').AsString = '0' then
      FormListClearC.Checked := false
    else
      FormListClearC.Checked := true;
    if ZQuery1.FieldByName('ClearChisloC').AsString = '0' then
      ClearChisloC.Checked := false
    else
      ClearChisloC.Checked := true;
    if ZQuery1.FieldByName('FastClearCh').AsString = '0' then
      FastClearCh.Checked := false
    else
      FastClearCh.Checked := true;
    if ZQuery1.FieldByName('FindProxyCh').AsString = '0' then
      FindProxyCh.Checked := false
    else
      FindProxyCh.Checked := true;
    mca_i := strtoint(ZQuery1.FieldByName('mca_i').AsString);
    mcm_i := strtoint(ZQuery1.FieldByName('mcm_i').AsString);
    i_sin := strtoint(ZQuery1.FieldByName('sin_i').AsString);
    rpls_col_count := strtoint(ZQuery1.FieldByName('rpls_col').AsString);
  end;

  if DoST.ItemIndex > 0 then
  begin

    nextPNG.Enabled := true;
    LoadPNGfromRes(nextPNG, 'next_PNG');
    ZQuery1.SQL.Text := 'SELECT * FROM `product` WHERE `id`=''' +
      id_prod + '''';
    ZQuery1.Active := true; { }

    AdsHref.Text := ZQuery1.FieldByName('url').AsString;
    hrefdesc.Text := ZQuery1.FieldByName('urldesc').AsString;
    stri := ZQuery1.FieldByName('fasts').AsString;
    stri2 := ZQuery1.FieldByName('descs').AsString;

    SL := TStringList.Create;
    try
      SL.Text := StringReplace(stri, '||', #13#10, [rfReplaceAll]);
      if SL.Count > 0 then
        AdsFasts.Clear;
      for i := 0 to SL.Count - 1 do
        AdsFasts.Lines.Add(SL[i]);
    finally
      FreeAndNil(SL);
    end;
    SL := TStringList.Create;
    try
      SL.Text := StringReplace(stri2, '||', #13#10, [rfReplaceAll]);
      if SL.Count > 0 then
        AdsDescs.Clear;
      for i := 0 to SL.Count - 1 do
        AdsDescs.Lines.Add(SL[i]);
    finally
      FreeAndNil(SL);
    end;

    stri := 'SELECT * FROM `product` WHERE `id`=''' + id_prod + '''';
    ZQuery1.SQL.Text := stri;
    ZQuery1.Active := true;
    SrChek.Text := ZQuery1.FieldByName('SrChek').AsString;
    marzha.Text := ZQuery1.FieldByName('Marzha').AsString;
    k1.Text := ZQuery1.FieldByName('k1').AsString;
    k2.Text := ZQuery1.FieldByName('k2').AsString;
    prmarzhi.Text := ZQuery1.FieldByName('PrMarzhi').AsString;
    Lids.Text := ZQuery1.FieldByName('kolzay').AsString;
    if (SrChek.Text <> '') and (marzha.Text <> '') and (prmarzhi.Text <> '') and
      (k1.Text <> '') and (k2.Text <> '') and (Lids.Text <> '') then
    begin
      SrCheckF := strtofloat(SrChek.Text);
      MarzhaF := strtofloat(marzha.Text);
      K3F := strtofloat(prmarzhi.Text);
      K1F := strtofloat(k1.Text);
      K2F := strtofloat(k2.Text);
      StavkaF := SrCheckF * MarzhaF * K3F * K1F * K2F * koefrazb;
      Stavka.Caption := floattostr(StavkaF);

      LidsF := strtofloat(Lids.Text);
      ClicksF := LidsF / K1F / K2F;
      clicks.Caption := floattostr(ClicksF);
      clicksperdayF := Ceil(ClicksF / 30);
      clicksperday.Caption := floattostr(clicksperdayF);
      BudgetF := StavkaF * ClicksF;
      BudgetperdayF := StavkaF * clicksperdayF;
      BudgetPerDay.Caption := floattostr(BudgetperdayF);
      Budget.Caption := floattostr(BudgetF);
      ProgDohodF := SrCheckF * LidsF * MarzhaF - BudgetF;
      ProgDohod.Caption := floattostr(ProgDohodF);
    end;
  end;

  if FileExists(ExtractfilePath(Application.ExeName) + 'Settings/work.txt') then
    WorkTime.Lines.LoadFromFile(ExtractfilePath(Application.ExeName) +
      'Settings/work.txt');
  { if FileExists(ExtractfilePath(Application.ExeName) + 'Projects/' + code + '/'
    + code + '_rsyi.txt') then
    begin
    HideMemo.Lines.LoadFromFile(ExtractfilePath(Application.ExeName) +
    'Projects/' + code + '/' + code + '_rsyi.txt');
    rsy_i := StrToInt(HideMemo.Lines.Strings[0]);
    lvl_start := StrToInt(HideMemo.Lines.Strings[1]);
    lvl_end := StrToInt(HideMemo.Lines.Strings[2]);
    OtsevE.Text := HideMemo.Lines.Strings[3];
    OtsevT.Position := StrToInt(OtsevE.Text);
    SP_i := StrToInt(HideMemo.Lines.Strings[4]);
    DoST.ItemIndex := StrToInt(HideMemo.Lines.Strings[5]);
    rsy2.ColCount := 6 + SP_i * 5;
    word_i := StrToInt(HideMemo.Lines.Strings[6]);
    adsright_i := StrToInt(HideMemo.Lines.Strings[7]);
    k_word := StrToInt(HideMemo.Lines.Strings[8]);
    pages_i := StrToInt(HideMemo.Lines.Strings[9]);
    if HideMemo.Lines.Strings[10] = '0' then
    dobbool := false
    else
    dobbool := true;
    mca_i :=  StrToInt(HideMemo.Lines.Strings[11]);
    mcm_i :=  StrToInt(HideMemo.Lines.Strings[12]);
    end
    else
    rsy_i := 0; }
  if FileExists(ExtractfilePath(Application.ExeName) + 'Projects/' + code + '/'
    + code + '_localminus.txt') then
    LocalMinus.Lines.LoadFromFile(ExtractfilePath(Application.ExeName) +
      'Projects/' + code + '/' + code + '_localminus.txt');
  if FileExists(ExtractfilePath(Application.ExeName) + 'Projects/' + code + '/'
    + code + '_myminuss.txt') then
    MyMinuss.Lines.LoadFromFile(ExtractfilePath(Application.ExeName) +
      'Projects/' + code + '/' + code + '_myminuss.txt');
  if FileExists(ExtractfilePath(Application.ExeName) + 'Projects/' + code + '/'
    + code + '_sellphrase.txt') then
    SellPhraseMemo.Lines.LoadFromFile(ExtractfilePath(Application.ExeName) +
      'Projects/' + code + '/' + code + '_sellphrase.txt');
  if FileExists(ExtractfilePath(Application.ExeName) + 'Projects/' + code + '/'
    + code + '_sellphrase.txt') then
    DoSP.Lines.LoadFromFile(ExtractfilePath(Application.ExeName) + 'Projects/' +
      code + '/' + code + '_sellphrase.txt');
  if FileExists(ExtractfilePath(Application.ExeName) + 'Projects/' + code + '/'
    + code + '_sellphraseRSY.txt') then
    DoSR.Lines.LoadFromFile(ExtractfilePath(Application.ExeName) + 'Projects/' +
      code + '/' + code + '_sellphraseRSY.txt');
  if FileExists(ExtractfilePath(Application.ExeName) + 'Projects/' + code + '/'
    + code + '_sites.txt') then
    SiteList.Lines.LoadFromFile(ExtractfilePath(Application.ExeName) +
      'Projects/' + code + '/' + code + '_sites.txt');
  if FileExists(ExtractfilePath(Application.ExeName) + 'Projects/' + code + '/'
    + code + '_diffkeys.txt') then
    Memo4.Lines.LoadFromFile(ExtractfilePath(Application.ExeName) + 'Projects/'
      + code + '/' + code + '_diffkeys.txt');
  if SiteList.Text <> '' then
    KonkurentP.Visible := true; // loaddd          _diffkeys
  if FileExists(ExtractfilePath(Application.ExeName) + 'Projects/' + code + '/'
    + code + '_rek.txt') then
    RekMemo.Lines.LoadFromFile(ExtractfilePath(Application.ExeName) +
      'Projects/' + code + '/' + code + '_rek.txt');
  if FileExists(ExtractfilePath(Application.ExeName) + 'Projects/' + code + '/'
    + code + '_ads.txt') then
    AdsMemo.Lines.LoadFromFile(ExtractfilePath(Application.ExeName) +
      'Projects/' + code + '/' + code + '_ads.txt');
  if FileExists(ExtractfilePath(Application.ExeName) + 'Projects/' + code + '/'
    + code + '_zag.txt') then
    ZagMemo.Lines.LoadFromFile(ExtractfilePath(Application.ExeName) +
      'Projects/' + code + '/' + code + '_zag.txt');
  if FileExists(ExtractfilePath(Application.ExeName) + 'Projects/' + code + '/'
    + code + '_adsright.txt') then
    AdsRight.Lines.LoadFromFile(ExtractfilePath(Application.ExeName) +
      'Projects/' + code + '/' + code + '_adsright.txt');
  if FileExists(ExtractfilePath(Application.ExeName) + 'Projects/' + code + '/'
    + code + '_adsrightzags.txt') then
    AdsRightZags.Lines.LoadFromFile(ExtractfilePath(Application.ExeName) +
      'Projects/' + code + '/' + code + '_adsrightzags.txt');
  if FileExists(ExtractfilePath(Application.ExeName) + 'Projects/' + code + '/'
    + code + '_adsrightzags2.txt') then
    AdsRightZags2.Lines.LoadFromFile(ExtractfilePath(Application.ExeName) +
      'Projects/' + code + '/' + code + '_adsrightzags2.txt');
  if FileExists(ExtractfilePath(Application.ExeName) + 'Projects/' + code + '/'
    + code + '_tep.txt') then
    teplota.Lines.LoadFromFile(ExtractfilePath(Application.ExeName) +
      'Projects/' + code + '/' + code + '_tep.txt');
  if FileExists(ExtractfilePath(Application.ExeName) + 'Projects/' + code + '/'
    + code + '_kp.txt') then
    KeyPhraze.Lines.LoadFromFile(ExtractfilePath(Application.ExeName) +
      'Projects/' + code + '/' + code + '_kp.txt');

  if FileExists(ExtractfilePath(Application.ExeName) + 'Projects/' + code + '/'
    + code + '_chto.txt') then
    Chto.Lines.LoadFromFile(ExtractfilePath(Application.ExeName) + 'Projects/' +
      code + '/' + code + '_chto.txt');
  if FileExists(ExtractfilePath(Application.ExeName) + 'Projects/' + code + '/'
    + code + '_kakoe.txt') then
    Kakoe.Lines.LoadFromFile(ExtractfilePath(Application.ExeName) + 'Projects/'
      + code + '/' + code + '_kakoe.txt');
  if FileExists(ExtractfilePath(Application.ExeName) + 'Projects/' + code + '/'
    + code + '_deistvie.txt') then
    Deistvie.Lines.LoadFromFile(ExtractfilePath(Application.ExeName) +
      'Projects/' + code + '/' + code + '_deistvie.txt');
  if FileExists(ExtractfilePath(Application.ExeName) + 'Projects/' + code + '/'
    + code + '_proddob.txt') then
    ProdDob.Lines.LoadFromFile(ExtractfilePath(Application.ExeName) +
      'Projects/' + code + '/' + code + '_proddob.txt');
  if FileExists(ExtractfilePath(Application.ExeName) + 'Projects/' + code + '/'
    + code + '_mesto.txt') then
    Mesto.Lines.LoadFromFile(ExtractfilePath(Application.ExeName) + 'Projects/'
      + code + '/' + code + '_mesto.txt');
  if FileExists(ExtractfilePath(Application.ExeName) + 'Projects/' + code + '/'
    + code + '_konkurenty.txt') then
    Konkurenty.Lines.LoadFromFile(ExtractfilePath(Application.ExeName) +
      'Projects/' + code + '/' + code + '_konkurenty.txt');
  if FileExists(ExtractfilePath(Application.ExeName) + 'Projects/' + code + '/'
    + code + '_vremya.txt') then
    ADS.Lines.LoadFromFile(ExtractfilePath(Application.ExeName) + 'Projects/' +
      code + '/' + code + '_vremya.txt');
  if FileExists(ExtractfilePath(Application.ExeName) + 'Projects/' + code + '/'
    + code + '_gorod.txt') then
    CitiesCh.Lines.LoadFromFile(ExtractfilePath(Application.ExeName) +
      'Projects/' + code + '/' + code + '_gorod.txt');
  if FileExists(ExtractfilePath(Application.ExeName) + 'Projects/' + code + '/'
    + code + '_utp.txt') then
    UTPch.Lines.LoadFromFile(ExtractfilePath(Application.ExeName) + 'Projects/'
      + code + '/' + code + '_utp.txt');
  if FileExists(ExtractfilePath(Application.ExeName) + 'Projects/' + code + '/'
    + code + '_cta.txt') then
    CTAch.Lines.LoadFromFile(ExtractfilePath(Application.ExeName) + 'Projects/'
      + code + '/' + code + '_cta.txt');

  if FileExists(ExtractfilePath(Application.ExeName) + 'Projects/' + code + '/'
    + code + '_regions.txt') then
    Memo5.Lines.LoadFromFile(ExtractfilePath(Application.ExeName) + 'Projects/'
      + code + '/' + code + '_regions.txt');
  if FileExists(ExtractfilePath(Application.ExeName) + 'Projects/' + code + '/'
    + code + '_regions_id.txt') then
  begin
    RegionsMI.Lines.LoadFromFile(ExtractfilePath(Application.ExeName) +
      'Projects/' + code + '/' + code + '_regions_id.txt');
    for i := 0 to RegionsMI.Lines.Count - 1 do
      if regions = '' then
        regions := RegionsMI.Lines.Strings[i]
      else
        regions := regions + '%2C' + RegionsMI.Lines.Strings[i];
  end;

  if FileExists(ExtractfilePath(Application.ExeName) + 'Projects/' + code + '/'
    + code + '_rsy.txt') then
  begin
    // LoadTable(rsy, code);
    LoadTable(rsy2, code, SP_i, '_rsy');
    if FileExists(ExtractfilePath(Application.ExeName) + 'Projects/' + code +
      '/' + code + '_poisk.txt') then
    begin
      LoadTable2(poisk, code, '_poisk', 32);
    end;
    wr := rsy.RowCount - 2;
  end
  else
  begin
    wr := 0;
  end;

  if FileExists(ExtractfilePath(Application.ExeName) + 'Projects/' + code + '/'
    + code + '_rpls.txt') then
  begin
    LoadTable2(ReplaceT, code, '_rpls', rpls_col_count);
  end;
  if FileExists(ExtractfilePath(Application.ExeName) + 'Projects/' + code + '/'
    + code + '_zagotovki.txt') then
    Zagotovki.Lines.LoadFromFile(ExtractfilePath(Application.ExeName) +
      'Projects/' + code + '/' + code + '_zagotovki.txt');
  if FileExists(ExtractfilePath(Application.ExeName) + 'Projects/' + code + '/'
    + code + '_PreKeyRSY.txt') then
  begin
    PreKeyRSY.Lines.LoadFromFile(ExtractfilePath(Application.ExeName) +
      'Projects/' + code + '/' + code + '_PreKeyRSY.txt');
  end;
  if FileExists(ExtractfilePath(Application.ExeName) + 'Projects/' + code + '/'
    + code + '_prekey.txt') then
  begin
    PreKey.Lines.LoadFromFile(ExtractfilePath(Application.ExeName) + 'Projects/'
      + code + '/' + code + '_prekey.txt');
    { if PreKey.Text <> '' then
      begin
      PreKeyPP.Visible := true;
      ChoiseP.Visible := true;
      end; }
  end;
  if FileExists(ExtractfilePath(Application.ExeName) + 'Projects/' + code + '/'
    + code + '_shemeads.txt') then
  begin
    ShemeAds.Lines.LoadFromFile(ExtractfilePath(Application.ExeName) +
      'Projects/' + code + '/' + code + '_shemeads.txt');
  end;
  if FileExists(ExtractfilePath(Application.ExeName) + 'Projects/' + code + '/'
    + code + '_minuss.txt') then
  begin
    Minuss.Lines.LoadFromFile(ExtractfilePath(Application.ExeName) + 'Projects/'
      + code + '/' + code + '_minuss.txt');
  end;
  if FileExists(ExtractfilePath(Application.ExeName) + 'Projects/' + code + '/'
    + code + '_work.txt') then
  begin
    WorkTime.Lines.LoadFromFile(ExtractfilePath(Application.ExeName) +
      'Projects/' + code + '/' + code + '_work.txt');
  end;
  if FileExists(ExtractfilePath(Application.ExeName) + 'Projects/' + code + '/'
    + code + '_MyKey.txt') then
  begin
    MyKey.Lines.LoadFromFile(ExtractfilePath(Application.ExeName) + 'Projects/'
      + code + '/' + code + '_MyKey.txt');
  end;
  if FileExists(ExtractfilePath(Application.ExeName) + 'Projects/' + code + '/'
    + code + '_keys.txt') then
  begin
    KeyCollector.Lines.LoadFromFile(ExtractfilePath(Application.ExeName) +
      'Projects/' + code + '/' + code + '_keys.txt');
    if KeyCollector.Text <> '' then
    begin
      KeysP.Visible := true;
      ChoiseD.Visible := true;
      { keysPNG.Visible:=true;
        KeyParse.Visible := true; }

    end;
  end;
end;

procedure TForm1.LoaderTimer(Sender: TObject);
begin
  if st <> 0 then
  begin
    if LoadBar.Position = 0 then
      LoadBar.Position := 1;
    if st = 12 then
    begin
      if SP_i <= DoSR.Lines.Count + DoSP.Lines.Count - 1 then
      begin
        LoadBar.Min := 0;
        LoadBar.max := (DoSR.Lines.Count + DoSP.Lines.Count - 1) * 10;
        LoadBar.Position := SP_i * 10 + 1;
      end;
    end;
    if st = 13 then
    begin
      LoadBar.Position := 0;
    end;
    if st = 18 then
    begin
      if word_i <= PreKey.Lines.Count - 1 then
      begin
        LoadBar.Min := 0;
        LoadBar.max := (PreKey.Lines.Count - 1) * 10;
        LoadBar.Position := word_i * 10 + 1;
      end;
    end;
    if st = 23 then
    begin
      LoadBar.Position := 0;
    end;
    if st = 28 then
    begin
      if adsright_i <= KeyCollector.Lines.Count - 1 then
      begin
        LoadBar.Min := 0;
        LoadBar.max := (KeyCollector.Lines.Count - 1) * 10;
        LoadBar.Position := adsright_i * 10 + 1;
      end;
    end;
    if st = 31 then
    begin
      LoadBar.Position := 0;
    end;
  end;
  Label10.Caption := inttostr(st) + ' ' + inttostr(adsright_i) + ' ' +
    inttostr(word_i) + ' ' + inttostr(DoST.ItemIndex);
end;

procedure TForm1.EditKeyPress(Sender: TObject; var Key: Char);
var
  str: string;
begin
  InfoL.Font.Color := clBlack;
  if next_i = 8 then
  begin
    case Key of
      #8, '0' .. '9':
        ;
      #13:
        begin
          if Edit.Text <> '' then
          begin
            Phone.Text := Edit.Text;
            Phone.TextHint := Edit.TextHint;
            Edit.Text := KontEmail.Text;
            Edit.TextHint := 'Контактный email';
            InfoL.Caption := Edit.TextHint;
            HelpInput.Caption := '(: Пример: vinhunter@ya.ru';
            LoadPNGfromRes(InfoI, 'PngImage_7');
            next_i := next_i + 1;
          end;
        end
    else
      Key := Chr(0);
    end;
  end
  else if next_i = 12 then
  begin
    case Key of
      #8, 'a' .. 'z', 'A' .. 'Z', '0' .. '9':
        ;
      #13:
        begin
          ZConnection1.Connected := false;
          ZConnection1.Connected := true;
          str := 'SELECT 1 FROM `product` WHERE `durl`=''' + Edit.Text +
            ''' LIMIT 1';
          ZQuery1.SQL.Text := str;
          ZQuery1.Active := true;
          if ZQuery1.FieldByName('1').AsString <> '1' then
          begin
            CodeName.Visible := true;
            code := Edit.Text;
            CodeName.Items.Add(Edit.Text);
            CodeName.ItemIndex := CodeName.Items.Count - 1;
            CodeName.TextHint := Edit.TextHint;
            Edit.Text := '';
            Edit.PasswordChar := '*';
            Edit.TextHint := 'Пароль для сохранения';
            Addi.Visible := true;
            // WorkTimes.Visible := true;
            InfoL.Caption := Edit.TextHint;
            HelpInput.Caption :=
              '(: Введите пароль для подтверждения. Пример: ********';
            next_i := next_i + 1;
            // ShowMessage('asd');
          end
          else
          begin
            Edit.Text := '';
            Edit.TextHint := 'Ошибка имя занято';
            InfoL.Font.Color := clRed;
          end;
        end
    else
      Key := Chr(0);
    end;
  end
  else if (Key = #13) and ((Edit.Text <> '') or (next_i = 3) or (next_i = 4) or
    (next_i = 14)) then
  begin
    if next_i = 0 then
    begin
      City.Text := Edit.Text;
      City.TextHint := Edit.TextHint;
      Edit.Text := Ulica.Text;
      Edit.TextHint := 'Улицу';
      HelpInput.Caption := '(: Пример: Проспект Мира';
      InfoL.Caption := Edit.TextHint;
    end;
    if next_i = 1 then
    begin
      Ulica.Text := Edit.Text;
      Ulica.TextHint := Edit.TextHint;
      Edit.Text := dom.Text;
      Edit.TextHint := 'Номер дома';
      HelpInput.Caption := '(: Пример: 1';
      InfoL.Caption := Edit.TextHint;
    end;
    if next_i = 2 then
    begin
      dom.Text := Edit.Text;
      dom.TextHint := Edit.TextHint;
      Edit.Text := korpus.Text;
      Edit.TextHint := 'Номер корпуса';
      HelpInput.Caption := '(: Пример: 1';
      InfoL.Caption := Edit.TextHint;
    end;
    if next_i = 3 then
    begin
      korpus.Text := Edit.Text;
      korpus.TextHint := Edit.TextHint;
      Edit.Text := ofice.Text;
      Edit.TextHint := 'Номер офиса';
      HelpInput.Caption := '(: Пример: 303';
      InfoL.Caption := Edit.TextHint;
    end;
    if next_i = 4 then
    begin
      ofice.Text := Edit.Text;
      ofice.TextHint := Edit.TextHint;
      Edit.Text := imya.Text;
      Edit.TextHint := 'Имя';
      HelpInput.Caption := '(: Пример: Виктор';
      InfoL.Caption := Edit.TextHint;
      LoadPNGfromRes(InfoI, 'PngImage_5');
    end;
    if next_i = 5 then
    begin
      imya.Text := Edit.Text;
      imya.TextHint := Edit.TextHint;
      Edit.Text := familiya.Text;
      Edit.TextHint := 'Фамилия';
      HelpInput.Caption := '(: Пример: Климахин';
      InfoL.Caption := Edit.TextHint;
    end;
    if next_i = 6 then
    begin
      familiya.Text := Edit.Text;
      familiya.TextHint := Edit.TextHint;
      Edit.Text := otchestvo.Text;
      Edit.TextHint := 'Отчество';
      HelpInput.Caption := '(: Пример: Ахатович';
      InfoL.Caption := Edit.TextHint;
    end;
    if next_i = 7 then
    begin
      otchestvo.Text := Edit.Text;
      otchestvo.TextHint := Edit.TextHint;
      Edit.Text := Phone.Text;
      Edit.TextHint := 'Номер телефона';
      HelpInput.Caption := '(: Пример: 79677426171';
      InfoL.Caption := Edit.TextHint;
      LoadPNGfromRes(InfoI, 'PngImage_6');
    end;
    if next_i = 9 then
    begin
      KontEmail.Text := Edit.Text;
      KontEmail.TextHint := Edit.TextHint;
      Edit.Text := Kompaniya.Text;
      Edit.TextHint := 'Название компании';
      InfoL.Caption := Edit.TextHint;
      HelpInput.Caption := '(: Пример: Доктор Комп';
      LoadPNGfromRes(InfoI, 'PngImage_8');
    end;
    if next_i = 10 then
    begin
      Kompaniya.Text := Edit.Text;
      Kompaniya.TextHint := Edit.TextHint;
      Edit.Text := ogrn.Text;
      Edit.TextHint := 'ОГРН/ОГРНИП';
      HelpInput.Caption := '(: Пример: 314028000100642';
      InfoL.Caption := Edit.TextHint;
    end;
    if next_i = 11 then
    begin
      ogrn.Text := Edit.Text;
      ogrn.TextHint := Edit.TextHint;
      if CodeName.Items.Strings[CodeName.ItemIndex] <> '' then
      begin
        Edit.Text := '';
        Edit.PasswordChar := '*';
        Edit.TextHint := 'Пароль для сохранения';
        Addi.Visible := true;
        // WorkTimes.Visible := true;
        InfoL.Caption := Edit.TextHint;
        HelpInput.Caption :=
          '(: Заполните режим работы и подробности о товаре/услуге. Пример: ********';
      end
      else
      begin
        Edit.Text := '';
        Edit.TextHint := 'Товар/Услугу';
        HelpInput.Caption :=
          '(: На английском языке без знаков. Пример: directologplus';
        InfoL.Caption := Edit.TextHint;
      end;
      LoadPNGfromRes(InfoI, 'PngImage_9');
    end;
    if next_i = 13 then
    begin
      ZConnection1.Connected := false;
      ZConnection1.Connected := true;
      str := 'SELECT 1 FROM `users` WHERE `email`=''' + login +
        '''OR `phone`=''' + login + ''' AND `password`=''' + Edit.Text +
        ''' LIMIT 1';
      ZQuery1.SQL.Text := str;
      ZQuery1.Active := true;
      if ZQuery1.FieldByName('1').AsString = '1' then
      begin
        Edit.Text := '';
        Edit.PasswordChar := #0;
        Edit.TextHint := 'Оставить прежний';
        InfoL.Font.Color := clGreen;
        InfoL.Caption := 'Новый пароль';
        HelpInput.Caption :=
          'Сменить пароль? Введи выше новый пароль или нажмите Enter, чтобы оставить прежний.';
      end
      else
      begin
        next_i := next_i - 1;
        Edit.Text := '';
        Edit.TextHint := 'Ошибка';
        InfoL.Font.Color := clRed;
      end;
    end;
    if next_i = 14 then
    begin
      if Edit.Text = '' then
      begin
        SaveInfo;
      end
      else
      begin
        password := Edit.Text;
        SaveInfo; // asddsa
        Edit.Text := '';
      end;
      Edit.Text := CodeName.Items.Strings[CodeName.ItemIndex];
      Edit.TextHint := 'Товар/Услуга';
      InfoL.Caption := 'Товар/Услугу';
      HelpInput.Caption :=
        'Введите имя товара/услуги или выберите из списка выше! Пример: directologplus';
      addprodPNG.Visible := true;
      LoadPNGfromRes(addprodPNG, 'addprod_PNG');
    end;
    if next_i = 15 then
    begin
      if Edit.Text = '' then
      begin
        Edit.TextHint := 'Товар/Услуга';
        InfoL.Font.Color := clRed;
        InfoL.Caption := 'Товар/Услугу';
        HelpInput.Caption :=
          'Введите имя товара/услуги или выберите из списка выше! Пример: directologplus';
      end
      else
      begin
        ZConnection1.Connected := false;
        ZConnection1.Connected := true;
        first := false;
        str := 'SELECT * FROM `product` WHERE `userid`=''' + id_user +
          ''' AND `durl`=''' + Edit.Text + '''';
        ZQuery1.SQL.Text := str;
        ZQuery1.Active := true;
        if ZQuery1.FieldByName('id').AsString <> '' then
        begin
          SheetList.Visible := true;
          GlobalPNG.Visible := true;
          SettingsPNG.Visible := true;
          proxyPNG.Visible := true;
          InfoSheet.Visible := false;
          code := CodeName.Text;
          SheetHide;

          id_prod := ZQuery1.FieldByName('id').AsString;
          // ShowMessage('1%'+id_prod);
          LoadData(code);
          Sheet2Click(Sheet2);
        end
        else
        begin
          next_i := next_i - 1;
          Edit.TextHint := 'Товар/Услуга';
          InfoL.Font.Color := clRed;
          InfoL.Caption := 'Товар/Услугу';
          HelpInput.Caption :=
            'Товар/Услуга не найдены! Введите имя товара/услуги или выберите из списка выше! Пример: directologplus';
        end;
      end;
    end;
    if (CodeName.Items.Strings[CodeName.ItemIndex] <> '') and (next_i = 11) then
    begin
      next_i := 13
    end
    else
      next_i := next_i + 1;
  end;
  if next_i > 0 then
    InfoP.Visible := true;
  if Key = #13 then
    Key := #0;
end;

procedure TForm1.ErrorZPClick(Sender: TObject);
var
  i, M: integer;
begin
  if ErrorZP.Font.Color = clRed then
  begin
    M := 30;
    if rpls_col = 7 then
      M := maxdlz1;
    if rpls_col = 8 then
      M := maxdlz2;
    if rpls_col = 9 then
      M := maxdltxt;
    i := 0;
    while i < GroupSelectorZM.Lines.Count do
    begin
      if length(GroupSelectorZM.Lines.Strings[i]) <= M then
      begin
        GroupSelectorZM.Lines.Delete(i);
        GroupSelectorZMI.Lines.Delete(i);
      end
      else
        inc(i);
    end;
  end;
end;

procedure TForm1.SaveChangesClick(Sender: TObject);
var
  str, err, addi_str: string;
  k: integer;
begin
  if SaveChanges.Caption = 'Сохранить изменения' then
  begin
    ZConnection1.Connected := false;
    ZConnection1.Connected := true;
    err := '';
    HideMemo.Clear;

    addi_str := '';
    for k := 1 to Addi.Lines.Count - 1 do
      addi_str := addi_str + Addi.Lines[k];
    str := 'UPDATE `users` SET `phone`=''' + Phone.Text + ''',`password`=''' +
      password + ''',' + '`family`=''' + familiya.Text + ''',`name`=''' +
      imya.Text + ''',`soname`=''' + otchestvo.Text + ''',`city`=''' + City.Text
      + ''',`company`=''' + Kompaniya.Text + ''',' + '`street`=''' + Ulica.Text
      + ''',`home`=''' + dom.Text + ''',`cabinet`=''' + korpus.Text +
      ''',`office`=''' + ofice.Text + ''',' +
    // '`ogrn`='''+ogrn.Text+''',`cemail`='''+kontemail.Text+''',`addi`='''+addi_str+''',`additional`='''+additionals+''' WHERE `email`='''+login+'''';
      '`ogrn`=''' + ogrn.Text + ''',`cemail`=''' + KontEmail.Text +
      ''',`addi`=''' + addi_str + ''' WHERE `email`=''' + login +
      '''OR `phone`=''' + login + '''';
    HideMemo.Lines.Add(str);
    ZQuery1.SQL := HideMemo.Lines;
    ZQuery1.ExecSQL;

    SaveChanges.Caption := '/\';
    // SaveChanges.Align := alTop;
    changebool := false;
  end
  else
  begin
    if ShowInfoP.Visible then
    begin
      // SaveChanges.Align := alTop;
      SaveChanges.Caption := '\/';
      SaveChanges.Hint := 'Показать введенные данные';
      ShowInfoP.Visible := false;
    end
    else
    begin
      // SaveChanges.Align := alTop;
      SaveChanges.Caption := '/\';
      SaveChanges.Hint := 'Скрыть введенные данные';
      ShowInfoP.Visible := true;
    end;
  end;
end;

procedure TForm1.SaveChangesMouseEnter(Sender: TObject);
begin
  if changebool then
    SaveChanges.Caption := 'Сохранить изменения';
end;

Procedure TForm1.SaveInfo;
var
  str, err, addi_str: string;
  k: integer;
begin
  ZConnection1.Connected := false;
  ZConnection1.Connected := true;
  err := '';
  HideMemo.Clear;

  addi_str := '';
  for k := 1 to Addi.Lines.Count - 1 do
    addi_str := addi_str + Addi.Lines[k];
  str := 'UPDATE `users` SET `phone`=''' + Phone.Text + ''',`password`=''' +
    password + ''',' + '`family`=''' + familiya.Text + ''',`name`=''' +
    imya.Text + ''',`soname`=''' + otchestvo.Text + ''',`city`=''' + City.Text +
    ''',`company`=''' + Kompaniya.Text + ''',' + '`street`=''' + Ulica.Text +
    ''',`home`=''' + dom.Text + ''',`cabinet`=''' + korpus.Text +
    ''',`office`=''' + ofice.Text + ''',' +
  // '`ogrn`='''+ogrn.Text+''',`cemail`='''+kontemail.Text+''',`addi`='''+addi_str+''',`additional`='''+additionals+''' WHERE `email`='''+login+'''';
    '`ogrn`=''' + ogrn.Text + ''',`cemail`=''' + KontEmail.Text + ''',`addi`='''
    + addi_str + ''' WHERE `email`=''' + login + ''' OR `phone`=''' +
    login + '''';
  HideMemo.Lines.Add(str);
  ZQuery1.SQL := HideMemo.Lines;
  ZQuery1.ExecSQL;

  if newprodbool then
  begin
    ZQuery1.SQL.Text := 'INSERT INTO `product`(`userid`,`durl`) VALUES' + ' ('''
      + id_user + ''', ''' + code + ''')';
    ZQuery1.ExecSQL;
    newprodbool := false;
  end;

  str := 'SELECT `durl` FROM `product` WHERE `userid`=''' + id_user + '''';
  ZQuery1.SQL.Text := str;
  ZQuery1.Active := true;
  CodeName.Clear;
  While not ZQuery1.EoF do
  begin
    CodeName.Items.Add(ZQuery1.FieldByName('durl').AsString);
    ZQuery1.next;
  end;

  CodeName.ItemIndex := CodeName.Items.Count - 1;
  { str := 'SELECT 1 FROM `product` WHERE `durl`='''+Code+''' LIMIT 1';
    ZQuery1.SQL.Text := str;
    ZQuery1.Active := true;
    if ZQuery1.FieldByName('1').AsString = '1' then
    begin
    str := 'SELECT `userid` FROM `product` WHERE `durl`='''+Code+''' LIMIT 1';
    ZQuery1.SQL.Text := str;
    ZQuery1.Active := true;
    if ZQuery1.FieldByName('userid').AsString = id_user then
    begin
    ZQuery1.SQL.Text := 'UPDATE `product` SET ' +
    '`name`='''+PNameMemo.Lines[0]+''', `cost`='''+PCostEdit.Text+''', `offer`='''+POfferMemo.Lines[0]+''', `offer2`='''+POffer2Memo.Lines[0]+''',' +
    ' `back`='''+PURLBackEdit.Text+''', `desc`='''+PNameMemo.Lines[0]+''', `videourl`='''+PURLmainEdit.Text+''', `count`='''+PColEdit.Text+''',' +
    ' `logo`=''logo.png'' WHERE `userid`='''+id_user+''' AND `durl`='''+Code+'''';
    ZQuery1.ExecSQL;
    end
    else
    begin
    err := 'Данное имя уже используется.';
    ShowMessage('Введите другое название проекта.'+#13#10+err);
    end;
    end
    else
    begin
    ZQuery1.SQL.Text := 'INSERT INTO `product`(`userid`,`durl`,`name`,`cost`,`offer`,`offer2`,`back`,`desc`,`videourl`,`count`,`logo`) VALUES' +
    ' ('''+id_user+''', '''+Code+''', '''+PNameMemo.Lines[0]+''', '''+PCostEdit.Text+''', '''+POfferMemo.Lines[0]+''', '''+POffer2Memo.Lines[0]+''',' +
    ' '''+PURLBackEdit.Text+''', '''+PNameMemo.Lines[0]+''', '''+PURLmainEdit.Text+''', '''+PColEdit.Text+''', ''logo.png'')';
    ZQuery1.ExecSQL;
    end; }
end;

procedure TForm1.SellPhraseMemoChange(Sender: TObject);
begin
  if SellPhraseMemo.Lines.Count > 2 then
    ThreeNext.Visible := true;
end;

procedure TForm1.SellPhraseMemoDblClick(Sender: TObject);
var
  stri: string;
begin
  stri := 'https://direct.yandex.ru/search/?regions=' + regions + '&text=' +
    SellPhraseMemo.Lines[SellPhraseMemo.CaretPos.Y];
  ShellExecute(0, 'open', PWideChar(WideString(stri)), nil, nil, SW_SHOW);
end;

procedure TForm1.SettingsMouseDown(Sender: TObject; Button: TMouseButton;
  Shift: TShiftState; X, Y: integer);
const
  SC_DragMove = $F012;
begin
  ReleaseCapture;
  (Sender as TPanel).Parent.Perform(WM_SysCommand, SC_DragMove, 0);
end;

procedure TForm1.SettingsPNGClick(Sender: TObject);
var
  dobbools, formlistclear, clearchislo, fastclear, Otsev: string;
begin
  if SettingsP.Visible then
  begin
    SettingsP.Visible := false;
    LoadPNGfromRes(SettingsPNG, 'Set_PNG');

    if OtsevC.Checked then
    begin
      Otsev := '1';
    end
    else
    begin
      Otsev := '0';
    end;

    if dobbool then
    begin
      dobbools := '1';
    end
    else
    begin
      dobbools := '0';
    end;

    if FormListClearC.Checked then
    begin
      formlistclear := '1';
    end
    else
    begin
      formlistclear := '0';
    end;

    if ClearChisloC.Checked then
    begin
      clearchislo := '1';
    end
    else
    begin
      clearchislo := '0';
    end;

    if FastClearCh.Checked then
    begin
      fastclear := '1';
    end
    else
    begin
      fastclear := '0';
    end;

    ZConnection1.Connected := false;
    ZConnection1.Connected := true;
    ZQuery1.SQL.Text := 'UPDATE `product` SET `OtsevC`=''' + Otsev +
      ''', `OtsevE`=''' + OtsevE.Text + ''', `SovE`=''' + SovE.Text +
      ''', `DlSovE`=''' + DlSovE.Text + ''', `MinDlSlovE`=''' + MinDlSlovE.Text
      + ''', `ProcClearE`=''' + ProcClearE.Text + ''', `FormListClearC`=''' +
      formlistclear + ''', `ClearChisloC`=''' + clearchislo +
      ''', `FastClearCh`=''' + fastclear + ''' WHERE `id`=''' + id_prod + '''';
    ZQuery1.ExecSQL; { }
  end
  else
  begin
    ObjShow(SettingsP);
  end;
end;

procedure TForm1.SettingsPNGMouseEnter(Sender: TObject);
begin
  LoadPNGfromRes(SettingsPNG, 'Set2_PNG');
  ObjShow(PreKeyHelpP);
  PreKeyHelpP.Left := eyePNG.Left;
  PreKeyHelpP.Top := MinimizeB.Top + MinimizeB.Height + 10;
  PreKeyHelp.Text := 'Отображает форму настроек работы Директолог плюс';
end;

procedure TForm1.SettingsPNGMouseLeave(Sender: TObject);
begin
  if SettingsP.Visible = false then
  begin
    LoadPNGfromRes(SettingsPNG, 'Set_PNG');
  end;
  PreKeyHelpP.Visible := false;
end;

procedure TForm1.SiteListClick(Sender: TObject);
var
  ClipBoard: TClipboard;
begin
  if SiteList.Lines.Strings[SiteList.CaretPos.Y] <> '' then
  begin
    ClipBoard := TClipboard.Create;
    ClipBoard.SetTextBuf
      (PWideChar(Pwidestring(SiteList.Lines.Strings[SiteList.CaretPos.Y])));
  end;
end;

procedure TForm1.SiteListDblClick(Sender: TObject);
var
  stri: string;
begin
  if RekMemo.Lines.Strings[SiteList.CaretPos.Y] <> '' then
  begin
    stri := RekMemo.Lines[SiteList.CaretPos.Y];
    ShellExecute(0, 'open', PWideChar(WideString(stri)), nil, nil, SW_SHOW);
  end;
end;

procedure TForm1.SiteListKeyPress(Sender: TObject; var Key: Char);
begin
  if Key = #13 then
  begin
    ZagMemo.Lines.Add('');
    AdsMemo.Lines.Add('');
    RekMemo.Lines.Add('');
    SiteList.Lines.Add('');
    SiteList.SelStart := length(SiteList.Text) - 2;
    SiteList.SelLength := 0;
    Key := #0;
  end;
  if Key = #8 then
  begin
    if ZagMemo.Lines.Strings[SiteList.CaretPos.Y] <> '' then
    begin
      ZagMemo.Lines.Delete(SiteList.CaretPos.Y);
      AdsMemo.Lines.Delete(SiteList.CaretPos.Y);
      RekMemo.Lines.Delete(SiteList.CaretPos.Y);
      SiteList.Lines.Delete(SiteList.CaretPos.Y);
      Key := #0;
    end;
  end;

end;

procedure TForm1.SiteListMouseLeave(Sender: TObject);
begin
  AdsPreview.Visible := false;
end;

procedure TForm1.SiteListMouseMove(Sender: TObject; Shift: TShiftState;
  X, Y: integer);
begin
  ObjShow(AdsPreview);
  AdsZag.Caption := ZagMemo.Lines[SiteList.CaretPos.Y];
  AdsUrl.Caption := SiteList.Lines[SiteList.CaretPos.Y] + '/';
  AdsUrlDesc.Left := AdsUrl.Left + AdsUrl.Width + 10;
  AdsText.Caption := AdsMemo.Lines[SiteList.CaretPos.Y];
  AdsZag2.Caption := '';
  AdsZag2.Left := AdsZag.Left + AdsZag.Width + 10;
  AdsFast2.Left := AdsFast1.Left + AdsFast1.Width + 10;
  AdsFast3.Left := AdsFast2.Left + AdsFast2.Width + 10;
  AdsFast4.Left := AdsFast3.Left + AdsFast3.Width + 10;
end;

procedure TForm1.soundPNGClick(Sender: TObject);
begin
  if soundbool then
  begin
    LoadPNGfromRes(soundPNG, 'soundoff_PNG');
    soundbool := false;
    waveOutSetVolume(0, $0000);
  end
  else
  begin
    LoadPNGfromRes(soundPNG, 'sound_PNG');
    soundbool := true;
    waveOutSetVolume(0, $FFFF);
  end;
end;

procedure TForm1.soundPNGMouseEnter(Sender: TObject);
begin
  ObjShow(PreKeyHelpP);
  PreKeyHelpP.Left := eyePNG.Left;
  PreKeyHelpP.Top := MinimizeB.Top + MinimizeB.Height + 10;
  if soundbool then
  begin
    LoadPNGfromRes(soundPNG, 'sound_PNG');
    PreKeyHelp.Text := 'Выключает аудио подсказку';
    soundPNG.Hint := 'Выключить звуковую подсказку';
  end
  else
  begin
    LoadPNGfromRes(soundPNG, 'soundoff_PNG');
    PreKeyHelp.Text := 'Включает аудио подсказку';
    soundPNG.Hint := 'Включить звуковую подсказку';
  end;
end;

procedure TForm1.soundPNGMouseLeave(Sender: TObject);
begin
  if soundbool then
  begin
    LoadPNGfromRes(soundPNG, 'sound2_PNG');
  end
  else
  begin
    LoadPNGfromRes(soundPNG, 'soundoff2_PNG');
  end;
  PreKeyHelpP.Visible := false;
end;

procedure TForm1.SovEChange(Sender: TObject);
begin
  if SovE.Text <> '' then
    SovT.Position := strtoint(SovE.Text)
  else
  begin
    SovT.Position := 1;
    SovE.SelStart := length(SovE.Text);
    SovE.SelLength := 0;
  end;
end;

procedure TForm1.SovEKeyPress(Sender: TObject; var Key: Char);
begin
  case Key of
    #8, '0' .. '9':
    else
      Key := Chr(0);
  end;
end;

procedure TForm1.SovTChange(Sender: TObject);
begin
  SovE.Text := inttostr(SovT.Position);
end;

procedure TForm1.RefreshCounterClick(Sender: TObject);
begin
  ZConnection1.Connected := false;
  ZConnection1.Connected := true;
  ZQuery1.SQL.Text := 'UPDATE `product` SET `rsy_i`=''' + inttostr(0) +
    ''', `lvl_start`=''' + inttostr(0) + ''', `lvl_end`=''' + inttostr(0) +
    ''', `SP_i`=''' + inttostr(0) + ''', `DoST`=''' + inttostr(0) +
    ''', `word_i`=''' + inttostr(0) + ''', `adsright_i`=''' + inttostr(0) +
    ''', `k_word`=''' + inttostr(0) + ''', `pages_i`=''' + inttostr(0) +
    ''', `dobbool`=''' + inttostr(0) + ''', `mca_i`=''' + inttostr(0) +
    ''', `mcm_i`=''' + inttostr(0) + ''', `sin_i`=''' + inttostr(0) +
    ''' WHERE `id`=''' + id_prod + '''';
  ZQuery1.ExecSQL; { }
  rsy_i := 0;
  lvl_start := 0;
  lvl_end := 0;
  SP_i := 0;
  if lvlentry = 1 then
    DoST.ItemIndex := 3
  else
    DoST.ItemIndex := 0;
  word_i := 0;
  adsright_i := 0;
  k_word := 0;
  pages_i := 0;
  dobbool := false;
  mca_i := 0;
  mcm_i := 0;
  i_sin := 0;
end;

procedure TForm1.DefoltSetClick(Sender: TObject);
begin
  ZConnection1.Connected := false;
  ZConnection1.Connected := true;
  ZQuery1.SQL.Text := 'UPDATE `product` SET `OtsevC`=''' + inttostr(1) +
    ''', `OtsevE`=''' + inttostr(4) + ''', `SovE`=''' + inttostr(66) +
    ''', `DlSovE`=''' + inttostr(79) + ''', `MinDlSlovE`=''' + inttostr(4) +
    ''', `ProcClearE`=''' + inttostr(10) + ''', `FormListClearC`=''' +
    inttostr(0) + ''', `ClearChisloC`=''' + inttostr(1) + ''', `FastClearCh`='''
    + inttostr(0) + ''' WHERE `id`=''' + id_prod + '''';
  ZQuery1.ExecSQL; { }
  OtsevE.Text := '4';
  SovE.Text := '66';
  OtsevC.Checked := true;
  DlSovE.Text := '79';
  MinDlSlovE.Text := '4';
  ProcClearE.Text := '10';
  FormListClearC.Checked := false;
  ClearChisloC.Checked := true;
  FastClearCh.Checked := false;
end;

procedure TForm1.SrChekChange(Sender: TObject);
begin
  if (SrChek.Text <> '') and (marzha.Text <> '') and (prmarzhi.Text <> '') and
    (k1.Text <> '') and (k2.Text <> '') and (Lids.Text <> '') then
  begin
    SrCheckF := strtofloat(SrChek.Text);
    MarzhaF := strtofloat(marzha.Text);
    K3F := strtofloat(prmarzhi.Text);
    K1F := strtofloat(k1.Text);
    K2F := strtofloat(k2.Text);
    StavkaF := SrCheckF * MarzhaF * K3F * K1F * K2F * koefrazb;
    Stavka.Caption := floattostr(StavkaF);

    LidsF := strtofloat(Lids.Text);
    ClicksF := LidsF / K1F / K2F;
    clicks.Caption := floattostr(ClicksF);
    clicksperdayF := Ceil(ClicksF / 30);
    clicksperday.Caption := floattostr(clicksperdayF);
    BudgetF := StavkaF * ClicksF;
    BudgetperdayF := StavkaF * clicksperdayF;
    BudgetPerDay.Caption := floattostr(BudgetperdayF);
    Budget.Caption := floattostr(BudgetF);
    ProgDohodF := SrCheckF * LidsF * MarzhaF - BudgetF;
    ProgDohod.Caption := floattostr(ProgDohodF);
  end;
end;

procedure TForm1.SrChekEnter(Sender: TObject);
begin
  DecimalSeparator := ',';
end;

procedure TForm1.SrChekKeyPress(Sender: TObject; var Key: Char);
begin
  case Key of
    #8, '0' .. '9':
      ;

    '.', ',':
      begin
        if Key <> DecimalSeparator then
          Key := DecimalSeparator;
        if AnsiPos(DecimalSeparator, SrChek.Text) <> 0 then
          Key := Chr(0);
      end;
    '-':
      if length(SrChek.Text) <> 0 then
        Key := Chr(0);
    #13:
      marzha.SetFocus;
  else
    Key := Chr(0);
  end;
end;

procedure TForm1.StavkaCloseClick(Sender: TObject);
begin
  ZConnection1.Connected := false;
  ZConnection1.Connected := true;
  SheetList.Enabled := true;
  ZQuery1.SQL.Text := 'UPDATE `product` SET `SrChek`=''' + SrChek.Text +
    ''', `Marzha`=''' + marzha.Text + ''', `k1`=''' + k1.Text + ''', `k2`=''' +
    k2.Text + ''', `PrMarzhi`=''' + prmarzhi.Text + ''', `kolzay`=''' +
    Lids.Text + ''' WHERE `id`=''' + id_prod + '''';
  ZQuery1.ExecSQL;
  // ------------------------------------------------------------------------------
  StavkaP.Visible := false;
  ObjShow(AdsControlP);
  LoadPNGfromRes(stavkaPNG, 'stavka2_PNG');
  stavkabool := true;
  if (ctrbool) and (stavkabool) and (priblbool) then
  begin
    nextbool := true;
    nextPNG.Enabled := true;
    LoadPNGfromRes(nextPNG, 'next_PNG');
  end;
end;

procedure TForm1.StavkaHelpMouseEnter(Sender: TObject);
begin
  PreKeyHelp.Clear;
  PreKeyHelp.Lines.Strings[0] :=
    'Назначаемая ставка на рекламную кампанию - это цена клика, которая экономически эффективна для рекламы Вашего товара/услуги.'
    + 'Рассчитывается по формуле:' + #13#10 +
    'Средний чек * Маржа * Конверсия сайта * Конверсия в продажу * Привлечение'
    + #13#10 +
    'Средний чек = сумма "вилки цен" деленная на количество товаров/услуг.' +
    #13#10 + 'Маржа = Процент чистой прибыли с продажи' + #13#10 +
    'Конверсия сайта = Процент посетителей сайта оставивших заявку от общему количеству посетителей (для начала ~0.05 = 5%)'
    + #13#10 +
    'Конверсия сайта = Процент удачных продаж от общего количества заявок (для начала ~0.1 = 10%)'
    + #13#10 +
    'Привлечение = Уровень жадности предпринимателя :) Сколько процентов Вы готовы отдавать с продажи 1 ед. товара/услуг';
  ObjShow(PreKeyHelpP);
end;

procedure TForm1.StavkaHelpMouseLeave(Sender: TObject);
begin
  PreKeyHelpP.Visible := false;
end;

procedure TForm1.stavkaPNGClick(Sender: TObject);
var
  stri: string;
begin
  AdsControlP.Visible := false;
  SheetList.Enabled := false;
  ObjShow(StavkaP);
  LoadPNGfromRes(SrChekPNG, 'srchek_PNG');
  LoadPNGfromRes(MarzhaPNG, 'marzha_PNG');
  LoadPNGfromRes(K1PNG, 'k1_PNG');
  LoadPNGfromRes(K2PNG, 'k2_PNG');
  LoadPNGfromRes(PrMarzhiPNG, 'prmarzhi_PNG');
  LoadPNGfromRes(LidsPNG, 'lids2_PNG');
  LoadPNGfromRes(ClickSPNG, 'click_PNG');
  LoadPNGfromRes(DohodSPNG, 'dohods_PNG');
  LoadPNGfromRes(BudgetSPNG, 'budgets_PNG');
  LoadPNGfromRes(clicksSPNG, 'dblclick_PNG');
  LoadPNGfromRes(BudgetPerDaySPNG, 'budgetperday_PNG');
  LoadPNGfromRes(clicksperdaySPNG, 'clicksperday_PNG');

  ZConnection1.Connected := false;
  ZConnection1.Connected := true;

  stri := 'SELECT * FROM `product` WHERE `id`=''' + id_prod + '''';
  ZQuery1.SQL.Text := stri;
  ZQuery1.Active := true;
  SrChek.Text := ZQuery1.FieldByName('SrChek').AsString;
  marzha.Text := ZQuery1.FieldByName('Marzha').AsString;
  k1.Text := ZQuery1.FieldByName('k1').AsString;
  k2.Text := ZQuery1.FieldByName('k2').AsString;
  prmarzhi.Text := ZQuery1.FieldByName('PrMarzhi').AsString;
  Lids.Text := ZQuery1.FieldByName('kolzay').AsString;
  if (SrChek.Text <> '') and (marzha.Text <> '') and (prmarzhi.Text <> '') and
    (k1.Text <> '') and (k2.Text <> '') and (strtofloat(k1.Text) > 0) and
    (strtofloat(k2.Text) > 0) and (Lids.Text <> '') then
  begin
    SrCheckF := strtofloat(SrChek.Text);
    MarzhaF := strtofloat(marzha.Text);
    K3F := strtofloat(prmarzhi.Text);
    K1F := RoundTo(strtofloat(k1.Text), -2);
    K2F := RoundTo(strtofloat(k2.Text), -2);
    StavkaF := RoundTo(SrCheckF * MarzhaF * K3F * K1F * K2F * koefrazb, -2);
    Stavka.Caption := floattostr(StavkaF);

    LidsF := strtofloat(Lids.Text);
    ClicksF := RoundTo(LidsF / K1F / K2F, -2);
    clicks.Caption := floattostr(ClicksF);
    clicksperdayF := Ceil(ClicksF / 30);
    clicksperday.Caption := floattostr(clicksperdayF);
    BudgetF := RoundTo(StavkaF * ClicksF, -2);
    BudgetperdayF := RoundTo(StavkaF * clicksperdayF, -2);
    BudgetPerDay.Caption := floattostr(BudgetperdayF);
    Budget.Caption := floattostr(BudgetF);
    ProgDohodF := RoundTo(SrCheckF * LidsF * MarzhaF - BudgetF, -2);
    ProgDohod.Caption := floattostr(ProgDohodF);
  end;
end;

procedure TForm1.ExitBClick(Sender: TObject);
begin
  closebool := true;
  Application.Terminate;
end;

procedure TForm1.ExitBMouseEnter(Sender: TObject);
begin
  ExitB.Color := $004D48FF;
  ObjShow(PreKeyHelpP);
  PreKeyHelpP.Left := Screen.Width - PreKeyHelpP.Width - 10;
  PreKeyHelpP.Top := MinimizeB.Top + MinimizeB.Height + 10;
  PreKeyHelp.Text :=
    'Закрывает Директолог+, можно продолжить работу при следующем входе';
end;

procedure TForm1.ExitBMouseLeave(Sender: TObject);
begin
  ExitB.Color := clWhite;
  PreKeyHelpP.Visible := false;
end;

procedure TForm1.eyePNGClick(Sender: TObject);
begin
  if browbool then
  begin
    if threebool = true then
    begin
      ThreeTimer.Enabled := true;
      threebool := false;
    end;
    browbool := false
  end
  else
  begin
    if ThreeTimer.Enabled = true then
    begin
      ThreeTimer.Enabled := false;
      threebool := true;
    end;
    browbool := true;
  end;

end;

procedure TForm1.eyePNGDblClick(Sender: TObject);
begin
  if BRReg.Visible = true then
  begin
    BRReg.Visible := false;
    ObjShow(AdsBR);
  end
  else
  begin
    AdsBR.Visible := false;
    ObjShow(BRReg);
  end;
end;

procedure TForm1.eyePNGMouseEnter(Sender: TObject);
begin
  eye.Font.Color := clBlack;
  LoadPNGfromRes(eyePNG, 'eye_PNG');
  ObjShow(BrowserP);
  ObjShow(PreKeyHelpP);
  PreKeyHelpP.Left := eyePNG.Left;
  PreKeyHelpP.Top := MinimizeB.Top + MinimizeB.Height + 10;
  PreKeyHelp.Text := 'Показывает выполнение действий на данный момент на сайте';
end;

procedure TForm1.eyePNGMouseLeave(Sender: TObject);
begin
  if not browbool then
  begin
    eye.Font.Color := clSilver;
    LoadPNGfromRes(eyePNG, 'eye2_PNG');
  end;
  if not browbool then
    BrowserP.Visible := false;

  PreKeyHelpP.Visible := false;
end;

procedure TForm1.familiyaChange(Sender: TObject);
begin
  if next_i = 15 then
    changebool := true;
end;

procedure TForm1.FormActivate(Sender: TObject);
begin
  if FileExists(ExtractfilePath(Application.ExeName) + 'login.txt') then
  begin
    HideMemo.Clear;
    HideMemo.Lines.LoadFromFile(ExtractfilePath(Application.ExeName) +
      'login.txt');
    LoginE.Text := HideMemo.Lines.Strings[0];
    PassE.Text := HideMemo.Lines.Strings[1];
  end;
  LoadPNGfromRes(radarPNG, 'radar_PNG');
  LoadPNGfromRes(GlobalPNG, 'global_PNG');
  LoadPNGfromRes(DoSetB, 'Set_PNG');
  LoadPNGfromRes(InfoI, 'PngImage_4');
  LoadPNGfromRes(AimPNG, 'Aim_PNG');
  LoadPNGfromRes(ClickPNG, 'Click_PNG');
  LoadPNGfromRes(DblClickPNG, 'dblclick_PNG');
  LoadPNGfromRes(eyePNG, 'eye2_PNG');
  LoadPNGfromRes(Kbrd1PNG, 'q_PNG');
  LoadPNGfromRes(Kbrd2PNG, 'w_PNG');
  LoadPNGfromRes(Kbrd3PNG, 'e_PNG');
  LoadPNGfromRes(soundPNG, 'sound2_PNG');
  LoadPNGfromRes(stavkaPNG, 'stavka_PNG');
  LoadPNGfromRes(PriblPNG, 'pribl_PNG');
  LoadPNGfromRes(CtrPNG, 'ctr_PNG');
  LoadPNGfromRes(nextPNG, 'next2_PNG');
  LoadPNGfromRes(keysPNG, 'keys_PNG');
  LoadPNGfromRes(FinishPNG, 'finish_PNG');
  LoadPNGfromRes(clearPNG, 'clear_PNG');
  LoadPNGfromRes(SettingsPNG, 'Set_PNG');
  LoadPNGfromRes(HideMinusI, 'Minus2_PNG');
  LoadPNGfromRes(HideKeyI, 'Key2_PNG');
  LoadPNGfromRes(HideAdsI, 'Ads_PNG');
  LoadPNGfromRes(HidePreKeyI, 'PreKey2_PNG');
  LoadPNGfromRes(Cold, 'cold2_PNG');
  LoadPNGfromRes(Hot, 'hot2_PNG');
  LoadPNGfromRes(Log, 'log_PNG');
  LoadPNGfromRes(Pas, 'pas_PNG');
  LoadPNGfromRes(proPNG, 'pro_PNG');
  LoadPNGfromRes(dataPNG, 'data_PNG');
  LoadPNGfromRes(CTAsetPNG, 'CTA_PNG');
  LoadPNGfromRes(UTPsetPNG, 'UTP_PNG');
  LoadPNGfromRes(TimeSlicePNG, 'timeslice_PNG');
  LoadPNGfromRes(CitySlicePNG, 'cityslice2_PNG');
  LoadPNGfromRes(proxyPNG, 'proxy2_PNG');
end;

procedure TForm1.WMDropFiles(var Msg: TWMDropFiles);
var
  { DropH: HDROP;               // дескриптор операции перетаскивания
    DroppedFileCount: Integer;  // количество переданных файлов
    FileNameLength: Integer;    // длина имени файла
    FileName: string;           // буфер, принимающий имя файла
    I: Integer;                 // итератор для прохода по списку
    DropPoint: TPoint; }         // структура с координатами операции Drop
  CFileName: array [0 .. MAX_PATH] of Char; // переменная, хранящаяимяфайла
begin
  inherited;
  // Сохраняем дескриптор
  { DropH := Msg.Drop;
    try
    // Получаем количество переданных файлов
    DroppedFileCount := DragQueryFile(DropH, $FFFFFFFF, nil, 0);
    // Получаем имя каждого файла и обрабатываем его
    for I := 0 to Pred(DroppedFileCount) do
    begin
    // получаем размер буфера
    FileNameLength := DragQueryFile(DropH, I, nil, 0);
    // создаем буфер, который может принять в себя строку с именем файла
    // (Delphi добавляет терминирующий ноль автоматически в конец строки)
    SetLength(FileName, FileNameLength);
    // получаем имя файла
    DragQueryFile(DropH, I, PChar(FileName), FileNameLength + 1);
    // что-то делаем с данным именем (все зависит от вашей фантазии)
    // ... код обработки пишем здесь
    end;
    // Опционально: получаем координаты, по которым произошла операция Drop
    DragQueryPoint(DropH, DropPoint);
    // ... что-то делаем с данными координатами здесь
    finally
    // Финализация - разрушаем дескриптор
    // не используйте DropH после выполнения данного кода...
    DragFinish(DropH);
    end;
    // Говорим о том, что сообщение обработано
    Msg.Result := 0; }
  try
    If DragQueryFile(Msg.Drop, 0, CFileName, MAX_PATH) > 0 then
    begin
      if (ExtractFileExt(CFileName) = '.jpg') or
        (ExtractFileExt(CFileName) = '.jpeg') or
        (ExtractFileExt(CFileName) = '.png') then
      begin
        Image1.Picture.LoadFromFile(CFileName);
        imagename := ExtractFileName(CFileName);
        ext := ExtractFileExt(CFileName);
        Image1Click(Image1);
      end;
    end;
  finally
    DragFinish(Msg.Drop);
  end;
end;

function LoadFileMemo(s: string; M: TStrings): boolean;
begin
  if FileExists(ExtractfilePath(Application.ExeName) + s) then
  begin
    M.LoadFromFile(ExtractfilePath(Application.ExeName) + s);
    LoadFileMemo := true;
  end
  else
    LoadFileMemo := false;
end;

procedure TForm1.FormCreate(Sender: TObject);
var
  err: string;
begin
  DragAcceptFiles(Self.Handle, true);
  if not LoadFileMemo('minus/numbers.txt', Numbers.Lines) then
    err := 'Список чисел отстутствует' + #13#10;
  if not LoadFileMemo('minus/minuss.txt', Minuss.Lines) then
    err := 'Список общих минус-слов отстутствует' + #13#10;

  iSp := 0;
  SP_i := 0;
  rsy_i := 0;
  word_i := 0;
  k_word := 0;
  adsright_i := 0;
  ColRowsText := 0;
  strk := 1;
  stlb := 1;
  mca_i := 0;
  mcm_i := 0;
  i_sin := 0;
  rpls_col_count := 2;
  proxy_n := 0;
  camp_i := 0;
  word_i := 0;
  stage := 0;
  pages_i := 1;
  koefrazb := 1.5;
  next_i := 0;
  iTimer := 0;
  DelayAdd := 30;

  maxdlz1 := 35;
  maxdlz2 := 30;
  maxdltxt := 81;
  AdsMaxLen := 4096;
  maxgroup := 1000;
  maxcamp := 1000;

  regions := '225';
  client := '';
  token := '';
  metrika := '';

  CountControl.Cells[0, 0] := 'кампании';
  CountControl.Cells[1, 0] := '1';
  CountControl.Cells[4, 0] := '0';

  Frst := TMemo.Create(Form1);
  Frst.Text := '';
  Frst.Parent := Form1;
  Frst.Visible := false;
  Scnd := TMemo.Create(Form1);
  Scnd.Text := '';
  Scnd.Parent := Form1;
  Scnd.Visible := false;

  ErrorLoadBool := false;
  rezhimautobool := true;
  closebool := false;
  dobbool := false;
  ClickLoadBool := false;
  newprodbool := true;
  Otsev := true;
  auto := false;
  first := true;
  FirstT := true;
  rsybool := false;
  nextbool := true; // тест
  ctrbool := false;
  stavkabool := false;
  changebool := false;
  priblbool := false;
  soundbool := true;
  onebool := true;
  FindProxy := true;
  proxybool := false;
  candocamp := false;
  loaded := false;

  utpbool := false;
  ctabool := false;
  citybool := false;
  timebool := false;

  browbool := false;
  threebool := false;
  fastclear := false;

  if not IsOLEObjectInstalled('Excel.Application') then
    ShowMessage
      ('MS Excel не установлен! Для получения всех возможностей установите MS Excel.')
    // панель с чекбоксом больше не показывать вместо ШоуМеседж
  else
  begin
    Excel := CreateOleObject('Excel.Application');
    Excel.DisplayAlerts := false;
    try
      begin
        Excel.Quit;
        Excel := Unassigned;
      end;
    except
    end;
  end;

  BrowserP.Left := 0;
  BrowserP.Top := header.Height;
  BrowserP.Width := Screen.Width;
  BrowserP.Height := Screen.Height - 50 - HintP.Height - BrowserP.Top;
  // ------------------------------------------------------------------------------

  ObjShow(LoadSheet);
  ControlPanel.Top := 0;
  ControlPanel.Left := Screen.Width - ControlPanel.Width;
  ObjShow(ControlPanel);
  HelpB.Left := 0;
  MinimizeB.Left := HelpB.Left + 2 + HelpB.Width;
  ExitB.Left := MinimizeB.Left + 2 + MinimizeB.Width;
  ExitB.Top := 0;
  MinimizeB.Top := 0;
  HelpB.Top := 0;
  ExitB.BringToFront;
  MinimizeB.BringToFront;
  HelpB.BringToFront;
  SheetList.Width := 432;
  ObjCentredW(SheetList, 0);
  SheetList.Top := 0;
  Sheet1.Left := 0;
  Sheet2.Left := Sheet1.Left + Sheet1.Width + 12;
  Sheet3.Left := Sheet2.Left + Sheet2.Width + 12;
  Sheet4.Left := Sheet3.Left + Sheet3.Width + 12;
  Sheet5.Left := Sheet4.Left + Sheet4.Width + 12;
  Sheet6.Left := Sheet5.Left + Sheet5.Width + 12;
  Sheet7.Left := Sheet6.Left + Sheet6.Width + 12;
  // ------------------------------------------------------------------------------
  LoginE.Font.Color := $00838383;
  BRReg.Load('http://directolog-plus.ru/directologplus/loader.php');
  // BRReg.Load('https://metrika.yandex.ru/46085613?tab=code');
  Form1.WindowState := wsMaximized;
  ObjCentred(LoginP, 0, 0);
  // ------------------------------------------------------------------------------
  ObjCentred(Input, 0, 0);
  InfoL.Caption := Edit.TextHint;
  HelpInput.Caption := 'Пример: Москва';
  // ------------------------------------------------------------------------------
  ObjCentred(ThreeInput, 0, 0);
  HelpZoneP.Left := ThreeInput.Left;
  HelpZoneP.Top := ThreeInput.Top - HelpZoneP.Height + 6;
  // ------------------------------------------------------------------------------
  ObjShow(footer);
  // ------------------------------------------------------------------------------
  PreKeyLoad.Height := 190;
  ObjCentred(PreKeyLoad, 0, 0);
  ObjCentred(SettingsP, 0, 0);
  // ------------------------------------------------------------------------------
  ObjCentred(KeysC, 0, 0);
  ClearinP.Width := PreKeyLoad.Width;
  ClearinP.Height := PreKeyLoad.Height;
  ObjCentred(ClearinP, 0, 0);
  ObjCentred(HandClearP, 0, 2 * (ClearinP.Height + 60));
  ObjCentred(AdsManager, 0, 0);
  ObjCentred(AdsSet, 0, 0);
  ObjCentred(StavkaP, 0, 0);
  ObjCentred(AdsControlP, 0, 0);
  // ------------------------------------------------------------------------------
  ObjCentred(DoRKP, 0, 0);
  ObjCentred(ReplaceP, 0, 0);
  HideP.Width := HideOnOff.Width;
  // ------------------------------------------------------------------------------
  ObjCentred(TimeSetP, 0, 0);
  ObjCentred(CitySetP, 0, 0);
  ObjCentred(CTASetP, 0, 0);
  ObjCentred(UTPSetP, 0, 0);
  ObjCentred(FinishControlP, 0, 0);
  ObjCentred(GroupSelectorP, 0, 0);
  ObjCentred(GroupSelectorZP, 0, 0);
  ObjCentred(ReplacerZTZP, 0, 0);
  ObjCentred(WorkTimesP, 0, 0);

  // ------------------------------------------------------------------------------
  err := '';
  if not LoadFileMemo('Settings/time.txt', Times.Lines) then
    err := 'Список времен показа отстутствует' + #13#10;
  if not LoadFileMemo('Settings/daysfull.txt', Days.Lines) then
    err := 'Список дней показа отстутствует' + #13#10;
  if not LoadFileMemo('Settings/month.txt', Months.Lines) then
    err := 'Список месяцев показа отстутствует' + #13#10;
  if not LoadFileMemo('Settings/cities.txt', Cities.Lines) then
    err := 'Список городов отстутствует' + #13#10;
  if not LoadFileMemo('Settings/acts.txt', UTPs.Lines) then
    err := 'Список уникальных торговых предложений отстутствует' + #13#10;
  if not LoadFileMemo('Settings/CTAs.txt', CTAs.Lines) then
    err := 'Список призывов к действию отстутствует' + #13#10;
  if not LoadFileMemo('Settings/days.txt', ComboBox1.Items) then
    err := 'Список коротких записей дней отстутствует';
  if not LoadFileMemo('Settings/days.txt', ComboBox2.Items) then
    err := 'Список коротких записей дней отстутствует';
  if not LoadFileMemo('Settings/time.txt', ComboBox3.Items) then
    err := 'Список коротких записей дней отстутствует';
  if not LoadFileMemo('Settings/time.txt', ComboBox4.Items) then
    err := 'Список времен показа отстутствует';

  if err <> '' then
  begin
    ShowMessage('Переустановите программу!' + err);
    ShellExecute(0, 'open',
      'http://directolog-plus.ru/directologplus/loader.php', nil, nil, SW_SHOW);
  end;

  ObjCentredW(PreKeyHelp, 0);
  PreKeyHelpP.Top := header.Height + 6;
  ObjCentredW(AdsPreview, 0);
  AdsPreview.Top := header.Height + 6;

  DoST.ItemIndex := 0;

  if FileExists(ExtractfilePath(Application.ExeName) + '/Sound/1.mp3') then
    MediaPlayer1.FileName := ExtractfilePath(Application.ExeName) +
      '/Sound/1.mp3'; { }
end;

procedure TForm1.FormDestroy(Sender: TObject);
begin
  DragAcceptFiles(Self.Handle, false);
  if code <> '' then
  begin
    SaveData(code);
  end;
  Times.Lines.SaveToFile(ExtractfilePath(Application.ExeName) +
    'Settings/times.txt');
  Days.Lines.SaveToFile(ExtractfilePath(Application.ExeName) +
    'Settings/daysfull.txt');
  Months.Lines.SaveToFile(ExtractfilePath(Application.ExeName) +
    'Settings/month.txt');
  UTPs.Lines.SaveToFile(ExtractfilePath(Application.ExeName) +
    'settings/acts.txt');
  CTAs.Lines.SaveToFile(ExtractfilePath(Application.ExeName) +
    'settings/CTAs.txt');
  HideMemo.Clear;
  HideMemo.Lines.Add(login);
  HideMemo.Lines.Add(password);
  HideMemo.Lines.SaveToFile(ExtractfilePath(Application.ExeName) + 'login.txt');
  HideMemo.Clear;
  HideMemo.Lines.Add(City.Text);
  HideMemo.Lines.Add(Ulica.Text);
  HideMemo.Lines.Add(dom.Text);
  HideMemo.Lines.Add(korpus.Text);
  HideMemo.Lines.Add(ofice.Text);
  HideMemo.Lines.Add(imya.Text);
  HideMemo.Lines.Add(familiya.Text);
  HideMemo.Lines.Add(otchestvo.Text);
  HideMemo.Lines.Add(Phone.Text);
  HideMemo.Lines.Add(KontEmail.Text);
  HideMemo.Lines.Add(Kompaniya.Text);
  HideMemo.Lines.Add(ogrn.Text);
  HideMemo.Lines.Add(CodeName.Text);
  HideMemo.Lines.SaveToFile(ExtractfilePath(Application.ExeName) +
    'Projects/info_' + login + '.txt'); // не исполью почему то...

  UrlFromProxy(AdsBR, 'https://ya.ru', '', ''); // отключаем прокси
  try // пробуем вырубить Excel
    begin
      Excel.Quit;
      Excel := Unassigned;
    end;
  except
  end;
  Application.Terminate;
end;

procedure TForm1.GetMetrikaTimer(Sender: TObject);
var
  CodeStr, href: string;
  // i: integer;
  b, c: boolean;
begin
  if iTimer = 1 then
  begin
    if Assigned(BRReg.Browser) and Assigned(BRReg.Browser.Mainframe) then
    begin
      CodeStr :=
        'var s=""; arr = $(".counters-list-table-item__site-link"); $.each(arr,function(index,value){ s = s + " " +  value.innerHTML; }); console.log("sites"+s);';
      BRReg.Browser.Mainframe.ExecuteJavaScript(CodeStr, 'about:blank', 0);
      i_metr := 0;
      b := false;
      c := false;
    end;
  end;
  if iTimer = 3 then
  begin
    href := AdsHref.Text;
    if i_metr < HideMemo.Lines.Count then
    begin
      // ShowMessage(inttostr(AnsiPos(HideMemo.Lines.Strings[i_metr], Copy(href, 8, href.length - 7))));
      if AnsiPos(HideMemo.Lines.Strings[i_metr],
        Copy(href, 8, href.length - 7)) > 0 then
      begin
        if Assigned(BRReg.Browser) and Assigned(BRReg.Browser.Mainframe) then
        begin
          CodeStr := 'var s=""; k = ' + inttostr(i_metr) +
            '; arr = $(".counters-list-table-item__counter-id"); $.each(arr,function(index,value){ if (index == k) {s = s + " " +  value.innerHTML;} }); console.log("metr"+s);';
          BRReg.Browser.Mainframe.ExecuteJavaScript(CodeStr, 'about:blank', 0);
        end;
        c := true;
        // ShowMessage('123');
        i_metr := HideMemo.Lines.Count;
        GetMetrika.Enabled := false;
      end
    end
    else
    begin
      b := true;
      if not c then
      begin
        ObjShow(BrowserP);
        BRReg.Load('https://metrika.yandex.ru/add');
        ShowMessage('Добавьте счётчик Яндекс.Метрики!');
        GetMetrika.Enabled := false;
      end;
    end;
  end;
  if (iTimer = 3) and (not b) then
  begin
    inc(i_metr);
  end
  else
  begin
    inc(iTimer);
    if iTimer = 4 then
    begin
      if b then
      begin
        GetMetrika.Enabled := false;
        Finality.Enabled := true;
      end;
    end;
  end;
end;

procedure TForm1.GlobalPNGClick(Sender: TObject);
var
  i: integer;
  PStr: PString;
begin
  if RegionsP.Visible then
  begin
    RegionsP.Visible := false;
    regions := '';
    if RegionsMI.Lines.Count = 0 then
      regions := '225'
    else
    begin
      for i := 0 to RegionsMI.Lines.Count - 1 do
        if regions = '' then
          regions := RegionsMI.Lines.Strings[i]
        else
          regions := regions + '%2C' + RegionsMI.Lines.Strings[i];
    end;
  end
  else
  begin
    ObjShow(RegionsP);
  end;
  if FirstT then
  begin
    RegionsM.Lines.LoadFromFile(ExtractfilePath(Application.ExeName) +
      'Settings/rn.txt');
    RegionsI.Lines.LoadFromFile(ExtractfilePath(Application.ExeName) +
      'Settings/ri.txt');
    for i := 0 to RegionsM.Lines.Count - 1 do
    begin
      TreeView1.Items.Add(nil, RegionsM.Lines.Strings[i]);
      PStr := TreeView1.Items[i].Data;
      if PStr = nil then
      begin
        New(PStr);
        TreeView1.Items[i].Data := PStr;
      end;
      PStr^ := RegionsI.Lines.Strings[i];
    end;
    FirstT := false;
  end;

end;

procedure TForm1.GlobalPNGMouseEnter(Sender: TObject);
begin
  LoadPNGfromRes(GlobalPNG, 'global2_PNG');
  ObjShow(PreKeyHelpP);
  PreKeyHelpP.Left := eyePNG.Left;
  PreKeyHelpP.Top := MinimizeB.Top + MinimizeB.Height + 10;
  PreKeyHelp.Text := 'Открывает форму выбора регионов показа объявлений';
end;

procedure TForm1.GlobalPNGMouseLeave(Sender: TObject);
begin
  if RegionsP.Visible = false then
  begin
    LoadPNGfromRes(GlobalPNG, 'global_PNG');
  end;
  PreKeyHelpP.Visible := false;
end;

procedure TForm1.GoClear2Click(Sender: TObject);
begin
  SheetList.Enabled := false;
  KeysC.Visible := false;
  ObjShow(ClearinP);
end;

procedure TForm1.GoClear2MouseEnter(Sender: TObject);
begin
  PreKeyHelp.Clear;
  PreKeyHelp.Lines.Strings[0] := 'Нажимая на кнопку "Очистить" ' +
    'в подготовленных ключах удалятся дубликаты, удалятся фразы содержащие минус-слова и будет проведена кросс-минусация. Всё это будет выполнено по нажатию кнопки "Минус-слова" в заголовке появляющегося списка справа.';
  ObjShow(PreKeyHelpP);
end;

procedure TForm1.GoClear2MouseLeave(Sender: TObject);
begin
  PreKeyHelpP.Visible := false;
end;

procedure TForm1.GoClearClick(Sender: TObject);
begin
  prekey_i := 0;
  SheetList.Enabled := false;
  ObjShow(MyMinuss);
  ObjShow(ClearinP);
  LoadPNGfromRes(ClearingAllPNG, 'all_PNG');
  LoadPNGfromRes(ClearingYesPNG, 'yes_PNG');
  LoadPNGfromRes(ClearingNoPNG, 'no_PNG');
  LoadPNGfromRes(ClearingFullPNG, 'full_PNG');
  if PreKeySheet.Visible then
  begin
    PreKeyLoad.Visible := false;
    ClearingWord.Caption := PreKey.Lines.Strings[0];
  end;

  if DokeySheet.Visible then
  begin
    KeysC.Visible := false;
    ClearingWord.Caption := KeyCollector.Lines.Strings[0];
  end;
end;

procedure TForm1.GoClearDblClick(Sender: TObject);
var
  SL, SL2: TStringList;
  i, j, l, chet, f: integer;
  stri, stri2: string;
  a, b, c: boolean;
begin
  c := false;
  f := 1;
  while (not c) or (f <> 0) do
  begin
    f := 0;
    c := true;
    for i := 0 to PreKey.Lines.Count - 2 do
    begin
      stri := PreKey.Lines.Strings[i];
      SL := TStringList.Create;
      SL.Text := StringReplace(stri, ' ', #13#10, [rfReplaceAll]);
      b := false;
      for j := PreKey.Lines.Count - 1 downto i + 1 do
      begin
        stri2 := PreKey.Lines.Strings[j];
        SL2 := TStringList.Create;
        SL2.Text := StringReplace(stri2, ' ', #13#10, [rfReplaceAll]);
        a := false;
        if SL.Count < SL2.Count then
        begin
          chet := 0;
          for l := 0 to SL.Count - 1 do
          begin
            if (AnsiPos(SL[l], stri2) > 0) then
            begin
              chet := chet + 1;
            end
          end;
          if chet = SL.Count then
          begin
            b := true;
          end;
        end
        else
        begin
          chet := 0;
          for l := 0 to SL2.Count - 1 do
          begin
            if (AnsiPos(SL2[l], stri) > 0) then
            begin
              chet := chet + 1;
            end
          end;
          if chet = SL2.Count then
          begin
            a := true;
          end;
        end;
        FreeAndNil(SL2);

        if a then
        begin
          PreKey.Lines.Delete(j);
          c := false;
        end;
        if b then
        begin
          PreKey.Lines.Delete(i);
          c := false;
          break;
        end;
      end;
      FreeAndNil(SL2);
    end;
  end;
end;

procedure TForm1.GoNext2Click(Sender: TObject);
var
  i: integer;
  stri, stri2, put: string;
begin
  ObjShow(AdsSheet);
  ObjShow(AdsControlP);
  DokeySheet.Visible := false;
  PreKeySheet.Visible := false;
  InfoSheet.Visible := false;
  ThreeSheet.Visible := false;
  KeysP.Parent := AdsSheet;
  KeysP.Visible := false;
  KeysP.TabOrder := 0;
  { AdsRightP.Visible := false;
    AdsRightZagsP.Visible := false;
    AdsRightP.Align := alLeft; }
  LoadPNGfromRes(stavkaPNG, 'stavka_PNG');
  LoadPNGfromRes(PriblPNG, 'pribl_PNG');
  LoadPNGfromRes(CtrPNG, 'ctr_PNG');
  LoadPNGfromRes(nextPNG, 'next2_PNG');

  if AdsRight.Text = '' then
    AdsRight.Text := KeyCollector.Text;
  // AdsRightZagsP.Align := alLeft;
  if AdsRightZags.Text = '' then
    AdsRightZags.Text := KeyCollector.Text;

  if AdsRightZags2.Text = '' then
  begin
    AdsRightZags2.Text := KeyCollector.Text;
    for i := 0 to AdsRightZags2.Lines.Count - 1 do
      AdsRightZags2.Lines.Strings[i] := '';
  end;

  if teplota.Text = '' then
  begin
    teplota.Text := KeyCollector.Text;
    for i := 0 to teplota.Lines.Count - 1 do
      teplota.Lines.Strings[i] := '0';
  end;
  adsright_i := 0;
  AdsRightE.Text := AdsRight.Lines.Strings[adsright_i];
  AdsRightZagE.Text := AdsRightZags.Lines.Strings[adsright_i];
  AdsRightZag2E.Text := AdsRightZags2.Lines.Strings[adsright_i];
  AdsRightL.Caption := KeyCollector.Lines.Strings[adsright_i];
  TeplotaShape.Visible := true;
  if teplota.Lines.Strings[adsright_i] = '0' then
    TeplotaShape.Visible := false;
  if teplota.Lines.Strings[adsright_i] = '1' then
    TeplotaShape.Left := ColdPNG.Left;
  if teplota.Lines.Strings[adsright_i] = '2' then
    TeplotaShape.Left := HeatPNG.Left;
  if teplota.Lines.Strings[adsright_i] = '3' then
    TeplotaShape.Left := HotPNG.Left;
  // ------------------------------------------------------------------------------
  ObjShow(LoadScreen);
  ZConnection1.Connected := false;
  ZConnection1.Connected := true;
  HideMemo.Clear;
  for i := 0 to KeyPhraze.Lines.Count - 1 do
  begin
    stri := Copy(KeyPhraze.Lines.Strings[i], 0,
      AnsiPos('|*|', KeyPhraze.Lines.Strings[i]) - 1);
    stri2 := Copy(KeyPhraze.Lines.Strings[i],
      AnsiPos('|*|', KeyPhraze.Lines.Strings[i]) + 3,
      KeyPhraze.Lines.Strings[i].length - 1);
    HideMemo.Lines.Add(id_user + ',' + stri + ',' + stri2);
    if i mod 500 = 0 then
      Application.ProcessMessages;
  end;

  i := GetWindowTextLength(HideMemo.Handle);
  HideMemo.SelStart := i - 2;
  HideMemo.SelLength := 2;
  if HideMemo.SelText = #13#10 then
    HideMemo.SelText := ''
  else
    HideMemo.SelStart := i;
  put := ExtractfilePath(Application.ExeName) + 'Projects\' + code + '\' + code
    + '_keytoload.txt';
  put := StringReplace(put, '\', '/', [rfReplaceAll]);
  // put := 'C:\keytoload.txt';
  // ShowMessage(put);
  HideMemo.Lines.WriteBOM := false;
  HideMemo.Lines.SaveToFile(put, TEncoding.UTF8);
  Application.ProcessMessages;
  sleep(1234);
  HideMemo.Clear; // REPLACE
  HideMemo.Lines.Add('LOAD DATA LOCAL INFILE "' + put +
    '" REPLACE INTO TABLE `keys`');
  HideMemo.Lines.Add('CHARACTER SET utf8');
  HideMemo.Lines.Add('FIELDS TERMINATED BY ","');
  HideMemo.Lines.Add('LINES TERMINATED BY "\r\n"');
  HideMemo.Lines.Add('(`userid`, `key`, `fraza`)');
  // HideMemo.Lines.SaveToFile(put+'.txt');
  ZQuery1.SQL := HideMemo.Lines;
  // ZQuery2.Active := true;
  ZQuery1.ExecSQL;

  // ------------------------------------------------------------------------------
  {
    SL := TStringList.Create;
    SL.Sorted := true;
    SL.Duplicates := dupIgnore;
    SL.AddStrings(KeyPhraze.Lines);
    KeyPhraze.Clear;
    KeyPhraze.Lines.AddStrings(SL);
    SL.Free;
    for i := 0 to KeyPhraze.Lines.Count - 1 do
    begin
    stri := Copy(KeyPhraze.Lines.Strings[i], 0,
    pos('|*|', KeyPhraze.Lines.Strings[i]) - 1);
    stri2 := Copy(KeyPhraze.Lines.Strings[i],
    pos('|*|', KeyPhraze.Lines.Strings[i]) + 3,
    KeyPhraze.Lines.Strings[i].Length - 1);
    stri3 := 'SELECT `id` FROM `keys` WHERE `key`=''' + stri +
    ''' AND `fraza`=''' + stri2 + '''';

    ZQuery1.SQL.text := stri3;
    ZQuery1.Active := true;
    one := ZQuery1.FieldByName('id').AsInteger;
    if one = 0 then
    begin
    ZQuery1.SQL.text := 'INSERT INTO `keys`(`userid`,`key`,`fraza`) VALUES' +
    ' (''' + id_user + ''', ''' + stri + ''', ''' + stri2 + ''')';
    ZQuery1.ExecSQL;
    end;
    Application.ProcessMessages;
    end; }
  LoadScreen.Visible := false;
end;

procedure TForm1.GoNextClick(Sender: TObject);
begin
  SheetHide;
  ObjShow(DokeySheet);
end;

procedure TForm1.GoogleHelpDblClick(Sender: TObject);
var
  stri: string;
begin
  if GoogleHelp.CaretPos.Y = 0 then
  begin
    ShellExecute(0, 'open', 'https://adwords.google.com/KeywordPlanner#start',
      nil, nil, SW_SHOW);
  end;
  if (GoogleHelp.CaretPos.Y = 1) or (GoogleHelp.CaretPos.Y = 2) then
  begin
    stri := ExtractfilePath(Application.ExeName) +
      'INFORMATION/Работа в Google Adwords';
    ShellExecute(0, 'open', PWideChar(Pwidestring(stri)), nil, nil, SW_SHOW);
  end;
  if (GoogleHelp.CaretPos.Y = 3) or (GoogleHelp.CaretPos.Y = 4) then
  begin
    stri := ExtractfilePath(Application.ExeName) + 'Projects/' + code +
      '/csv from google';
    ShellExecute(0, 'open', PWideChar(Pwidestring(stri)), nil, nil, SW_SHOW);
  end;
  if GoogleHelp.CaretPos.Y = 5 then
  begin
    ThreeSheet.Visible := false;
    ObjShow(PreKeySheet);
  end;
end;

procedure TForm1.GoogleHelpMouseEnter(Sender: TObject);
begin
  LoadPNGfromRes(DblClickPNG, 'dblclick2_PNG');
  HintDblClick.Font.Color := clBlack;
end;

procedure TForm1.GoogleHelpMouseLeave(Sender: TObject);
begin
  LoadPNGfromRes(DblClickPNG, 'dblclick_PNG');
  HintDblClick.Font.Color := clSilver;
end;

procedure TForm1.GroupSelectorMClick(Sender: TObject);
begin // Сейчас тут все ключевики
  if GroupSelectorM.Lines.Strings[GroupSelectorM.CaretPos.Y] <> '' then
  begin
    adsright_ii := strtoint(GroupSelectorMI.Lines.Strings
      [GroupSelectorM.CaretPos.Y]);
    rpls_row := adsright_ii;
    ReplaceZTZOne.Enabled := true;
    ReplaceZTZOne.Font.Color := clBlack;
    AdsZag.Caption := poisk.Cells[7, adsright_ii];
    AdsText.Caption := poisk.Cells[9, adsright_ii];
    AdsZag2.Caption := poisk.Cells[8, adsright_ii];
    if AdsZag.Caption = '' then
      AdsZag.Caption := 'Не введено';
    if AdsZag2.Caption = '' then
      AdsZag2.Caption := 'Не введено';
    if AdsText.Caption = '' then
      AdsText.Caption := 'Не введено';
    AdsZag2.Left := AdsZag.Left + AdsZag.Width + 5;
    PoiskWord.Caption := poisk.Cells[2, adsright_ii];
    ObjShow(AdsPreview);
  end;
end;

procedure TForm1.GroupSelectorMContextPopup(Sender: TObject; MousePos: TPoint;
  var Handled: boolean);
begin
  Handled := true;
end;

procedure TForm1.GroupSelectorMMouseDown(Sender: TObject; Button: TMouseButton;
  Shift: TShiftState; X, Y: integer);
begin
  if Button = mbRight then
  begin
    ObjShow(ReplacerZTZP);
    changerI := strtoint(GroupSelectorZMI.Lines.Strings
      [GroupSelectorZM.CaretPos.Y]);
    OldZTZ.Caption := GroupSelectorZM.Lines.Strings[GroupSelectorZM.CaretPos.Y];
    ReplaceZTZOne.Enabled := false;
    ReplaceZTZOne.Font.Color := clGray;
    MaxLenStr.Caption := inttostr(maxdlz1);
    LenStr.Caption := inttostr(length(OldZTZ.Caption));
    NewZTZ.Text := OldZTZ.Caption;
  end;
end;

procedure TForm1.GroupSelectorZMClick(Sender: TObject);
begin
  ObjShow(GroupSelectorP);
  changerI := GroupSelectorZM.CaretPos.Y;
  Panel116.Caption := GroupSelectorZM.Lines.Strings[changerI];
  Panel107.Caption := GroupSelectorZM.Lines.Strings[changerI];
  GroupSelectorByStr(GroupSelectorM, GroupSelectorMI, poisk, rpls_col, 4,
    Panel107.Caption);
end;

procedure TForm1.GroupSelectorZMContextPopup(Sender: TObject; MousePos: TPoint;
  var Handled: boolean);
begin
  Handled := true;
end;

procedure TForm1.GroupSelectorZMMouseDown(Sender: TObject; Button: TMouseButton;
  Shift: TShiftState; X, Y: integer);
begin
  if Button = mbRight then
  begin
    ObjShow(ReplacerZTZP);
    OldZTZ.Caption := AdsZag.Caption;
    ReplaceZTZOne.Enabled := true;
    ReplaceZTZOne.Font.Color := clBlack;
    MaxLenStr.Caption := inttostr(maxdlz1);
    LenStr.Caption := inttostr(length(OldZTZ.Caption));
    NewZTZ.Text := OldZTZ.Caption;
  end;
end;

procedure TForm1.ReplaceOnClick(Sender: TObject);
begin
  ObjShow(ReplaceP);
  ReplaceM.Clear;
  if Memo4.Text = '' then
  begin
    ObjShow(LoadBarP);
    if KeyCollector.Visible then
      Slova(KeyCollector, Memo4, LoadBar2);
    if AdsRight.Visible then
      Slova(KeyCollector, Memo4, LoadBar2);
    Memo4.Lines.SaveToFile(ExtractfilePath(Application.ExeName) + 'Projects/' +
      code + '/' + code + '_diffkeys.txt');
    LoadBarP.Visible := false;
  end;
end;

procedure TForm1.ReplaceBClick(Sender: TObject);
begin
  ObjShow(LoadBarP);
  if PreKey.Visible then
  begin
    WordReplaceM(PreKey, ReplaceR.Text, ReplaceM, LoadBar2);
    ReplaceToTable(ReplaceR.Text, ReplaceM, ReplaceT);
  end;
  if KeyCollector.Visible then
  begin
    WordReplaceM(KeyCollector, ReplaceR.Text, ReplaceM, LoadBar2);
    ReplaceToTable(ReplaceR.Text, ReplaceM, ReplaceT);
  end;
  ReplaceM.Clear;
  ReplaceW.Text := '';
  ReplaceR.Text := '';
  LoadBarP.Visible := false;
end;

procedure TForm1.ReplaceMClick(Sender: TObject);
begin
  ReplaceR.Text := ReplaceM.Lines.Strings[ReplaceM.CaretPos.Y];
end;

procedure TForm1.ReplaceMDblClick(Sender: TObject);
begin
  ReplaceR.Text := '';
  Memo4.Lines.Add(ReplaceM.Lines.Strings[ReplaceM.CaretPos.Y]);
  ReplaceM.Lines.Delete(ReplaceM.CaretPos.Y);
end;

procedure TForm1.RezhimClick(Sender: TObject);
begin
  if rezhimautobool then
  begin
    Rezhim.Caption := 'Полу-автоматический режим';
    rezhimautobool := false;
  end
  else
  begin
    Rezhim.Caption := 'Автоматический режим';
    rezhimautobool := true;
  end;
end;

procedure TForm1.CloseClick(Sender: TObject);
begin
  AdsPreview.Visible := false;
end;

procedure TForm1.LaterTimer(Sender: TObject);
begin
  keyplanner.Visible := false;
  PreKeyHelpP.Visible := false;
  Later.Enabled := false;
end;

procedure TForm1.LidsChange(Sender: TObject);
begin
  if (SrChek.Text <> '') and (marzha.Text <> '') and (prmarzhi.Text <> '') and
    (k1.Text <> '') and (k2.Text <> '') and (Lids.Text <> '') then
  begin
    SrCheckF := strtofloat(SrChek.Text);
    MarzhaF := strtofloat(marzha.Text);
    K3F := strtofloat(prmarzhi.Text);
    K1F := strtofloat(k1.Text);
    K2F := strtofloat(k2.Text);
    StavkaF := SrCheckF * MarzhaF * K3F * K1F * K2F * koefrazb;
    Stavka.Caption := floattostr(StavkaF);

    LidsF := strtofloat(Lids.Text);
    ClicksF := LidsF / K1F / K2F;
    clicks.Caption := floattostr(ClicksF);
    clicksperdayF := Ceil(ClicksF / 30);
    clicksperday.Caption := floattostr(clicksperdayF);
    BudgetF := StavkaF * ClicksF;
    BudgetperdayF := StavkaF * clicksperdayF;
    BudgetPerDay.Caption := floattostr(BudgetperdayF);
    Budget.Caption := floattostr(BudgetF);
    ProgDohodF := SrCheckF * LidsF * MarzhaF - BudgetF;
    ProgDohod.Caption := floattostr(ProgDohodF);
  end;
end;

procedure TForm1.LidsEnter(Sender: TObject);
begin
  DecimalSeparator := ',';
end;

procedure TForm1.LidsKeyPress(Sender: TObject; var Key: Char);
begin
  case Key of
    #8, '0' .. '9':
      ;

    '.', ',':
      begin
        if Key <> DecimalSeparator then
          Key := DecimalSeparator;
        if AnsiPos(DecimalSeparator, prmarzhi.Text) <> 0 then
          Key := Chr(0);
      end;
    '-':
      if length(prmarzhi.Text) <> 0 then
        Key := Chr(0);
    #13:
      SrChek.SetFocus;
  else
    Key := Chr(0);
  end;
end;

procedure TForm1.ListClearClick(Sender: TObject);
begin
  NoListClear.Lines.Add(ListClear.Lines.Strings[ListClear.CaretPos.Y]);
  ListClear.Lines.Delete(ListClear.CaretPos.Y);
end;

procedure TForm1.ListClearDblClick(Sender: TObject);
begin
  NoListClear.Lines.Add(ListClear.Lines.Strings[ListClear.CaretPos.Y]);
  ListClear.Lines.Delete(ListClear.CaretPos.Y);
end;

procedure TForm1.LoadingTimer(Sender: TObject);
var
  str, SerialMB, serialCount: string;
  SL: TStringList;
  i: integer;
  b: boolean;
begin
  ZConnection1.Connected := false;
  ZConnection1.Connected := true;
  Loading.Enabled := false;
  ObjShow(InfoSheet);

  str := 'SELECT * FROM `users` WHERE `email`=''' + login + ''' OR `phone`=''' +
    login + ''' LIMIT 1';
  ZQuery1.SQL.Text := str;
  ZQuery1.Active := true;
  id_user := inttostr(ZQuery1.FieldByName('id').AsInteger);
  Phone.Text := ZQuery1.FieldByName('phone').AsString;
  familiya.Text := ZQuery1.FieldByName('family').AsString;
  imya.Text := ZQuery1.FieldByName('name').AsString;
  otchestvo.Text := ZQuery1.FieldByName('soname').AsString;
  City.Text := ZQuery1.FieldByName('city').AsString;
  Ulica.Text := ZQuery1.FieldByName('street').AsString;
  dom.Text := ZQuery1.FieldByName('home').AsString;
  korpus.Text := ZQuery1.FieldByName('cabinet').AsString;
  ofice.Text := ZQuery1.FieldByName('office').AsString;
  ogrn.Text := ZQuery1.FieldByName('ogrn').AsString;
  KontEmail.Text := ZQuery1.FieldByName('cemail').AsString;
  Kompaniya.Text := ZQuery1.FieldByName('company').AsString;
  SerialMB := ZQuery1.FieldByName('serial').AsString;
  serialCount := ZQuery1.FieldByName('serialcount').AsString;
  token := ZQuery1.FieldByName('Token').AsString;
  lastprod := ZQuery1.FieldByName('lastprod').AsString;
  lvlentry := strtoint(ZQuery1.FieldByName('activated').AsString);
  Addi.Clear;
  Addi.Lines.Strings[0] := 'Подробнее о товаре/услуге (со следующей строки):';
  Addi.Lines.Add(ZQuery1.FieldByName('addi').AsString);
  if SerialMB <> '' then
  begin
    b := false;
    if AnsiPos(';', SerialMB) > 0 then
    begin
      SL := TStringList.Create;
      SL.Text := StringReplace(SerialMB, ';', #13#10, [rfReplaceAll]);

      for i := 0 to SL.Count - 1 do
      begin
        if SerialTrue(SL[i], GetSerialMotherBoard) then
        begin
          b := true;
          break;
        end;
      end;
    end
    else
    begin
      if SerialTrue(SerialMB, GetSerialMotherBoard) then
        b := true;
    end;
    if not b then
    begin
      serialCount := inttostr(strtoint(serialCount) + 1);
      if strtoint(serialCount) > 3 then
      begin
        ShowMessage
          ('Вы превысили максимальное количество различных устройств (3).');
      end
      else
      begin
        SerialMB := SerialMB + ';' + GetSerialMotherBoard;
        str := 'UPDATE `users` SET `serial`=''' + SerialMB +
          ''', `serialcount`=''' + serialCount + ''' WHERE `email`=''' + login +
          ''' OR `phone`=''' + login + '''';
        ZQuery1.SQL.Text := str;
        ZQuery1.ExecSQL;
      end;
    end;
  end
  else
  begin
    serialCount := inttostr(strtoint(serialCount) + 1);
    str := 'UPDATE `users` SET `serial`=''' + GetSerialMotherBoard +
      ''', `serialcount`=''' + serialCount + ''' WHERE `email`=''' + login +
      ''' OR `phone`=''' + login + '''';
    ZQuery1.SQL.Text := str;
    ZQuery1.ExecSQL;
  end;

  if strtoint(serialCount) < 4 then
  begin
    if lvlentry = 2 then
      ShowMessage('2')
    else if lvlentry = 1 then
    begin
      ObjHide(HideL);
      ObjHide(HideP);
      ObjHide(proPNG);
      ObjHide(dataPNG);
      ObjHide(Cold);
      ObjHide(Panel74);
      ObjHide(DoSR);
    end
    else if lvlentry = 3 then
      ShowMessage('3');
    next_i := 15;
    Edit.TextHint := 'Товар/Услугу';
    HelpInput.Caption :=
      '(: На английском языке без знаков. Пример: directologplus';
    // ShowMessage('');
    InfoL.Caption := Edit.TextHint;
    if ogrn.Text = '' then
    begin
      next_i := 11;
      Edit.TextHint := 'ОГРН/ОГРНИП';
      HelpInput.Caption := '(: Пример: 314028000100642';
      InfoL.Caption := Edit.TextHint;
    end;
    if Kompaniya.Text = '' then
    begin
      next_i := 10;
      Edit.TextHint := 'Наименование компании';
      HelpInput.Caption := '(: Пример: Доктор Комп';
      InfoL.Caption := Edit.TextHint;
    end;
    if KontEmail.Text = '' then
    begin
      next_i := 9;
      Edit.TextHint := 'Контактный email';
      InfoL.Caption := Edit.TextHint;
      HelpInput.Caption := '(: Пример: vinhunter@ya.ru';
    end;
    if Phone.Text = '' then
    begin
      next_i := 8;
      Edit.TextHint := 'Номер телефона';
      HelpInput.Caption := '(: Пример: 79177773667';
      InfoL.Caption := Edit.TextHint;
    end;
    if otchestvo.Text = '' then
    begin
      next_i := 7;
      Edit.TextHint := 'Отчество';
      HelpInput.Caption := '(: Пример: Ахатович';
      InfoL.Caption := Edit.TextHint;
    end;
    if familiya.Text = '' then
    begin
      next_i := 6;
      Edit.TextHint := 'Фамилия';
      HelpInput.Caption := '(: Пример: Климахин';
      InfoL.Caption := Edit.TextHint;
    end;
    if imya.Text = '' then
    begin
      next_i := 5;
      Edit.TextHint := 'Имя';
      HelpInput.Caption := '(: Пример: Виктор';
      InfoL.Caption := Edit.TextHint;
    end;
    if dom.Text = '' then
    begin
      next_i := 2;
      Edit.Text := '';
      Edit.TextHint := 'Номер дома';
      HelpInput.Caption := '(: Пример: 1';
      InfoL.Caption := Edit.TextHint;
    end;
    if Ulica.Text = '' then
    begin
      next_i := 1;
      Edit.Text := '';
      Edit.TextHint := 'Улицу';
      HelpInput.Caption := '(: Пример: Проспект Мира';
      InfoL.Caption := Edit.TextHint;
    end;
    InfoP.Visible := true;
    if City.Text = '' then
    begin
      next_i := 0;
      Edit.Text := '';
      Edit.TextHint := 'Город';
      HelpInput.Caption := '(: Пример: Москва';
      InfoL.Caption := Edit.TextHint;
      InfoP.Visible := false;
    end;

    str := 'SELECT `durl` FROM `product` WHERE `userid`=''' + id_user + '''';
    ZQuery1.SQL.Text := str;
    ZQuery1.Active := true;

    While not ZQuery1.EoF do
    begin
      CodeName.Items.Add(ZQuery1.FieldByName('durl').AsString);
      ZQuery1.next;
    end;
    if CodeName.Items.Count > 0 then
    begin
      CodeName.Visible := true;
      newprodbool := false;
    end;
    if strtoint(lastprod) > -1 then
      CodeName.ItemIndex := strtoint(lastprod)
    else
      CodeName.ItemIndex := CodeName.Items.Count - 1;

    if next_i = 15 then
    begin
      if CodeName.Items.Strings[CodeName.ItemIndex] = '' then
      begin
        next_i := 12;
        Edit.TextHint := 'Товар/Услугу';
        HelpInput.Caption :=
          '(: На английском языке без знаков. Пример: directologplus';
        InfoL.Caption := Edit.TextHint;
      end
      else
      begin
        LoadPNGfromRes(InfoI, 'PngImage_9');
        addprodPNG.Visible := true;
        LoadPNGfromRes(addprodPNG, 'addprod_PNG');
        Addi.Visible := true;
        CodeName.Visible := true;
        next_i := 15;
        Edit.TextHint := 'Товар/Услуга';
        InfoL.Caption := 'Товар/Услугу';
        HelpInput.Caption :=
          'Введите имя товара/услуги или выберите из списка выше! Пример: directologplus';
        Edit.Text := CodeName.Items.Strings[CodeName.ItemIndex];
      end;
    end;
    CurPosEnd(Edit);
    LoadSheet.Visible := false;
    // -----------------------------------------------------------------------
  end
  else
  begin
    login := '';
    BRReg.Load('http://directolog-plus.ru/directologplus/loader.php');
    ObjShow(LoadSheet);
  end;
end;

procedure TForm1.LoadProgTimer(Sender: TObject);
begin
  if iTimer = 3 then
  begin
    ErrorL.Font.Color := clRed;
    ErrorL.Caption := 'Нет подключения. Пробую снова...';
    BRReg.Load('http://directolog-plus.ru/directologplus/loader.php');
    iTimer := 0;
  end;
  inc(iTimer);
end;

procedure TForm1.LoginEKeyPress(Sender: TObject; var Key: Char);
begin
  if (LoginE.Text <> '') and (PassE.Text <> '') and (loaded) then
    LoginI.Visible := true;
  if (Key = #13) and (PassE.Text <> '') and (loaded) then
    HideInjection2.Click;
end;

procedure TForm1.LoginEMouseEnter(Sender: TObject);
begin
  LoadPNGfromRes(Kbrd1PNG, 'q2_PNG');
  LoadPNGfromRes(Kbrd2PNG, 'w2_PNG');
  LoadPNGfromRes(Kbrd3PNG, 'e2_PNG');
end;

procedure TForm1.LoginEMouseLeave(Sender: TObject);
begin
  LoadPNGfromRes(Kbrd1PNG, 'q_PNG');
  LoadPNGfromRes(Kbrd2PNG, 'w_PNG');
  LoadPNGfromRes(Kbrd3PNG, 'e_PNG');
end;

procedure TForm1.LoginIClick(Sender: TObject);
var
  CodeStr: string;
begin
  if Assigned(BRReg.Browser) and Assigned(BRReg.Browser.Mainframe) then
  begin
    ClickLoadBool := true;
    ErrorLoadBool := false;
    LoadProg.Enabled := false;
    CodeStr :=
      '$("#cont").append(''<form method="post" class="hidden" style="display:none;">'
      + '<input name="lucky" type="hidden" onclick="return true;">' +
      '<input name="chel" type="hidden" onclick="return true;">' +
      '<input type="submit" id="Ebuton" name="Ebuton" value="Войти">' +
      '</form>'');';
    BRReg.Browser.Mainframe.ExecuteJavaScript(CodeStr, 'about:blank', 0);
  end;
  HideInjection.Click;
end;

procedure TForm1.LoginIMouseEnter(Sender: TObject);
begin
  if ClickLoadBool = false then
  begin
    LoadPNGfromRes(LoginI, 'PngImage_3');
    HintClick.Font.Color := clBlack;
    LoadPNGfromRes(ClickPNG, 'Click2_PNG');
  end;
end;

procedure TForm1.LoginIMouseLeave(Sender: TObject);
begin
  if ClickLoadBool = false then
  begin
    if not ErrorLoadBool then
      LoadPNGfromRes(LoginI, 'PngImage_1')
    else
      LoadPNGfromRes(LoginI, 'PngImage_2');
    HintClick.Font.Color := clSilver;
    LoadPNGfromRes(ClickPNG, 'Click_PNG');
  end;
end;

procedure TForm1.marzhaChange(Sender: TObject);
begin
  if (SrChek.Text <> '') and (marzha.Text <> '') and (prmarzhi.Text <> '') and
    (k1.Text <> '') and (k2.Text <> '') and (Lids.Text <> '') then
  begin
    SrCheckF := strtofloat(SrChek.Text);
    MarzhaF := strtofloat(marzha.Text);
    K3F := strtofloat(prmarzhi.Text);
    K1F := strtofloat(k1.Text);
    K2F := strtofloat(k2.Text);
    StavkaF := SrCheckF * MarzhaF * K3F * K1F * K2F * koefrazb;
    Stavka.Caption := floattostr(StavkaF);

    LidsF := strtofloat(Lids.Text);
    ClicksF := LidsF / K1F / K2F;
    clicks.Caption := floattostr(ClicksF);
    clicksperdayF := Ceil(ClicksF / 30);
    clicksperday.Caption := floattostr(clicksperdayF);
    BudgetF := StavkaF * ClicksF;
    BudgetperdayF := StavkaF * clicksperdayF;
    BudgetPerDay.Caption := floattostr(BudgetperdayF);
    Budget.Caption := floattostr(BudgetF);
    ProgDohodF := SrCheckF * LidsF * MarzhaF - BudgetF;
    ProgDohod.Caption := floattostr(ProgDohodF);
  end;
end;

procedure TForm1.marzhaEnter(Sender: TObject);
begin
  DecimalSeparator := ',';
end;

procedure TForm1.marzhaKeyPress(Sender: TObject; var Key: Char);
begin
  case Key of
    #8, '0' .. '9':
      ;

    '.', ',':
      begin
        if Key <> DecimalSeparator then
          Key := DecimalSeparator;
        if AnsiPos(DecimalSeparator, marzha.Text) <> 0 then
          Key := Chr(0);
      end;
    '-':
      if length(marzha.Text) <> 0 then
        Key := Chr(0);
    #13:
      k1.SetFocus;
  else
    Key := Chr(0);
  end;
end;

procedure TForm1.Memo1Click(Sender: TObject);
var
  ClipBoard: TClipboard;
begin
  ClipBoard := TClipboard.Create;
  // SelLine(SiteList,SiteList.CaretPos.Y);
  ClipBoard.SetTextBuf(PWideChar(Pwidestring(Memo1.Text)));
end;

procedure TForm1.Memo25Click(Sender: TObject);
var
  n, M: integer;
begin
  if (Frst.Text <> '') and (Scnd.Text <> '') then
    for M := 0 to Frst.Lines.Count - 1 do
      for n := 0 to Scnd.Lines.Count - 1 do
        (Sender AS TMemo).Lines.Add(Frst.Lines.Strings[M] + ' ' +
          Scnd.Lines.Strings[n]);
end;

procedure TForm1.Memo4Click(Sender: TObject);
begin
  // ShowMessage(inttostr(Memo4.Lines.Count));
  // Memo4.Visible:=false;
  { if ReplaceW.Text='' then
    ReplaceW.Text:=Memo4.Lines.Strings[Memo4.CaretPos.Y]
    else
    ReplaceR.Text:=Memo4.Lines.Strings[Memo4.CaretPos.Y]; }
  ReplaceM.Lines.Add(Memo4.Lines.Strings[Memo4.CaretPos.Y]);
  Memo4.Lines.Delete(Memo4.CaretPos.Y);
end;

procedure TForm1.MinDlSlovEChange(Sender: TObject);
begin
  if MinDlSlovE.Text <> '' then
    MinDlSlovT.Position := strtoint(MinDlSlovE.Text)
  else
  begin
    MinDlSlovT.Position := 1;
    MinDlSlovE.SelStart := length(MinDlSlovE.Text);
    MinDlSlovE.SelLength := 0;
  end;
end;

procedure TForm1.MinDlSlovTChange(Sender: TObject);
begin
  MinDlSlovE.Text := inttostr(MinDlSlovT.Position);
end;

procedure TForm1.MinimizeBClick(Sender: TObject);
begin
  Application.Minimize;
end;

procedure TForm1.MinimizeBMouseEnter(Sender: TObject);
begin
  MinimizeB.Color := $00E1E1E1;
  ObjShow(PreKeyHelpP);
  PreKeyHelpP.Left := Screen.Width - PreKeyHelpP.Width - 10;
  PreKeyHelpP.Top := MinimizeB.Top + MinimizeB.Height + 10;
  PreKeyHelp.Text := 'Сворачивает Директолог+, при этом продолжает работать';
end;

procedure TForm1.MinimizeBMouseLeave(Sender: TObject);
begin
  MinimizeB.Color := clWhite;
  PreKeyHelpP.Visible := false;
end;

procedure TForm1.wordstatClick(Sender: TObject);
var
  s: string;
begin
  if wordstat.Caption = 'Я' then
  begin
    s := 'https://wordstat.yandex.ru/#!/?regions=' + regions;
    ShellExecute(0, 'open', PWideChar(Pwidestring(s)), nil, nil, SW_SHOW);
  end
  else if wordstat.Caption = 'G' then
    ShellExecute(0, 'open', 'https://adwords.google.com/KeywordPlanner#start',
      nil, nil, SW_SHOW);
end;

procedure TForm1.wordstatDblClick(Sender: TObject);
begin
  if wordstat.Caption = 'Я' then
    ShellExecute(0, 'open',
      'https://passport.yandex.ru/registration?mode=register&uid=28106254', nil,
      nil, SW_SHOW)
  else if wordstat.Caption = 'G' then
    ShellExecute(0, 'open',
      'https://accounts.google.com/SignUp?continue=https%3A%2F%2Faccounts.google.com%2FManageAccount',
      nil, nil, SW_SHOW);
end;

procedure TForm1.wordstatMouseEnter(Sender: TObject);
begin
  wordstat.Color := clGradientInactiveCaption;
  keyplanner.Visible := true;
end;

procedure TForm1.wordstatMouseLeave(Sender: TObject);
begin
  wordstat.Color := clWhite;
  Later.Enabled := true;
end;

procedure TForm1.WorkTimeChange(Sender: TObject);
var
  i: integer;
begin
  AdsTimeWork.Caption := WorkTime.Lines.Strings[0];
  if WorkTime.Lines.Count - 1 > 0 then
    for i := 1 to WorkTime.Lines.Count - 1 do
      AdsTimeWork.Caption := AdsTimeWork.Caption + ' ' +
        WorkTime.Lines.Strings[i];
end;

procedure TForm1.WorkTimeDblClick(Sender: TObject);
begin
  WorkTime.Lines.Delete(WorkTime.CaretPos.Y);
end;

procedure TForm1.WorkTimesClick(Sender: TObject);
begin
  ObjShow(WorkTimesP);
  SheetList.Enabled := false;
  LoadPNGfromRes(plusPNG, 'plus_PNG');
end;

procedure TForm1.YaEntryTimer(Sender: TObject);
begin
  iTimer := iTimer + 1;
  YaHideClick.Click;
  if iTimer = 3 then
  begin
    YaEntry.Enabled := false;
    FindControl.Visible := true;
    YaEntryB.Cursor := crDefault;
    keysPNG.Visible := true;
    YandexParseP.BevelInner := bvLowered;
    YandexParseP.BevelOuter := bvRaised;
  end;
end;

procedure TForm1.YaHideClick2Click(Sender: TObject);
var
  CodeStr: string;
begin
  if Assigned(BRReg.Browser) and Assigned(BRReg.Browser.Mainframe) then
  begin
    CodeStr := '$("input[name=\"login\"]").val("' + YaLogin.Text + '");';
    CodeStr := CodeStr + '$("input[name=\"passwd\"]").val("' +
      YaPassword.Text + '");';
    CodeStr := CodeStr + '$(".b-form-button__input").click();';
    BRReg.Browser.Mainframe.ExecuteJavaScript(CodeStr, 'about:blank', 0);
  end;
end;

procedure TForm1.YaHideClickClick(Sender: TObject);
var
  CodeStr: string;
begin
  if (YaLogin.Text <> '') and (YaPassword.Text <> '') then
    if Assigned(BRReg.Browser) and Assigned(BRReg.Browser.Mainframe) then
    begin
      CodeStr := CodeStr + '$("input[name=\"login\"]").val("' +
        YaLogin.Text + '");';
      CodeStr := CodeStr + '$("input[name=\"passwd\"]").val("' +
        YaPassword.Text + '");';
      CodeStr := CodeStr + '$(".b-form-button__input").click();';
      BRReg.Browser.Mainframe.ExecuteJavaScript(CodeStr, 'about:blank', 0);
    end;
end;

procedure TForm1.YaLoginKeyPress(Sender: TObject; var Key: Char);
begin
  if (YaLogin.Text <> '') and (YaPassword.Text <> '') then
  begin
    YaEntryB.Visible := true;
    DoErr.Visible := false;
    if Key = #13 then
      YaEntryBClick(YaEntryB);
  end;
end;

procedure TForm1.YaPasswordKeyPress(Sender: TObject; var Key: Char);
begin
  if (YaLogin.Text <> '') and (YaPassword.Text <> '') then
  begin
    YaEntryB.Visible := true;
    DoErr.Visible := false;
    if Key = #13 then
      YaEntryBClick(YaEntryB);
  end;
end;

procedure TForm1.YaTimerTimer(Sender: TObject);
var
  CodeStr: string;
begin
  if (yalog <> '') and (yapas <> '') then
  begin
    iTimer := iTimer + 1;
    CodeStr := '';
    if iTimer = 1 then
    begin
      if Assigned(BRReg.Browser) and Assigned(BRReg.Browser.Mainframe) then
      begin
        CodeStr := CodeStr + '$(".b-form-button__input").click();';
        BRReg.Browser.Mainframe.ExecuteJavaScript(CodeStr, 'about:blank', 0);
      end;
    end;
    if iTimer = 2 then
    begin
      if Assigned(BRReg.Browser) and Assigned(BRReg.Browser.Mainframe) then
      begin
        CodeStr := CodeStr + '$("input[name=\"login\"]").val("' + yalog + '");';
        CodeStr := CodeStr + '$("input[name=\"passwd\"]").val("' +
          yapas + '");';
        CodeStr := CodeStr + '$(".b-form-button__input").click();';
        BRReg.Browser.Mainframe.ExecuteJavaScript(CodeStr, 'about:blank', 0);
      end;
    end;
    // YaTimer.Interval := 3000 + random(2000);
    if iTimer = 3 then
    begin
      YaTimer.Enabled := false;
      st := 1;
      Finality.Enabled := true;
    end;
    // ShowMessage(inttostr(iTimer));
  end;
end;

procedure TForm1.ZagotovkiClick(Sender: TObject);
var
  ClipBoard: TClipboard;
begin
  if Zagotovki.Lines.Strings[Zagotovki.CaretPos.Y] <> '' then
  begin
    ClipBoard := TClipboard.Create;
    ClipBoard.SetTextBuf
      (PWideChar(Pwidestring(Zagotovki.Lines.Strings[Zagotovki.CaretPos.Y])));
  end;
end;

function TForm1.TakeInner(s: string): string;
var
  i: integer;
begin
  for i := 2 to ParsObjs.obji - 1 do
  begin
    if AnsiPos(s, ParsObjs.objs[i].param) > 0 then
      break;
  end;
  TakeInner := ParsObjs.objs[i].innerTxt;
end;

procedure TForm1.FinalityTimer(Sender: TObject); // ТАЩИ!!!!  tash
var
  i, j, ii, kk, km, f, kd, kr, jj, sk, indr, vsya, sl1, SL2, sl3, z2, zn, zp, r,
    q, ft: integer;
  ll, mm, nn, pp: integer;
  ssk, sks, srr, sk0, d, sr, kof1, kof2, p: real;
  vr, reb, rez, rez2, vrp, method, camptype, camp: string;
  so: array [0 .. 20] of integer;
  horowo, so2, so3: array [0 .. 20] of real;
  b, captcha, mobile: boolean;
  SL, SLP, SLP2: TStringList;
begin
  if st = 0 then
  begin
    DoRK.Caption := 'Выполняется...';
    DoYaEntry;
    ft := 0;
  end
  else if st = 1 then
  begin
    TakePageCode(PageCode, BRReg);
    while length(PageCode.Text) <= 200 do //
    begin
      wait(18);
    end;
    if length(PageCode.Text) > 200 then
      st := 2;
  end
  else if st = 2 then
  begin
    ParsePage(PageCode);
    if ParsObjs.obji > 0 then
      st := 3;
      //st := 123;
    ParsObjs.Free;
  end
  else if st = 123 then
  begin
    BRReg.Load( 'https://wordstat.yandex.ru/#!/?page=2&words=iphone');
    Finality.Enabled := false;
  end
  else if st = 3 then
  begin
    if AnsiPos('b-head-userinfo__link', PageCode.Text) > 0 then
    begin
      DoSTChange(DoST);
      if lvlentry = 1 then
      begin
        PreKey.Clear;
        PreKey.Lines.Add(DoSP.Lines.Strings[0]);
      end;

      if DoST.ItemIndex = 0 then
      begin
        if DoSP.Lines.Count > 0 then
        begin
          if rsy_i = 0 then
          begin
            wordrsy := AnsiLowerCase(DoSP.Lines.Strings[SP_i]);
            rsy2.Cells[2 + SP_i * 5, 0] := wordrsy;
            rsy2.Cells[5 + SP_i * 5, 0] := '1';
            FindWord(BRReg, wordrsy);
            st := 4;
          end
          else
          begin
            if SP_i = 0 then
            begin
              for i := rsy2.RowCount - 1 downto 1 do
                if rsy2.Cells[5 + SP_i * 5, i] <> '' then
                begin
                  rsy_i := i + 1;
                  break;
                end;
              st := 7;
            end
            else
            begin
              for i := rsy2.RowCount - 1 downto 1 do
              begin
                if rsy2.Cells[5 + SP_i * 5, i] <> '' then
                begin
                  rsy_i := i;
                  st := 7;
                  break;
                end;
                if rsy2.Cells[2 + (SP_i - 1) * 5, i] <> '' then
                begin
                  rsy_i := i + 1;
                  if SP_i < DoSP.Lines.Count then
                    wordrsy := AnsiLowerCase(DoSP.Lines.Strings[SP_i])
                  else
                    wordrsy :=
                      AnsiLowerCase
                      (DoSR.Lines.Strings[SP_i - DoSP.Lines.Count]);
                  rsy2.Cells[2 + SP_i * 5, 0] := wordrsy;
                  rsy2.Cells[5 + SP_i * 5, 0] := '1';
                  FindWord(BRReg, wordrsy);
                  st := 4;
                  break;
                end;
              end;
              if rsy2.Cells[2 + (SP_i - 1) * 5, 0] <> '' then
              begin
                if SP_i < DoSP.Lines.Count then
                  wordrsy := AnsiLowerCase(DoSP.Lines.Strings[SP_i])
                else
                  wordrsy :=
                    AnsiLowerCase(DoSR.Lines.Strings[SP_i - DoSP.Lines.Count]);
                rsy2.Cells[2 + SP_i * 5, 0] := wordrsy;
                rsy2.Cells[5 + SP_i * 5, 0] := '1';
                FindWord(BRReg, wordrsy);
                st := 4;
              end;

            end;
          end;
        end
        else
        begin
          DoST.ItemIndex := 2;
          st := 13;
        end;
      end
      else if DoST.ItemIndex = 1 then
        st := 130
      else if DoST.ItemIndex = 2 then
        st := 13
      else if DoST.ItemIndex = 3 then
        st := 14
      else if DoST.ItemIndex = 4 then
        st := 19
      else if DoST.ItemIndex = 5 then
        st := 220
      else if DoST.ItemIndex = 6 then
        st := 22
      else if DoST.ItemIndex = 7 then
        st := 23
      else if DoST.ItemIndex = 8 then
        st := 24
      else if DoST.ItemIndex = 9 then
        st := 31
      else if DoST.ItemIndex = 10 then
        st := 32
      else if DoST.ItemIndex = 11 then
        st := 33
      else if DoST.ItemIndex = 12 then
        st := 36;
    end
    else
      st := 0;
    ft := 0;
  end
  else if st = 4 then
  begin
    TakePageCode(PageCode, BRReg);
    while PageCode.Text = '' do
    begin
      Application.ProcessMessages;
      inc(ft);
      if ft > 100 then
        st := 3;
    end;
    if PageCode.Text <> '' then
      st := 5;
  end
  else if st = 5 then
  begin
    ParsePage(PageCode);
    associate_i := 0;
    if ParsObjs.obji > 0 then
    begin
      Finality.Enabled := false;
      for i := 0 to ParsObjs.obji - 1 do
      begin
        if AnsiPos('b-word-statistics__phrases-associations',
          ParsObjs.objs[i].param) > 0 then
        begin
          associate_i := i;
          break;
        end;
      end;
      st := 6;
      Finality.Enabled := true;
    end;
  end
  else if st = 6 then
  begin
    Finality.Enabled := false;
    rsy_start := rsy2.RowCount - 1;
    lvl_start := rsy2.RowCount - 1;
    ParseRSYA('b-phrase-link__link', rsy2, true);
    ParsObjs.Free;
    rsy_end := rsy2.RowCount - 2;
    lvl_end := rsy2.RowCount - 2;
    rsy2.Cells[0, 0] := inttostr(rsy_start) + ' ' + inttostr(rsy_end);
    st := 60;
    Finality.Enabled := true;
  end
  else if st = 60 then
  begin
    Finality.Enabled := false;
    i := rsy_start;
    while i <= rsy_end do
    begin
      vr := rsy2.Cells[2 + SP_i * 5, i];
      // if (Slov(vr) > 3) or (Slov(vr) < 2) then
      if (Slov(vr) < 2) then
      begin
        DeleteARow(rsy2, i);
        dec(i);
        dec(rsy_end);
      end
      else
      begin
        SL := TStringList.Create;
        SL.Text := StringReplace(vr, ' ', #13#10, [rfReplaceAll]);
        rsy2.Cells[4 + SP_i * 5, i] := '0,5';
        for ii := 0 to SL.Count - 1 do
        begin
          if SlovoVChislo(SL[ii]) <> null then
          begin
            if chislovstr(strtoint(SL[ii]), wordrsy) then
            begin
              rsy2.Cells[4 + SP_i * 5, i] := '1';
              break;
            end;
          end
          else
          begin
            if AnsiPos(SL[ii], wordrsy) > 0 then
            begin
              rsy2.Cells[4 + SP_i * 5, i] := '1';
              break;
            end;
          end;
        end;

        kk := i + 1;
        while kk <= rsy_end do
        begin
          km := KrossDel(vr, rsy2.Cells[2 + SP_i * 5, kk]);
          if km = 1 then
          begin
            DeleteARow(rsy2, i);
            dec(rsy_end);
            dec(i);
            break;
          end
          else if km = 2 then
          begin
            DeleteARow(rsy2, kk);
            dec(rsy_end);
            dec(kk);
          end;
          if kk >= rsy_end then
            break;
          inc(kk);
        end;
        FreeAndNil(SL);
      end;

      if rsy2.Cells[4 + SP_i * 5, i] = '' then
        rsy2.Cells[4 + SP_i * 5, i] := '0,5';

      if i > rsy_end then
        break;
      inc(i);
    end;
    st := 7;
    lvl_end := rsy2.RowCount - 2;
    rsy2.Cells[0, 0] := inttostr(rsy_start) + ' ' + inttostr(rsy_end);
    Finality.Enabled := true;
  end
  else if st = 7 then
  begin
    wordrsy := rsy2.Cells[2 + SP_i * 5, rsy_i];
    rsy_parent := rsy2.Cells[1 + SP_i * 5, rsy_i];
    if was(rsy2, wordrsy, 1 + SP_i * 5) <> -1 then
    begin
      st := 11;
    end
    else
    begin
      FindWord(BRReg, wordrsy);
      st := 8;
      ft := 0;
    end;
  end
  else if st = 8 then
  begin
    TakePageCode(PageCode, BRReg);
    while PageCode.Text = '' do
    begin
      Application.ProcessMessages;
      inc(ft);
      if ft > 100 then
        st := 7;
    end;
    if PageCode.Text <> '' then
      st := 9;
  end
  else if st = 9 then
  begin
    ParsePage(PageCode);
    associate_i := 0;
    if ParsObjs.obji > 0 then
    begin
      Finality.Enabled := false;
      for i := 0 to ParsObjs.obji - 1 do
      begin
        if AnsiPos('b-word-statistics__phrases-associations',
          ParsObjs.objs[i].param) > 0 then
        begin
          associate_i := i;
          break;
        end;
      end;
      st := 10;
      Finality.Enabled := true;
    end;
  end
  else if st = 10 then
  begin
    Finality.Enabled := false;
    rsy_start := rsy2.RowCount - 1;
    ParseRSYA('b-phrase-link__link', rsy2, true);
    rsy_end := rsy2.RowCount - 2;
    rsy2.Cells[0, 0] := inttostr(rsy_start) + ' ' + inttostr(rsy_end);
    ParsObjs.Free;
    st := 100;
    Finality.Enabled := true;
  end
  else if st = 100 then
  begin
    Finality.Enabled := false;
    f := rsy_i;
    while rsy2.Cells[1 + SP_i * 5, f] = rsy_parent do
    begin
      dec(f);
    end;
    inc(f);
    parent_start := f;
    while rsy2.Cells[1 + SP_i * 5, f] = rsy_parent do
    begin
      inc(f);
    end;
    dec(f);
    parent_end := f;
    rsy2.Cells[0, rsy_i] := inttostr(parent_start) + ' ' + inttostr(parent_end)
      + ' ' + OtsevE.Text;

    jj := rsy_start;
    while jj <= rsy_end do
    begin
      vr := rsy2.Cells[2 + SP_i * 5, jj];
      // if (Slov(vr) > 3) or (Slov(vr) < 2) then
      if (Slov(vr) < 2) then
      begin
        DeleteARow(rsy2, jj);
        dec(jj);
        dec(rsy_end);
      end
      else
      begin
        kk := jj + 1;
        while kk <= rsy_end do
        begin
          km := KrossDel(vr, rsy2.Cells[2 + SP_i * 5, kk]);
          if km = 1 then
          begin
            DeleteARow(rsy2, jj);
            dec(rsy_end);
            dec(jj);
            break;
          end
          else if km = 2 then
          begin
            DeleteARow(rsy2, kk);
            dec(rsy_end);
            dec(kk);
          end;
          if kk >= rsy_end then
            break;
          inc(kk);
        end;
      end;
      if jj >= rsy_end then
        break;
      inc(jj);
    end;

    srr := 0;
    for kk := parent_start to parent_end do
    begin
      srr := srr + strtofloat(rsy2.Cells[4 + SP_i * 5, kk]) + 1;
    end;

    indr := 0;
    for kk := 0 to parent_start do
      if (rsy2.Cells[5 + SP_i * 5, kk] <> '') and
        (rsy2.Cells[2 + SP_i * 5, kk] = rsy2.Cells[1 + SP_i * 5, rsy_i]) then
      begin
        indr := kk;
        break;
      end;

    kd := rsy_end - rsy_start + 1;
    kr := parent_end - parent_start + 1;

    ssk := 0;
    sk := 0;
    for jj := rsy_start to rsy_end do
    begin
      reb := rsy2.Cells[2 + SP_i * 5, jj];
      SL := TStringList.Create;
      SL.Text := StringReplace(reb, ' ', #13#10, [rfReplaceAll]);
      sks := 0;
      for kk := parent_start to parent_end do
      begin
        vsya := 0;
        sl1 := 0;
        SL2 := 0;
        sl3 := 0;
        if (AnsiPos(reb, rsy2.Cells[2 + SP_i * 5, kk]) > 0) or
          (AnsiPos(rsy2.Cells[2 + SP_i * 5, kk], reb) > 0) then
        begin
          vsya := vsya + 1;
        end;
        for ii := 0 to SL.Count - 1 do
        begin
          if SlovoVChislo(SL[ii]) <> null then
          begin
            if chislovstr(strtoint(SL[ii]), rsy2.Cells[2 + SP_i * 5, kk]) then
            begin
              if ii = 0 then
                sl1 := sl1 + 1;
              if ii = 1 then
                SL2 := SL2 + 1;
              if ii = 3 then
                sl3 := sl3 + 1;
            end;
          end
          else
          begin
            if (AnsiPos(SL[ii], rsy2.Cells[2 + SP_i * 5, kk]) > 0) then
            begin
              if ii = 0 then
                sl1 := sl1 + 1;
              if ii = 1 then
                SL2 := SL2 + 1;
              if ii = 3 then
                sl3 := sl3 + 1;
            end;
          end;
        end;
        sk0 := vsya * (SL.Count - 1) + (sl1 + SL2 + sl3 - vsya) /
          (SL.Count - 1);
        sks := sks + sk0;
      end;
      if sks > 1 then
        sk := sk + 1;
      sks := (sks + 1) / (kr + 1);
      ssk := ssk + sks;
      rsy2.Cells[4 + SP_i * 5, jj] := floattostrF(sks, ffFixed, 6, 2);

      FreeAndNil(SL);
    end;
    ssk := ssk / kd;
    d := sk / kd;
    sr := (strtofloat(rsy2.Cells[4 + SP_i * 5, rsy_i]) + 1) * kr / srr;
    kof1 := strtofloat(rsy2.Cells[5 + SP_i * 5, indr]);
    kof2 := ssk * sr * d * kof1;
    p := strtoint(OtsevE.Text) / 100.00;
    rsy2.Cells[5 + SP_i * 5, rsy_i] := floattostrF(kof2, ffFixed, 6, 2);

    if (d > p) and (kof2 >= p) then
    begin
      // всё ок
    end
    else
    begin
      while rsy_end >= rsy_start do
      begin
        DeleteARow(rsy2, rsy_end);
        dec(rsy_end);
      end;
      // Minuss.Lines.Add(rsy2.Cells[1 + SP_i * 5, rsy_i]);
      DeleteARow(rsy2, rsy_i);
      dec(lvl_end);
      dec(rsy_i);
    end;

    Application.ProcessMessages;
    rsy2.Cells[0, 0] := inttostr(rsy_start) + ' ' + inttostr(rsy_end);
    st := 11;
    Finality.Enabled := true;
  end
  else if st = 11 then
  begin
    inc(rsy_i);
    if lvl_end < rsy_i then
    begin
      lvl_start := rsy_i + 1;
      lvl_end := rsy2.RowCount - 2;
      if Otsev then
      begin
        OtsevE.Text := inttostr(Ceil(OtsevT.Position * 1.5));
        OtsevT.Position := strtoint(OtsevE.Text);
        if strtoint(OtsevE.Text) > 30 then
        begin
          OtsevE.Text := '30';
          OtsevT.Position := 30;
        end;
      end;
    end;
    if rsy_i < rsy2.RowCount - 1 then
      st := 7
    else
      st := 12;
  end
  else if st = 12 then
  begin
    inc(SP_i);
    OtsevT.Position := perc_start;
    OtsevE.Text := inttostr(perc_start);
    if SP_i <= (DoSP.Lines.Count + DoSR.Lines.Count - 1) then
    begin
      rsy2.ColCount := 6 + SP_i * 5;
      st := 3;
    end
    else
    begin
      dec(SP_i);
      st := 130;
      if not rezhimautobool then
      begin
        DoRK.Caption := 'Продолжить...';
        Finality.Enabled := false;
      end;
    end;
  end
  else if st = 130 then
  begin
    DoST.ItemIndex := 1;
    { if not dobbool then
      if strk=0 then
      begin
      with HideLCont do
      for jj := strk+1 to ControlCount - 1 do
      if (Controls[jj] is TMemo) then
      if (AnsiPos('Memo',(Controls[jj] as TMemo).Name)=1) and
      (strtoint(Copy((Controls[jj] as TMemo).Name, 5, 2)) > 9) then
      PreKey.Text := PreKey.Text + (Controls[jj] as TMemo).Text;
      end
      else
      begin
      with HideLCont do
      for jj := strk-1 to ControlCount - 1 do
      if (Controls[jj] is TMemo) then
      if (AnsiPos('Memo',(Controls[jj] as TMemo).Name)=1) and
      (strtoint(Copy((Controls[jj] as TMemo).Name, 5, 2)) > 9) then
      PreKey.Text := PreKey.Text + (Controls[jj] as TMemo).Text;
      end; }
    st := 13;
    if not rezhimautobool then
    begin
      DoRK.Caption := 'Продолжить...';
      Finality.Enabled := false;
    end;
  end
  else if st = 13 then
  begin // gggg
    Finality.Enabled := false;
    DoST.ItemIndex := 2;
    HideLTopClick(HideLTop);
    for i := 0 to rsy2.RowCount - 1 do
    begin
      for j := 0 to DoSP.Lines.Count - 1 do
      begin
        if rsy2.Cells[5 + j * 5, i] <> '' then
        begin
          PreKey.Lines.Add(rsy2.Cells[2 + j * 5, i]);
        end;
      end;
    end;
    if PreKey.Lines.Count > 0 then
    begin
      // Absing(PreKey, LoadBar2);
      Clearing2Pos(PreKey, Numbers, ClearChisloC.Checked,
        MinDlSlovT.Position, LoadBar);
      PreKey.Lines.SaveToFile(ExtractfilePath(Application.ExeName) + 'Projects/'
        + code + '/' + code + '_PreKey.txt');
      Clearing2P(PreKey, Minuss, ClearChisloC.Checked, SovT.Position,
        MinDlSlovT.Position, LoadBar2);
      PreKey.Lines.SaveToFile(ExtractfilePath(Application.ExeName) + 'Projects/'
        + code + '/' + code + '_PreKey.txt');
      Clearing2P(PreKey, MyMinuss, ClearChisloC.Checked, SovT.Position,
        MinDlSlovT.Position, LoadBar2);
      PreKey.Lines.SaveToFile(ExtractfilePath(Application.ExeName) + 'Projects/'
        + code + '/' + code + '_PreKey.txt');
      Clearing2P(PreKey, Cities, ClearChisloC.Checked, SovT.Position,
        MinDlSlovT.Position, LoadBar2);
      PreKey.Lines.SaveToFile(ExtractfilePath(Application.ExeName) + 'Projects/'
        + code + '/' + code + '_PreKey.txt');
      { Clearing2Pos(PreKey, InCities, ClearChisloC.Checked, MinDlSlovT.Position);
        PreKey.Lines.SaveToFile(ExtractfilePath(Application.ExeName) + 'Projects/' +
        code + '/' + code + '_PreKey.txt'); }
      Clearing3(PreKey, LoadBar);
      NoDuplicate2(PreKey);
      PreKey.Lines.SaveToFile(ExtractfilePath(Application.ExeName) + 'Projects/'
        + code + '/' + code + '_PreKey.txt');
      { for i := 0 to PreKey.Lines.Count - 1 do
        begin
        poisk.Cells[0, i]:= inttostr(i);
        poisk.Cells[1, i]:= PreKey.Lines.Strings[i];
        end; }
      st := 14;
    end
    else
    begin
      DoError.Caption :=
        'Предварительных ключей нет! Заполните поля выше, либо функцией PRO';
      st := 0;
      Finality.Enabled := false;
      DoRK.Caption := 'Запустить';
    end;

    if not rezhimautobool then
    begin
      DoRK.Caption := 'Продолжить...';
      Finality.Enabled := false;
    end
    else
      Finality.Enabled := true;
  end
  else if st = 14 then
  begin
    Finality.Enabled := false;
    if PreKey.Lines.Count > 0 then
    begin
      statControl := false;
      DoST.ItemIndex := 3;
      word_stat := 1;
      LoadBar2.max := PreKey.Lines.Count;
      clickFind;
      st := 15;
      ft := 0;
      //Finality.Enabled := true;
    end
    else
    begin
      DoError.Caption :=
        'Предварительных ключей нет! Заполните поля выше, либо функцией PRO';
      st := 0;
      Finality.Enabled := false;
      DoRK.Caption := 'Запустить';
    end;
  end
  else if st = 15 then
  begin
    TakePageCode(PageCode, BRReg);

    while length(PageCode.Text) <= 200 do
    begin
      wait(30);
    end;
    if length(PageCode.Text) > 200 then
      st := 16;
  end
  else if st = 16 then
  begin
    ParsePage(PageCode);
    associate_i := 0;
    truepage := false;
    truefind := false;
    if ParsObjs.obji > 0 then
    begin
      Finality.Enabled := false;
      for i := 0 to ParsObjs.obji - 1 do
      begin
        if AnsiPos('b-word-statistics__info', ParsObjs.objs[i].param) > 0 then
        begin
          if AnsiPos('Что искали', ParsObjs.objs[i].innerTxt) > 0 then
          begin // AnsiPos('пок')
            vr := Copy(ParsObjs.objs[i].innerTxt,
              AnsiPos('—', ParsObjs.objs[i].innerTxt) + 7,
              length(ParsObjs.objs[i].innerTxt) - AnsiPos('—',
              ParsObjs.objs[i].innerTxt) - 1);
            vr := Copy(vr, 1, AnsiPos('пок', vr) - 2);
            StringReplace(vr, '&nbsp;', '', [rfReplaceAll]);
            if strtoint(vr) > perc_start * 10 then
              truefind := true;
          end;
        end;
        if (AnsiPos('b-form-input__input',
          ParsObjs.objs[i].param) > 0) and (AnsiPos('id="uniq',
          ParsObjs.objs[i].param) > 0) and (AnsiPos('name="text"',
          ParsObjs.objs[i].param) > 0) then
        begin
          vr := Copy(ParsObjs.objs[i].param,  AnsiPos('uniq', ParsObjs.objs[i].param) + 4,
              length(ParsObjs.objs[i].param) - AnsiPos('uniq', ParsObjs.objs[i].param) - 3);
          uniq := Copy(vr, 1, AnsiPos('"', vr) - 1);
          //ShowMessage(vr);
        end;
        if AnsiPos('b-word-statistics__phrases-associations',
          ParsObjs.objs[i].param) > 0 then
        begin
          associate_i := i;
        end;
        if AnsiPos('b-word-statistics__info', ParsObjs.objs[i].param) > 0 then
        begin
          if AnsiPos(PreKey.Lines.Strings[word_i], ParsObjs.objs[i].innerTxt) > 0
          then
            truepage := true;
        end;
        if AnsiPos('b-pager__next', ParsObjs.objs[i].param) > 0 then
        begin
          if AnsiPos('b-pager__inactive', ParsObjs.objs[i - 1].param) > 0 then
            truenextpage := false;
          if AnsiPos('b-pager__active', ParsObjs.objs[i - 1].param) > 0 then
            truenextpage := true;
        end;
      end;
      if truepage then
        st := 17
      else
        st := 18;
      Finality.Enabled := true;
    end
    else
    begin
      st := 14;
    end;
  end
  else if st = 17 then
  begin
    Finality.Enabled := false;
    ParseAuto('b-phrase-link__link', b);
    if b then
    begin
      if statControl then
        st := 18
      else
      begin
        if truenextpage then
          st := 170
        else
          st := 18;
      end;
      Finality.Enabled := true;
    end
    else
    begin
      ShowMessage('asd');
    end;
  end
  else if st = 170 then
  begin // iii
    ParsObjs.Free;
    inc(pages_i);
    nextPageA;
    st := 15;
  end
  else if st = 171 then
  begin // iii
    ParsObjs.Free;
    inc(pages_i);
    nextPageA;
    st := 15;
  end
  else if st = 18 then
  begin
    ParsObjs.Free;
    inc(word_i);
    LoadBar2.Position := word_i;
    if word_i < PreKey.Lines.Count then
    begin
      pages_i := 1;
      st := 14
    end
    else
    begin
      st := 19;
      if not rezhimautobool then
      begin
        DoRK.Caption := 'Продолжить...';
        Finality.Enabled := false;
      end;
    end;
  end
  else if st = 19 then // poiskkk
  begin
    Finality.Enabled := false;
    if KeyPhraze.Lines.Count > 0 then
    begin
      DoST.ItemIndex := 4;
      SaveTable(poisk, code, '_poisk');
      KeyCollector.Lines.SaveToFile(ExtractfilePath(Application.ExeName) +
        'Projects/' + code + '/' + code + '_keys.txt');
      st := 21;
      Finality.Enabled := true;
    end
    else
    begin
      DoST.ItemIndex := 3;
      st := 0;
      word_i := 0;
      DoError.Caption :=
        'Ключевых фраз нет! Выберите другие базовые ключевики или повторите снова.';
      DoRK.Caption := 'Запустить';
    end;
  end
  else if st = 21 then
  begin
    Finality.Enabled := false;
    TakeList(KeyCollector, poisk, 4);
    Clearing2P2(KeyCollector, Minuss, poisk, 4, ClearChisloC.Checked,
      SovT.Position, MinDlSlovT.Position, LoadBar2);
    KeyCollector.Lines.SaveToFile(ExtractfilePath(Application.ExeName) +
      'Projects/' + code + '/' + code + '_keys.txt');
    if lvlentry = 1 then
    begin
      st := 220;
    end
    else
    begin
      Clearing2Pos2(KeyCollector, Numbers, poisk, ClearChisloC.Checked,
        MinDlSlovT.Position, LoadBar2);
      KeyCollector.Lines.SaveToFile(ExtractfilePath(Application.ExeName) +
        'Projects/' + code + '/' + code + '_keys.txt');
      Clearing2P2(KeyCollector, Cities, poisk, 4, ClearChisloC.Checked,
        SovT.Position, MinDlSlovT.Position, LoadBar2);
      KeyCollector.Lines.SaveToFile(ExtractfilePath(Application.ExeName) +
        'Projects/' + code + '/' + code + '_keys.txt');
      Clearing32(KeyCollector, poisk, 4, LoadBar2);
      NoDuplicate2T(KeyCollector, poisk); // отключаем дубликаты от показов
      KeyCollector.Lines.SaveToFile(ExtractfilePath(Application.ExeName) +
        'Projects/' + code + '/' + code + '_keys.txt');
      st := 220;
    end;

    if not rezhimautobool then
    begin
      DoRK.Caption := 'Продолжить...';
      Finality.Enabled := false;
    end
    else
      Finality.Enabled := true;
  end
  else if st = 220 then
  begin
    Finality.Enabled := false;
    TakeList(KeyCollector, poisk, 4);
    DoST.ItemIndex := 5;
    ReplaceM.Clear;
    ObjShow(ReplaceP);
    ObjShow(LoadBarP);
    Slova(KeyCollector, Memo4, LoadBar2);
    Memo4.Lines.SaveToFile(ExtractfilePath(Application.ExeName) + 'Projects/' +
      code + '/' + code + '_diffkeys.txt');
    LoadBarP.Visible := false;

    st := 230;
    Finality.Enabled := true;
  end
  else if st = 230 then
  begin
    Finality.Enabled := false;
    ObjShow(LoadBarP);
    WordReplaceP(Memo4, KeyCollector, ReplaceM, SovT.Position,
      MinDlSlovT.Position, LoadBar, LoadBar2, ReplaceT, poisk);
    // NoDuplicate2T(KeyCollector, poisk);
    NoDuplicate3T(poisk, 4);
    SaveTable(poisk, code, '_poisk');
    ReplaceM.Clear;
    ReplaceW.Text := '';
    ReplaceR.Text := '';
    LoadBarP.Visible := false;
    ReplaceP.Visible := false;
    st := 22;
    if not rezhimautobool then
    begin
      DoRK.Caption := 'Продолжить...';
      Finality.Enabled := false;
    end
    else
      Finality.Enabled := true;
  end
  else if st = 22 then
  begin
    Finality.Enabled := false;
    DoST.ItemIndex := 6;
    TakeList(KeyCollector, poisk, 4);
    MinusCrossAdd(KeyCollector, poisk, LoadBar2);

    KeyCollector.Lines.SaveToFile(ExtractfilePath(Application.ExeName) +
      'Projects/' + code + '/' + code + '_keys.txt');
    st := 23;
    if not rezhimautobool then
    begin
      DoRK.Caption := 'Продолжить...';
      Finality.Enabled := false;
    end
    else
      Finality.Enabled := true;
  end
  else if st = 23 then
  begin
    Finality.Enabled := false;
    DoST.ItemIndex := 7;
    TakeList(KeyCollector, poisk, 4);
    MinusCrossMinT(KeyCollector, poisk, 6, LoadBar2);
    for i := 0 to poisk.RowCount - 1 do
      if poisk.Cells[5, i] = '' then
        poisk.Cells[5, i] := '0';
    SaveTable(poisk, code, '_poisk');
    st := 24;
    if not rezhimautobool then
    begin
      DoRK.Caption := 'Продолжить...';
      Finality.Enabled := false;
    end
    else
      Finality.Enabled := true;
  end
  else if st = 24 then
  begin
    Finality.Enabled := false;
    DoST.ItemIndex := 8;
    ColRowsText := poisk.RowCount;
    LoadBar2.max := ColRowsText - 1;
    if adsright_i < ColRowsText then
    begin
      if poisk.Cells[5, adsright_i] = '1' then
      begin
        if adsright_i > 0 then
        begin
          if (poisk.Cells[7, adsright_i] <> '') and
            (poisk.Cells[9, adsright_i] <> '') then
          begin
            st := 28;
          end
          else
          begin
            if FastTextAdsCh.Checked then
            begin
              r := wasstrfullT2(poisk.Cells[1, adsright_i], poisk, 1, 0,
                adsright_i - 1);
              if r > -1 then
              begin
                poisk.Cells[7, adsright_i] := poisk.Cells[7, r];
                poisk.Cells[9, adsright_i] := poisk.Cells[9, r];
                AdsRight.Lines.Add(String(DelSpace(poisk.Cells[9, r])));
                AdsRightZags.Lines.Add(String(DelSpace(poisk.Cells[7, r])));
                st := 28;
              end
              else
              begin
                adstextword := poisk.Cells[2, adsright_i];
                PasteAds;
                st := 25;
              end;
            end
            else
            begin
              adstextword := poisk.Cells[2, adsright_i];
              PasteAds;
              st := 25;
            end;
          end;
        end
        else
        begin
          adstextword := poisk.Cells[1, adsright_i];
          PasteAds;
          st := 25;
        end;
      end
      else
      begin
        inc(adsright_i);
        LoadBar2.Position := adsright_i;
      end;
    end
    else
    begin
      st := 31;
    end;
    ft := 0;
    Finality.Enabled := true;
  end
  else if st = 25 then
  begin
    TakePageCode(PageCode, BRReg);
    while PageCode.Text = '' do
    begin
      Application.ProcessMessages;
      inc(ft);
      if ft > 100 then
        st := 0;
    end;
    if PageCode.Text <> '' then
      st := 26;
  end
  else if st = 26 then
  begin
    ParsePage(PageCode);
    LocalZag.Clear;
    LocalText.Clear;
    if ParsObjs.obji > 12 then
    begin
      Finality.Enabled := false;
      captcha := false;
      for i := 0 to ParsObjs.obji - 1 do
      begin
        if AnsiPos('ad-link', ParsObjs.objs[i].param) > 0 then
        begin
          LocalZag.Lines.Add(ParsObjs.objs[i + 3].innerTxt);
          LocalText.Lines.Add(ParsObjs.objs[i + 6].innerTxt);
        end;
        if AnsiPos('alt="captcha"', ParsObjs.objs[i].param) > 0 then
        begin
          captcha := true;
        end;
      end;

      if not captcha then
      begin
        AdsRightZags.Lines.Add('');
        AdsRightZags2.Lines.Add('');
        AdsRight.Lines.Add('');
        vr := adstextword;
        SL := TStringList.Create;
        SL.Text := StringReplace(vr, ' ', #13#10, [rfReplaceAll]);

        for i := 0 to LocalZag.Lines.Count - 1 do
        begin
          so3[i] := 0;
        end;

        kof1 := 0;
        for i := 0 to LocalZag.Lines.Count - 1 do // massiv текстов
        begin
          vrp := LocalZag.Lines.Strings[i];
          SLP := TStringList.Create;
          // текст из массива разбиваем на предложения
          SLP.Text := StringReplace(vrp, '.', #13#10, [rfReplaceAll]);
          SLP.Text := StringReplace(SLP.Text, '?', #13#10, [rfReplaceAll]);
          SLP.Text := StringReplace(SLP.Text, '!', #13#10, [rfReplaceAll]);
          zp := 0;
          if (vrp[length(vrp)] = '!') or (vrp[length(vrp)] = '?') or
            (vrp[length(vrp)] = '.') then
            zp := 1;

          for j := 0 to SLP.Count - 1 do
          // обнуление счетчика совпадений ключевика в предложении
          begin
            so2[j] := 0;
          end;

          for j := 0 to SLP.Count - 1 - zp do // обходим все предложения
          begin
            for ii := 0 to SL.Count - 1 do // обнуляем индикатор совпадений
            begin
              so[ii] := 0;
            end;

            for ii := 0 to SL.Count - 1 do // обходим ключевые слова
            begin
              if WordInStrP(SL[ii], AnsiLowerCase(SLP[j]), SovT.Position,
                MinDlSlovT.Position) then
              // включаем индикацию совпадения ключевого слова в предложении
              begin
                so[ii] := 1;
              end;
            end;

            for ii := 0 to SL.Count - 1 do // обходим ключевые слова
            begin
              so2[j] := so2[j] + so[ii];
              // считаем количество совпавших ключевых слов в предложении
            end;
            // Memo4.Lines.Add(vr + ' || ' + SLP[j] + ' || ' + floattostr(so2[j]) +              ' || ' + inttostr(Abs(sl.Count - Slov(SLP[j])) + 1) + ' || ЗАГЛ');
          end;

          for j := 0 to SLP.Count - 1 - zp do // обходим все предложения
          begin
            so3[i] := so2[j] * SL.Count /
              (Slov(SLP[j]) * (Abs(SL.Count - Slov(SLP[j])) + 1));

            if so3[i] > kof1 then
            begin
              kof1 := so3[i];
              rez := SLP[j];
              begin // Aaa zag2
                SLP2 := TStringList.Create; // predlozhenia
                SLP2.Text := StringReplace(LocalText.Lines.Strings[i], '.',
                  #13#10, [rfReplaceAll]);
                SLP2.Text := StringReplace(SLP2.Text, '?', #13#10,
                  [rfReplaceAll]);
                SLP2.Text := StringReplace(SLP2.Text, '!', #13#10,
                  [rfReplaceAll]);
                // z2:=0;
                if length(rez) + length(SLP2[0]) <= maxdlz1 + maxdlz2 then
                begin
                  // z2:=1;
                  rez2 := SLP2[0];
                end
                else
                  rez2 := '';
                // Memo4.Lines.Add(vr + ' || ' + rez + ' || ' + rez2 + ' || ' +                  floattostr(so3[i]) + ' || ЗАГЛ');
                SLP2.Free;
              end;
            end;
          end;
          SLP.Free;
        end;
        AdsRightZags.Lines.Strings[AdsRightZags.Lines.Count - 1] :=
          String(DelSpace(rez));
        poisk.Cells[7, adsright_i] := String(DelSpace(rez));

        for i := 0 to LocalText.Lines.Count - 1 do
        begin
          so3[i] := 0;
        end;

        kof1 := 0;
        for i := 0 to LocalText.Lines.Count - 1 do // massiv
        begin
          SLP := TStringList.Create; // predlozhenia
          SLP.Text := StringReplace(LocalText.Lines.Strings[i], '.', #13#10,
            [rfReplaceAll]);
          SLP.Text := StringReplace(SLP.Text, '?', #13#10, [rfReplaceAll]);
          SLP.Text := StringReplace(SLP.Text, '!', #13#10, [rfReplaceAll]);

          for j := 0 to SLP.Count - 1 do // zero predl
          begin
            so2[j] := 0;
          end;

          for j := 0 to SLP.Count - 1 do // obhod predl
          begin
            for ii := 0 to SL.Count - 1 do // zero kluch slov
            begin
              so[ii] := 0;
            end;

            for ii := 0 to SL.Count - 1 do // obhod kluch slov
            begin
              if AnsiPos(SL[ii], AnsiLowerCase(SLP[j])) > 0 then
              // slovo v predl
              begin
                so[ii] := 1;
              end;
            end;

            for ii := 0 to SL.Count - 1 do // obhod kluch slov
            begin
              so2[j] := so2[j] + so[ii]; // kol slov sovpavshih v predlozhenii
            end;
            // Memo4.Lines.Add(vr + ' || ' + SLP[j] + ' || ' + floattostr(so2[j]) +              ' || ' + inttostr(Abs(sl.Count - Slov(SLP[j])) + 1) +              ' || ТЕКСТ');
          end;

          for j := 0 to SLP.Count - 1 do
          begin
            so3[i] := so2[j] / (Slov(SLP[j]) * (SL.Count - 1) *
              (Abs(SL.Count - Slov(SLP[j])) + 1));
            if so3[i] > kof1 then
            begin
              kof1 := so3[i];
              rez := String(SLP[j]);
              // Memo4.Lines.Add(vr + ' || ' + rez + ' || ' + rez2 + ' || ' +                floattostr(so3[i]) + ' || ТЕКСТ');
            end;
          end;
          SLP.Free;
        end;
        AdsRight.Lines.Strings[AdsRight.Lines.Count - 1] :=
          String(DelSpace(rez));
        poisk.Cells[9, adsright_i] := String(DelSpace(rez));
        FreeAndNil(SL);
        st := 28;
      end
      else
      begin
        if proxybool then
          st := 666
        else
          st := 27;
      end;
    end
    else
    begin
      if proxybool then
        st := 666
      else
        st := 24;
      // st := 27;
    end;
    ParsObjs.Free;
    Finality.Enabled := true;
  end
  else if st = 666 then
  begin
    // ShowMessage('Proxy включился!');
    { if proxy_n = 0 then
      begin
      AdsBR.Load('http://spys.ru/proxys/RU/');
      st := 6661;
      end
      else
      st := 6666; }
    Finality.Enabled := false;
    ProxyEnabler.Enabled := true;
  end
  else if st = 6661 then
  begin
    TakePageCode2(PageCode, AdsBR);
    while PageCode.Text = '' do
    begin
      Application.ProcessMessages;
    end;
    if PageCode.Text <> '' then
      st := 6662;
  end
  else if st = 6662 then
  begin
    ParsePage(PageCode);
    st := 6664;
  end
  else if st = 6664 then
  begin
    if FindProxy then
    begin
      ll := 1;
      nn := 1;
      pp := 1;
      ProxyIps.Clear;
      ProxyPorts.Clear;

      for mm := 0 to ParsObjs.obji - 1 do
      begin
        if AnsiPos('spy14', ParsObjs.objs[mm].param) > 0 then
        begin
          if ll = 1 then
          begin
            ProxyIps.Lines.Add(ParsObjs.objs[mm].innerTxt);
          end;
          if ll = 4 then
            ll := 0;
          if (ParsObjs.objs[mm].innerTxt <> 'S') and
            (ParsObjs.objs[mm].innerTxt <> '+') then
            ll := ll + 1;
        end;
        if AnsiPos('spy2', ParsObjs.objs[mm].param) > 0 then
        begin
          if nn > 9 then
          begin
            if pp = 2 then
              ProxyPorts.Lines.Add(ParsObjs.objs[mm + 1].innerTxt);
            if pp = 2 then
              pp := 0;
            if (ParsObjs.objs[mm + 1].innerTxt <> '') then
              inc(pp);
          end;
          inc(nn);
        end;
      end;
    end;

    st := 6665;
  end
  else if st = 6665 then
  begin
    if proxy_n < ProxyIps.Lines.Count then
    begin
      UrlFromProxy(AdsBR, 'http://spys.ru/proxys/RU/',
        ProxyIps.Lines.Strings[proxy_n], ProxyPorts.Lines.Strings[proxy_n]);
      st := 24;
    end
    else
    begin
      proxy_n := 0;
      st := 666;
    end;
  end
  else if st = 6666 then
  begin
    proxy_n := proxy_n + 1;
    st := 6665;
  end
  else if st = 27 then
  begin
    st := 29;
  end
  else if st = 28 then
  begin
    inc(adsright_i);
    LoadBar2.Position := adsright_i;
    if adsright_i = ColRowsText then
    begin
      st := 31;
      if not rezhimautobool then
      begin
        DoRK.Caption := 'Продолжить...';
        Finality.Enabled := false;
      end;
    end
    else
      st := 24;

  end
  else if st = 29 then
  begin
    st := 24;
  end
  else if st = 31 then
  begin
    Finality.Enabled := false;
    DoST.ItemIndex := 9;

    if proxybool then
      UrlFromProxy(AdsBR, 'https://ya.ru', '', ''); // выключаем прокси

    ObjShow(LoadBarP);

    LoadBar2.max := poisk.RowCount - 1;
    for i := 0 to poisk.RowCount - 1 do
      if poisk.Cells[5, i] = '1' then
      begin
        Clearing2Pstr(poisk.Cells[7, i], Cities, ClearChisloC.Checked,
          SovT.Position, MinDlSlovT.Position, 1);
        Clearing2Pstr(poisk.Cells[9, i], Cities, ClearChisloC.Checked,
          SovT.Position, MinDlSlovT.Position, 1);
        Clearing2Pstr(poisk.Cells[7, i], Numbers, ClearChisloC.Checked,
          SovT.Position, MinDlSlovT.Position, 1);
        Clearing2Pstr(poisk.Cells[9, i], Numbers, ClearChisloC.Checked,
          SovT.Position, MinDlSlovT.Position, 1);
        LoadBar2.Position := i;
        if i mod 20 = 0 then
          Application.ProcessMessages;
      end;
    TakeList(AdsRightZags, poisk, 7);
    TakeList(AdsRight, poisk, 9);

    LoadBarP.Visible := false;
    st := 32;
    if not rezhimautobool then
    begin
      DoRK.Caption := 'Продолжить...';
      Finality.Enabled := false;
    end
    else
      Finality.Enabled := true;
  end
  else if st = 32 then
  begin
    DoST.ItemIndex := 10;
    Sheet6Click(Sheet6);
    Finality.Enabled := false;
    DoRK.Caption := 'Продолжить';
  end
  else if st = 33 then
  begin
    DoST.ItemIndex := 11;
    if candocamp then // определяется в загрузке браузера
    begin
      st := 34;
    end
    else
    begin
      Finality.Enabled := false;
      BRReg.Load('https://direct.yandex.ru/');
      // ObjShow(Browser);
    end;
    // добавить в таймер-------------------------------------------------------------
    {
      //token
      Chromium2.Load('https://oauth.yandex.ru/authorize?response_type=token&client_id=25794db0eea84b5d87cf20c1d5b583f4');
      if iTimer = 1 then
      if Assigned(Chromium2.Browser) and Assigned(Chromium2.Browser.Mainframe) then
      begin
      CodeStr := '$("#nb-2").click();';
      Chromium2.Browser.Mainframe.ExecuteJavaScript(CodeStr, 'about:blank', 0);
      end;
      if iTimer = 3 then
      if Assigned(Chromium2.Browser) and Assigned(Chromium2.Browser.Mainframe) then
      begin
      CodeStr := 'console.log("tk "+$(".js-verification-code-flow-token-output").text());';
      Chromium2.Browser.Mainframe.ExecuteJavaScript(CodeStr, 'about:blank', 0);
      end;
      iTimer := iTimer + 1;
      if iTimer=4 then
      Timer3.Enabled := false;
      //ConsoleLog
      if AnsiCompareStr(Copy(message, 1, 2), 'tk') = 0 then
      Edit6.Text := Copy(message, 3, length(Message)-2);
      //ConsoleLog
      //token

      Memo7.Lines.Add(AddCamp(IdHTTP1, camp, method, client, token, camptype, changesname, counter, Budget));
      Memo7.Lines.Add(AddGroup(IdHTTP1, camp, method, client, token, idcamp, changesname, regions, minus));
      Memo7.Lines.Add(AddVCards(IdHTTP1, camp, method, client, token, idcamp, City, Kompaniya, Phone, Ulica, dom, korpus, ofice, metro, familiya, imya, otchestvo, KontEmail, ogrn, WorkTime, Addi));
      Memo7.Lines.Add(AddFastLinks(IdHTTP1, camp, method, client, token, AdsFasts, adsfastsurl));
      Memo7.Lines.Add(AddExtensions(IdHTTP1, camp, method, client, token, AdsExt));
      Memo7.Lines.Add(AddAds(IdHTTP1, camp, method, client, token, idgroup, title, title2, text, href, DisplayUrlPath, VCardId, SitelinkSetId, AdsExtIds, Memo8, mobile));
      Memo7.Lines.Add(AddKeywords(IdHTTP1, camp, method, client, token, idgroup, Keyword, bid, ContextBid, StrategyPriority));
    }
    // ------------------------------------------------------------------------------
  end
  else if st = 34 then
  begin
    // ShowMessage(token+ ' | ' +metrika);
    if token = '' then
    begin
      if candocamp then
      begin
        Finality.Enabled := false;
        BRReg.Load
          ('https://oauth.yandex.ru/authorize?response_type=token&client_id=25794db0eea84b5d87cf20c1d5b583f4');
      end
      else
      begin
        st := 33;
      end;
    end
    else
      st := 35;
  end
  else if st = 35 then
  begin
    // ShowMessage(token);
    if metrika = '' then
    begin
      Finality.Enabled := false;
      BRReg.Load('https://metrika.yandex.ru/list')
    end
    else
    begin
      camp_i := 0;
      group_i := 0;
      st := 36;
    end;
  end
  else if st = 36 then // cae
  begin
    Finality.Enabled := false;
    DoST.ItemIndex := 12;
    client := YaLogin.Text;

    // camp_i := 0; // перенести в сохранение в Мускл          458
    while (camp_i < poisk.RowCount - 1) and (not closebool) do
    begin
      if poisk.Cells[5, camp_i] = '1' then
      begin
        if poisk.Cells[15, camp_i] <> '' then
        begin
          for i := camp_i + 1 to poisk.RowCount - 2 do
          begin
            if (poisk.Cells[5, i] = '1') and
              (poisk.Cells[13, camp_i] = poisk.Cells[13, i]) then
            begin
              poisk.Cells[15, i] := poisk.Cells[15, camp_i];
            end;
          end;
          // st := 38;
        end
        else
        begin

          method := 'add';
          camptype := 'poisk';
          camp := 'campaigns';
          AddCamp(IdHTTP, camp, method, client, token, metrika,
            BudgetPerDay.Caption, poisk, camp_i);
          for i := camp_i + 1 to poisk.RowCount - 2 do
          begin
            if (poisk.Cells[5, i] = '1') and (poisk.Cells[15, i] = '') and
              (poisk.Cells[13, camp_i] = poisk.Cells[13, i]) then
            begin
              poisk.Cells[15, i] := poisk.Cells[15, camp_i];
            end;
          end;

          // st := 38;
          wait(DelayAdd);
        end;
      end;
      inc(camp_i);
      // ShowMessage(inttostr(camp_i));
    end;
    st := 38;
    Finality.Enabled := true;
  end
  else if st = 37 then
  begin
    // получить id кампаний
    method := 'get';
    camp := 'campaigns';
    HideMemo.Clear;
    // ParsJSON(GetCamp(IdHTTP, camp, method, client, token),  'Сampaigns', 'Id', 'Name', HideMemo);
    // AddId(poisk, HideMemo, 13, 15);
  end
  else if st = 38 then
  begin
    Finality.Enabled := false;
    while (group_i < poisk.RowCount - 1) and (not closebool) do
    begin
      if poisk.Cells[5, group_i] = '1' then
      begin
        if poisk.Cells[16, group_i] <> '' then
        begin
          for i := group_i + 1 to poisk.RowCount - 2 do
          begin
            if (poisk.Cells[5, i] = '1') and
              (poisk.Cells[15, group_i] = poisk.Cells[15, i]) and
              (poisk.Cells[14, group_i] = poisk.Cells[14, i]) then
            begin
              poisk.Cells[16, i] := poisk.Cells[16, group_i];
            end;
          end;
        end
        else
        begin
          method := 'add';
          camp := 'adgroups';
          AddGroup(IdHTTP, camp, method, client, token, regions, MyMinuss,
            poisk, group_i);

          for i := group_i + 1 to poisk.RowCount - 2 do
          begin // id camp      //2973369393                                                    //name group
            if (poisk.Cells[5, i] = '1') and
              (poisk.Cells[15, group_i] = poisk.Cells[15, i]) and
              (poisk.Cells[14, group_i] = poisk.Cells[14, i]) then
            begin
              poisk.Cells[16, i] := poisk.Cells[16, group_i];
            end;
          end;

          wait(DelayAdd);
        end;
      end;
      inc(group_i);
    end;
    st := 40;
    Finality.Enabled := true;
  end
  else if st = 39 then
  begin
    method := 'get';
    camp := 'adgroups';
    HideMemo.Clear;
    // ParsJSON(GetGroup(IdHTTP, camp, method, client, token, poisk),  'AdGroups', 'Id', 'Name', HideMemo);
    // AddId(poisk, HideMemo, 13, 15);
  end
  else if st = 40 then
  begin
    Finality.Enabled := false;
    while (vcard_i < poisk.RowCount - 1) and (not closebool) do
    begin
      if poisk.Cells[5, vcard_i] = '1' then
      begin
        if poisk.Cells[23, vcard_i] = '' then
        begin
          method := 'add';
          camp := 'vcards'; // тут конечно изменить, но пока пойдет

          AddVCards(IdHTTP, camp, method, client, token, City.Text,
            Kompaniya.Text, Phone.Text, Ulica.Text, dom.Text, korpus.Text,
            ofice.Text, metro.Text, familiya.Text, imya.Text, otchestvo.Text,
            KontEmail.Text, ogrn.Text, WorkTime, Addi, poisk, vcard_i);

          for i := vcard_i + 1 to poisk.RowCount - 2 do
          begin
            if (poisk.Cells[5, i] = '1') and
              (poisk.Cells[15, vcard_i] = poisk.Cells[15, i]) then
            begin
              poisk.Cells[23, i] := poisk.Cells[23, vcard_i];
            end;
          end;

          wait(DelayAdd);
        end
        else
        begin
          for i := vcard_i + 1 to poisk.RowCount - 2 do
          begin
            if (poisk.Cells[5, i] = '1') and
              (poisk.Cells[15, vcard_i] = poisk.Cells[15, i]) then
            begin
              poisk.Cells[23, i] := poisk.Cells[23, vcard_i];
            end;
          end;
        end;
      end;
      inc(vcard_i);
    end;
    st := 42;
    Finality.Enabled := true;
  end
  else if st = 41 then
  begin

  end
  else if st = 42 then
  begin
    Finality.Enabled := false;
    if poisk.Cells[24, 0] = '' then
    begin
      method := 'add';
      camp := 'sitelinks'; // тут конечно изменить, но пока пойдет //норм

      fasts_id := AddSiteLinks(IdHTTP, camp, method, client, token,
        AdsHref.Text, AdsFasts, AdsFastUrls);

      for i := 0 to poisk.RowCount - 2 do
        poisk.Cells[24, i] := fasts_id;

      st := 44;
      wait(DelayAdd);
    end
    else
    begin
      st := 44;
    end;
    Finality.Enabled := true;
  end
  else if st = 43 then
  begin

  end
  else if st = 44 then
  begin
    Finality.Enabled := false;
    if poisk.Cells[25, 0] = '' then
    begin
      method := 'add';
      camp := 'adextensions'; // тут конечно изменить, но пока пойдет //норм

      ext_id := AddExtensions(IdHTTP, camp, method, client, token, AdsDescs);

      for i := 0 to poisk.RowCount - 1 do
        poisk.Cells[25, i] := ext_id;

      st := 46;
      wait(DelayAdd);
    end
    else
    begin
      st := 46;
    end;
    Finality.Enabled := true;
  end
  else if st = 45 then
  begin

  end
  else if st = 46 then // объявление
  begin
    Finality.Enabled := false;
    if (poisk.Cells[26, ads_i] = '') and (poisk.Cells[7, ads_i] <> '') and
      (poisk.Cells[8, ads_i] <> '') and (poisk.Cells[9, ads_i] <> '') and
      (length(poisk.Cells[7, ads_i]) <= maxdlz1) and
      (length(poisk.Cells[8, ads_i]) <= maxdlz2) and
      (length(poisk.Cells[9, ads_i] + poisk.Cells[10, ads_i] + poisk.Cells[11,
      ads_i] + poisk.Cells[12, ads_i]) <= maxdltxt) then
    begin
      mobile := false;
      method := 'add';
      camp := 'ads';
      ShowMessage(inttostr(length(poisk.Cells[9, ads_i] + poisk.Cells[10,
        ads_i] + poisk.Cells[11, ads_i] + poisk.Cells[12, ads_i])) + '!' +
        poisk.Cells[9, ads_i] + poisk.Cells[10, ads_i] + poisk.Cells[11, ads_i]
        + poisk.Cells[12, ads_i]);
      AddAds(IdHTTP, camp, method, client, token, AdsHref.Text, hrefdesc.Text,
        mobile, poisk, ads_i);

      wait(DelayAdd);
    end;
    st := 48;
    Finality.Enabled := true;
  end
  else if st = 47 then
  begin

  end
  else if st = 48 then // ключевик
  begin
    Finality.Enabled := false;
    if (poisk.Cells[17, ads_i] = '') and (poisk.Cells[4, ads_i] <> '') and
      (length(poisk.Cells[4, ads_i] + ' ' + poisk.Cells[6, ads_i]) <= AdsMaxLen)
      and (poisk.Cells[16, ads_i] <> '') then
    // and (poisk.Cells[22,ads_i] <> '') and (poisk.Cells[20,ads_i] <> '') and (poisk.Cells[21,ads_i] <> '')
    begin
      method := 'add';
      camp := 'keywords';

      AddKeywords(IdHTTP, camp, method, client, token, poisk, ads_i);

      wait(DelayAdd);
    end;
    st := 50;
    Finality.Enabled := true;
  end
  else if st = 49 then
  begin

  end
  else if st = 50 then // следующий
  begin
    inc(ads_i);
    while poisk.Cells[5, ads_i] <> '1' do
      inc(ads_i);
    if ads_i >= poisk.RowCount - 2 then
    begin
      st := 52;
      mod_s := 0;
    end
    else
      st := 46;
  end
  else if st = 52 then
  begin
    // отправить на модерацию
    if poisk.RowCount - mod_s - 10000 > 0 then
    begin
      mod_e := mod_s + 10000;
    end
    else
    begin
      mod_e := mod_s + (poisk.RowCount mod 10000);
    end;
    AdsModerate(IdHTTP, camp, method, client, token, poisk, mod_s, mod_e);
  end
  else if st = 54 then
  begin
    if mod_e < poisk.RowCount - 1 then
    begin
      mod_s := mod_e;
      st := 52
    end
    else
      st := 60;
  end
  else if st = 60 then
  begin
    Finality.Enabled := false;
    ShowMessage('Пока все');
  end;

  if (st > 24) and (st < 30) and (st <> 27) and (st <> 29) and (st <> 28) then
  begin
    if proxybool then
      Finality.Interval := 1000 + random(2000)
    else
      Finality.Interval := 3000 + random(2000);
    // всё равно капча включается, перебьём через прокси ;)
  end
  else if (st = 27) or (st = 29) then
    Finality.Interval := 500000 + random(2000)
    // это впринципе не нужно ;) теперь есть прокси 8)
  else if (st = 24) or (st = 28) or (st = 7) or (st = 11) then
    Finality.Interval := 300
  else
  begin
    if proxybool then
      Finality.Interval := 6000 + random(2000)
    else
      Finality.Interval := 3000 + random(2000);
  end;
  { if not Finality.Enabled then
    ShowMessage(inttostr(st)); }
end;

procedure TForm1.ThreeHelpClick(Sender: TObject);
var
  s: string;
begin
  if wordstat.Caption = 'Я' then
  begin
    s := 'https://wordstat.yandex.ru/#!/?regions=' + regions;
    ShellExecute(0, 'open', PWideChar(Pwidestring(s)), nil, nil, SW_SHOW);
  end
  else if wordstat.Caption = 'G' then
    ShellExecute(0, 'open', 'https://adwords.google.com/KeywordPlanner#start',
      nil, nil, SW_SHOW);
end;

procedure TForm1.ThreeHelpInfoClick(Sender: TObject);
begin
  if wordstat.Caption = 'G' then
  begin
    ThreeSheet.Visible := false;
    ObjShow(PreKeySheet);
  end;
end;

procedure TForm1.ThreeHelpMouseEnter(Sender: TObject);
var
  stri: string;
begin
  if wordstat.Caption = 'Я' then
  begin
    ThreeHelp.Color := clGradientInactiveCaption;
    Application.ProcessMessages;
    stage := 21;
    HelpZoneP.Visible := true;
    HelpZone.Clear;
    if stage = 21 then
    begin
      stri := 'В первую очередь, мы должны выбрать такие запросы, которые отображают, что клиент собирается купить этот '
        + 'товар или услугу, а не просто интересуется ими. Так мы сразу будем работать с запросами, которые приносят наибольшую '
        + 'прибыль. Например, «Где можно купить наушники в Мытищах?» — сразу видим, что у клиента есть большая потребность в покупке наушников, а не просто интерес.'
        + #13#10 +
        'Чтобы переключить с работы в яндексе на гугл наведите на Красную букву Я, затем кликните на G, обратное так же верно.';
    end;
    HelpZone.Lines.Add(stri);
  end
  else
  begin
    ThreeHelp.Color := clGradientInactiveCaption;
    Application.ProcessMessages;
    stage := 21;
    HelpZoneP.Visible := true;
    HelpZone.Clear;
    if stage = 21 then
    begin
      stri := 'Двойной клик по каждой строчке поможет выполнить некоторые действия.'
        + #13#10 +
        'Чтобы переключить с работы в гугл на яндекс наведите на Красную букву G, затем кликните на Я, обратное так же верно.';
    end;
    HelpZone.Lines.Add(stri);
  end;

end;

procedure TForm1.ThreeHelpMouseLeave(Sender: TObject);
begin
  ThreeHelp.Color := clWhite;
  HelpZoneP.Visible := false;
end;

procedure TForm1.ThreeTimerTimer(Sender: TObject);
begin
  BRReg.Load('https://direct.yandex.ru/search/?regions=' + regions + '&text=' +
    SellPhraseMemo.Lines[iSp]);
  iTimer := iTimer + 1;
  if iTimer = SellPhraseMemo.Lines.Count then
  begin
    ThreeTimer.Enabled := false;
    KonkurentP.Visible := true;
    wordstat.Caption := 'G';
    keyplanner.Caption := 'Я';
    ObjShow(GoogleHelp);
    ThreeHelpInfo.Caption := 'Настало время поработать...';
    SiteList.Lines.SaveToFile(ExtractfilePath(Application.ExeName) + 'Projects/'
      + code + '/' + code + '_sites.txt');
    RekMemo.Lines.SaveToFile(ExtractfilePath(Application.ExeName) + 'Projects/'
      + code + '/' + code + '_rek.txt');
    ZagMemo.Lines.SaveToFile(ExtractfilePath(Application.ExeName) + 'Projects/'
      + code + '/' + code + '_zag.txt');
    AdsMemo.Lines.SaveToFile(ExtractfilePath(Application.ExeName) + 'Projects/'
      + code + '/' + code + '_ads.txt');
  end;
  ThreeTimer.Interval := 3000 + random(2000);
end;

procedure TForm1.TimesClick(Sender: TObject);
begin
  TimeSliceRezult.Caption := Predpiska.Text + Times.Lines.Strings
    [Times.CaretPos.Y] + Dopiska.Text;
  ADS.Lines.Add(Predpiska.Text + Times.Lines.Strings[Times.CaretPos.Y] +
    Dopiska.Text);
end;

procedure TForm1.TreeView1MouseDown(Sender: TObject; Button: TMouseButton;
  Shift: TShiftState; X, Y: integer);
var
  Tr: TTreeView;
  Node: TTreeNode;
  Hits: THitTests;
  PStr: PString;
begin
  Tr := Sender As TTreeView;
  Hits := Tr.GetHitTestInfoAt(X, Y);
  if Not(htOnItem in Hits) then
    Exit;
  Node := Tr.GetNodeAt(X, Y);
  PStr := Node.Data;
  if PStr <> nil then
  Begin
    RegionsMI.Lines.Add(PStr^);
    Memo5.Lines.Add(Node.Text);
  End;
end;

procedure TForm1.TreeView2MouseDown(Sender: TObject; Button: TMouseButton;
  Shift: TShiftState; X, Y: integer);
var
  Tr: TTreeView;
  Node: TTreeNode;
  Hits: THitTests;
  PStr: PString;
begin
  Tr := Sender As TTreeView;
  Hits := Tr.GetHitTestInfoAt(X, Y);
  if Not(htOnItem in Hits) then
    Exit;
  Node := Tr.GetNodeAt(X, Y);
  PStr := Node.Data;
  if PStr <> nil then
    Memo5.Lines.Add(PStr^);

end;

procedure TForm1.UlicaChange(Sender: TObject);
begin
  if next_i = 15 then
    changebool := true;
end;

procedure TForm1.UTPsetPNGClick(Sender: TObject);
begin
  ObjShow(UTPSetP);
end;

procedure TForm1.UTPsetPNGMouseEnter(Sender: TObject);
begin
  LoadPNGfromRes(UTPsetPNG, 'UTP2_PNG');
end;

procedure TForm1.UTPsetPNGMouseLeave(Sender: TObject);
begin
  LoadPNGfromRes(UTPsetPNG, 'UTP_PNG');
end;

procedure TForm1.FindSitesClick(Sender: TObject);
begin
  if SellPhraseMemo.Visible then
  begin
    if SellPhraseMemo.Lines.Count = 3 then
    begin
      SellPhraseMemo.Lines.SaveToFile(ExtractfilePath(Application.ExeName) +
        'Projects/' + code + '/' + code + '_sellphrase.txt');
      iTimer := 0;
      ThreeTimer.Enabled := true;
    end
    else
    begin
      ThreeHelpInfo.Caption :=
        'Введите по одному запросу на каждой строке выше. Всего 3 запроса.';
    end;
  end;
end;

procedure TForm1.FinishPNGClick(Sender: TObject);
{ var
  r, rc, c, i, j, k, l, sts, z, dl, rowss, Rows, ks, kf, FindRes: integer;
  stri, s2, s3, s4, s5, vr, rt: string;
  sl, SL2: TStringList;
  sr: TSearchRec;
  exReng: variant; }
var
  i, r, r2, j, rg, rg2: integer;
  campname, groupname, vr: string;
begin
  for i := 0 to poisk.RowCount - 2 do
  begin
    poisk.Cells[10, i] := UTPch.Lines.Strings[0];
    poisk.Cells[11, i] := ADS.Lines.Strings[0];
    poisk.Cells[12, i] := CTAch.Lines.Strings[0];
    poisk.Cells[19, i] := 'poisk'; // rsya/poisk
    // poisk.Cells[18, i] := '0'; //malo pokazov?
    poisk.Cells[20, i] := floattostr(StavkaF * 0.8); // stavka
    poisk.Cells[21, i] := floattostr(StavkaF * 0.2); // stavka v setyah
    poisk.Cells[27, i] := hrefdesc.Text;
    poisk.Cells[29, i] := StavkaP.Caption; // max stavka
    poisk.Cells[30, i] := '1'; // teplota

    vr := poisk.Cells[4, i];
    for j := 1 to ProdDob.Lines.Count - 1 do
      if WordInStrP(ProdDob.Lines.Strings[j], vr, SovT.Position,
        MinDlSlovT.Position) then
      begin
        poisk.Cells[28, i] := 'ком';
        break;
      end;
    if poisk.Cells[28, i] = '' then
      for j := 0 to Cities.Lines.Count - 1 do
        if WordInStrP(AnsiLowerCase(Cities.Lines.Strings[j]), vr, SovT.Position,
          MinDlSlovT.Position) then
        begin
          poisk.Cells[28, i] := 'гео';
          break;
        end;
    if poisk.Cells[28, i] = '' then
      for j := 0 to vopros.Lines.Count - 1 do
        if WordInStrP(vopros.Lines.Strings[j], vr, SovT.Position,
          MinDlSlovT.Position) then
        begin
          poisk.Cells[28, i] := 'инф';
          break;
        end;
    if poisk.Cells[28, i] = '' then
      for j := 0 to media.Lines.Count - 1 do
        if WordInStrP(media.Lines.Strings[j], vr, SovT.Position,
          MinDlSlovT.Position) then
        begin
          poisk.Cells[28, i] := 'мед';
          break;
        end;
    if poisk.Cells[28, i] = '' then
      poisk.Cells[28, i] := 'общ';

    campname := poisk.Cells[19, i];
    if poisk.Cells[30, i] <> '' then
      campname := campname + '_' + poisk.Cells[30, i];
    campname := campname + '_' + code;
    if poisk.Cells[1, i] <> '' then
      campname := campname + '_' + poisk.Cells[1, i];
    if regions <> '' then
      campname := campname + '_' + regions;
    if poisk.Cells[28, i] = 'ком' then
      campname := campname + '_' + poisk.Cells[28, i]
    else
      campname := campname + '_общ';

    r := wasstrposTGR(campname, CountControl, 0, maxgroup, 1);
    if r > -1 then
    begin
      r2 := wasstrposTG(campname, CountControl, 0, maxgroup, 1);
      if (r2 <> r) and (r > -1) then
      begin
        // ShowMessage(inttostr(r)+' '+inttostr(r2)+' '+CountControl.Cells[0, r]);
        // break;
      end;
      if r2 > -1 then
        r := r2;
    end;

    // ShowMessage(inttostr(r)+campname);
    if r > -1 then
    begin
      // CountControl.Cells[4, 0] := inttostr(strtoint(CountControl.Cells[4, 0]) + 1);
      // campname := campname + '_' + CountControl.Cells[2, r];
    end
    else
    begin
      if strtoint(CountControl.Cells[4, 0]) < maxcamp then
      begin
        r := CountControl.RowCount - 1;
        CountControl.Cells[4, 0] :=
          inttostr(strtoint(CountControl.Cells[4, 0]) + 1);
        CountControl.Cells[2, r] := '1'; // индец камп
        // campname := campname + '_' + CountControl.Cells[2, r];
        CountControl.Cells[0, r] := campname + '_' + CountControl.Cells[2, r];
        CountControl.Cells[1, r] := 'кампании';
        CountControl.Cells[3, r] := '1'; // определитель //кампания
        CountControl.Cells[4, r] := '0'; // кол групп
        CountControl.RowCount := CountControl.RowCount + 1;
      end
      else
      begin
        ShowMessage
          ('Достигли максимума количества кампаний! Обратитесь к специалистам.');
        break;
      end;
    end;

    // groupname := CountControl.Cells[0, r] + poisk.Cells[28, i];
    groupname := campname + '_' + CountControl.Cells[2, r] + '_gr';
    rg := wasstrposTGR(groupname, CountControl, 0, maxgroup, 2);

    if rg > -1 then
    begin
      rg2 := wasstrposTG(groupname, CountControl, 0, maxgroup, 2);
      if rg2 > -1 then
        rg := rg2;
    end;

    if rg > -1 then
    begin
      if strtoint(CountControl.Cells[2, rg]) < maxgroup then
      begin
        CountControl.Cells[4, r] :=
          inttostr(strtoint(CountControl.Cells[4, r]) + 1);
        CountControl.Cells[2, rg] :=
          inttostr(strtoint(CountControl.Cells[2, rg]) + 1);
        // groupname := groupname + '_' + CountControl.Cells[2, rg];
      end
      else
      begin
        if strtoint(CountControl.Cells[4, 0]) < maxcamp then
        begin
          CountControl.Cells[4, 0] :=
            inttostr(strtoint(CountControl.Cells[4, 0]) + 1);
          CountControl.Cells[2, CountControl.RowCount - 1] :=
            inttostr(strtoint(CountControl.Cells[2, r]) + 1); // индец камп
          // campname := campname + '_' + CountControl.Cells[2, CountControl.RowCount - 1];
          CountControl.Cells[0, CountControl.RowCount - 1] := campname + '_' +
            CountControl.Cells[2, CountControl.RowCount - 1];
          CountControl.Cells[1, CountControl.RowCount - 1] := 'кампании';
          CountControl.Cells[3, CountControl.RowCount - 1] := '1';
          // определитель
          CountControl.Cells[4, CountControl.RowCount - 1] := '1'; // кол групп
          r := CountControl.RowCount - 1;
          // ShowMessage('tyt'+CountControl.Cells[2, CountControl.RowCount - 1]);
          CountControl.RowCount := CountControl.RowCount + 1;

          // CountControl.Cells[4, r] := inttostr(strtoint(CountControl.Cells[4, r]) + 1);
          rg := CountControl.RowCount - 1;
          CountControl.Cells[2, rg] := '1'; // индекс
          groupname := CountControl.Cells[0, r] + '_gr';;
          CountControl.Cells[0, rg] := groupname + '_' +
            CountControl.Cells[2, rg];
          CountControl.Cells[1, rg] := CountControl.Cells[0, r]; // родитель
          CountControl.Cells[3, rg] := '2'; // определитель
          CountControl.Cells[4, rg] := '0'; // фраз

          CountControl.RowCount := CountControl.RowCount + 1;
        end
        else
        begin
          ShowMessage
            ('Достигли максимума количества кампаний! Обратитесь к специалистам.');
          break;
        end;
      end;
    end
    else
    begin
      CountControl.Cells[4, r] :=
        inttostr(strtoint(CountControl.Cells[4, r]) + 1);
      rg := CountControl.RowCount - 1;
      CountControl.Cells[2, rg] := '1'; // индекс
      // groupname := groupname ;
      CountControl.Cells[0, rg] := groupname + '_' + CountControl.Cells[2, rg];
      CountControl.Cells[1, rg] := CountControl.Cells[0, r]; // родитель
      CountControl.Cells[3, rg] := '2'; // определитель
      CountControl.Cells[4, rg] := '0'; // фраз

      CountControl.RowCount := CountControl.RowCount + 1;
    end;
    poisk.Cells[13, i] := campname + '_' + CountControl.Cells[2, r];
    poisk.Cells[14, i] := groupname + '_' + CountControl.Cells[2, r] + '_' +
      CountControl.Cells[2, rg];
    if i mod 25 = 0 then
      Application.ProcessMessages;
  end;
end;

procedure TForm1.PhoneChange(Sender: TObject);
begin
  if next_i = 15 then
    changebool := true;
  AdsPhone.Caption := Phone.Text;
end;

procedure TForm1.PhoneKeyPress(Sender: TObject; var Key: Char);
begin
  case Key of
    #8, '0' .. '9':
    else
      Key := #0
  end;
end;

procedure TForm1.plusPNGClick(Sender: TObject);
var
  vr: string;
begin
  if WorkTime.Lines.Strings[0] <> '' then
  begin
    if (ComboBox1.ItemIndex > -1) and (ComboBox2.ItemIndex = -1) and
      (ComboBox3.ItemIndex > -1) and (ComboBox4.ItemIndex > -1) then
    begin
      vr := ComboBox1.Items.Strings[ComboBox1.ItemIndex] + ' ' +
        ComboBox3.Items.Strings[ComboBox3.ItemIndex] + '-' +
        ComboBox4.Items.Strings[ComboBox4.ItemIndex];
      if AnsiPos(vr, WorkTime.Text) = 0 then
        WorkTime.Lines.Strings[0] := WorkTime.Lines.Strings[0] + ', ' + vr;
    end;
    if (ComboBox1.ItemIndex > -1) and (ComboBox2.ItemIndex > -1) and
      (ComboBox3.ItemIndex > -1) and (ComboBox4.ItemIndex > -1) then
    begin
      if (ComboBox1.ItemIndex = ComboBox2.ItemIndex) then
      begin
        vr := ComboBox1.Items.Strings[ComboBox1.ItemIndex] + ' ' +
          ComboBox3.Items.Strings[ComboBox3.ItemIndex] + '-' +
          ComboBox4.Items.Strings[ComboBox4.ItemIndex];
        if AnsiPos(vr, WorkTime.Text) = 0 then
          WorkTime.Lines.Strings[0] := WorkTime.Lines.Strings[0] + ', ' + vr;
      end
      else
      begin
        vr := ComboBox1.Items.Strings[ComboBox1.ItemIndex] + '-' +
          ComboBox2.Items.Strings[ComboBox2.ItemIndex] + ' ' +
          ComboBox3.Items.Strings[ComboBox3.ItemIndex] + '-' +
          ComboBox4.Items.Strings[ComboBox4.ItemIndex];
        if AnsiPos(vr, WorkTime.Text) = 0 then
          WorkTime.Lines.Strings[0] := WorkTime.Lines.Strings[0] + ', ' + vr;
      end;
    end;
  end
  else
  begin
    if (ComboBox1.ItemIndex > -1) and (ComboBox2.ItemIndex = -1) and
      (ComboBox3.ItemIndex > -1) and (ComboBox4.ItemIndex > -1) then
    begin
      vr := ComboBox1.Items.Strings[ComboBox1.ItemIndex] + ' ' +
        ComboBox3.Items.Strings[ComboBox3.ItemIndex] + '-' +
        ComboBox4.Items.Strings[ComboBox4.ItemIndex];
      if AnsiPos(vr, WorkTime.Text) = 0 then
        WorkTime.Lines.Add(vr);
    end;
    if (ComboBox1.ItemIndex > -1) and (ComboBox2.ItemIndex > -1) and
      (ComboBox3.ItemIndex > -1) and (ComboBox4.ItemIndex > -1) then
    begin
      if (ComboBox1.ItemIndex = ComboBox2.ItemIndex) then
      begin
        vr := ComboBox1.Items.Strings[ComboBox1.ItemIndex] + ' ' +
          ComboBox3.Items.Strings[ComboBox3.ItemIndex] + '-' +
          ComboBox4.Items.Strings[ComboBox4.ItemIndex];
        if AnsiPos(vr, WorkTime.Text) = 0 then
          WorkTime.Lines.Add(vr);
      end
      else
      begin
        vr := ComboBox1.Items.Strings[ComboBox1.ItemIndex] + '-' +
          ComboBox2.Items.Strings[ComboBox2.ItemIndex] + ' ' +
          ComboBox3.Items.Strings[ComboBox3.ItemIndex] + '-' +
          ComboBox4.Items.Strings[ComboBox4.ItemIndex];
        if AnsiPos(vr, WorkTime.Text) = 0 then
          WorkTime.Lines.Add(vr);
      end;
    end;
  end;
end;

procedure TForm1.PoiskBut3Click(Sender: TObject);
var
  s: string;
begin

  s := 'https://wordstat.yandex.ru/#!/?regions=' + regions + '&words=' +
    StringReplace(PoiskWord.Caption, ' ', '%20', [rfReplaceAll]);
  ShellExecute(0, 'open', PWideChar(Pwidestring(s)), nil, nil, SW_SHOW);
end;

procedure TForm1.poiskClick(Sender: TObject);
var
  i, ii: integer;
begin
  for i := 0 to poisk.RowCount - 1 do
    for ii := 0 to poisk.ColCount - 1 do
      if poisk.ColWidths[ii] < poisk.Canvas.TextWidth(poisk.Cells[ii, i] + ' ')
      then
        poisk.ColWidths[ii] := poisk.Canvas.TextWidth(poisk.Cells[ii, i] + ' ');
end;

procedure TForm1.PrClearChange(Sender: TObject);
begin
  PrClearE.Text := inttostr(PrClear.Position);
end;

procedure TForm1.HidePreKeyIMouseEnter(Sender: TObject);
begin
  LoadPNGfromRes(HidePreKeyI, 'PreKey_PNG');
end;

procedure TForm1.HidePreKeyIMouseLeave(Sender: TObject);
begin
  LoadPNGfromRes(HidePreKeyI, 'PreKey2_PNG');
end;

procedure TForm1.HidePreKeyMClick(Sender: TObject);
Var
  sr: TSearchRec;
  FindRes, rowss, i, j: integer;
begin
  ObjShow(LoadScreen);
  HideMemo.Clear;
  FindRes := FindFirst(ExtractfilePath(Application.ExeName) + 'Projects/' + code
    + '/csv from google/*.csv', faAnyFile, sr);
  while FindRes = 0 do
  begin
    HideMemo.Lines.Add(sr.name);
    FindRes := FindNext(sr);
  end;

  for j := 0 to HideMemo.Lines.Count - 1 do
  begin
    ExBook := Excel.WorkBooks.Open(ExtractfilePath(Application.ExeName) +
      'Projects/' + code + '/csv from google/' + HideMemo.Lines.Strings[j]);
    ExSheet := ExBook.WorkSheets[1];
    rowss := ExSheet.UsedRange.Rows.Count + 1;
    for i := 1 to rowss - 2 do
      PreKey.Lines.Add(ExSheet.Cells[i + 1, 2]);
  end;

  PreKey.Lines.SaveToFile(ExtractfilePath(Application.ExeName) + 'Projects/' +
    code + '/' + code + '_prekey.txt');
  // PreKeyPP.Visible := true;
  ChoiseP.Visible := true;
  LoadScreen.Visible := false;
end;

procedure TForm1.HidePreKeyPoiskClick(Sender: TObject);
begin
  HideMemos;
  if not Finality.Enabled then
  begin
    TakeList(PreKey, poisk, 1);
    NoDuplicate(PreKey);
  end;
  PreKey.Visible := true;
end;

procedure TForm1.PreKeyDblClick(Sender: TObject);
var
  stri: string;
  SL: TStringList;
begin
  if HandClearP.Visible = false then
  begin
    pre_i := PreKey.CaretPos.Y;
    stri := PreKey.Lines.Strings[pre_i];
    ClearPre.Visible := true;

    SL := TStringList.Create;
    SL.Text := StringReplace(stri, ' ', #13#10, [rfReplaceAll]);
    CheckBox1.Caption := '';
    CheckBox2.Caption := '';
    CheckBox3.Caption := '';
    CheckBox4.Caption := '';
    CheckBox5.Caption := '';
    CheckBox6.Caption := '';
    CheckBox7.Caption := '';
    CheckBox1.Checked := false;
    CheckBox2.Checked := false;
    CheckBox3.Checked := false;
    CheckBox4.Checked := false;
    CheckBox5.Checked := false;
    CheckBox6.Checked := false;
    CheckBox7.Checked := false;
    CheckBox1.Enabled := false;
    CheckBox2.Enabled := false;
    CheckBox3.Enabled := false;
    CheckBox4.Enabled := false;
    CheckBox5.Enabled := false;
    CheckBox6.Enabled := false;
    CheckBox7.Enabled := false;
    if (SL.Count >= 1) then
    begin
      CheckBox1.Enabled := true;
      if (length(SL[0]) > 0) then
        CheckBox1.Caption := SL[0];
    end
    else
      CheckBox1.Checked := false;
    if (SL.Count >= 2) then
    begin
      CheckBox2.Enabled := true;
      if (length(SL[1]) > 0) then
        CheckBox2.Caption := SL[1];
    end
    else
      CheckBox2.Checked := false;
    if (SL.Count >= 3) then
    begin
      CheckBox3.Enabled := true;
      if (length(SL[2]) > 0) then
        CheckBox3.Caption := SL[2];
    end
    else
      CheckBox3.Checked := false;
    if (SL.Count >= 4) then
    begin
      CheckBox4.Enabled := true;
      if (length(SL[3]) > 0) then
        CheckBox4.Caption := SL[3];
    end
    else
      CheckBox4.Checked := false;
    if (SL.Count >= 5) then
    begin
      CheckBox5.Enabled := true;
      if (length(SL[4]) > 0) then
        CheckBox5.Caption := SL[4]
    end
    else
      CheckBox5.Checked := false;
    if (SL.Count >= 6) then
    begin
      CheckBox6.Enabled := true;
      if (length(SL[5]) > 0) then
        CheckBox6.Caption := SL[5]
    end
    else
      CheckBox6.Checked := false;
    if (SL.Count >= 7) then
    begin
      CheckBox7.Enabled := true;
      if (length(SL[6]) > 0) then
        CheckBox7.Caption := SL[6]
    end
    else
      CheckBox7.Checked := false;
    FreeAndNil(SL);
    ObjShow(HandClearP);
  end;
end;

procedure TForm1.HidePreKeyRClick(Sender: TObject);
begin
  Later.Enabled := true;
end;

procedure TForm1.HidePreKeyRMouseEnter(Sender: TObject);
begin
  PreKeyHelpP.Visible := true;
  PreKeyHelp.Text :=
    'Нажимая на кнопку "Загрузить" загрузятся подготовленные ключи на предыдущем шаге. Но скорее всего '
    + 'некоторые из этих ключей будут не релевантными - мусорными. Поэтому при загрузке список будет '
    + 'чиститься при помощи списка минус-слов. Вы можете кликнуть на "Пред ключи", чтобы загрузить '
    + 'список. А двойным кликом Вы можете почистить снова. Также двойной клик по фразе отправит ее в '
    + 'минус-слова. Двойной клик по кнопке "Загрузить" переведет Вас на следующий шаг.';

end;

procedure TForm1.HidePreKeyRMouseLeave(Sender: TObject);
begin
  PreKeyHelpP.Visible := false;
end;

procedure TForm1.HidePreKeyRSYClick(Sender: TObject);
begin
  HideMemos;
  PreKeyRSY.Visible := true;
end;

procedure TForm1.PreKeyHelpMouseEnter(Sender: TObject);
begin
  PreKeyHelpP.Visible := true;
end;

procedure TForm1.PreKeyHelpMouseLeave(Sender: TObject);
begin
  PreKeyHelpP.Visible := false;
end;

procedure TForm1.PreKeyKeyDown(Sender: TObject; var Key: Word;
  Shift: TShiftState);
begin
  if ssShift in Shift then
    PreKey.SelLength := 0;
end;

procedure TForm1.PreKeyKeyUp(Sender: TObject; var Key: Word;
  Shift: TShiftState);
begin
  PreKey.SelLength := 0;
end;

procedure TForm1.PreKeyLoadMouseEnter(Sender: TObject);
begin
  PreKeyHelp.Clear;
  PreKeyHelp.Lines.Strings[0] := 'Нажимая на кнопку "Загрузить" загрузятся' +
    'подготовленные ключи на предыдущем шаге. Но скорее' +
    'всего некоторые из этих ключей будут не' +
    'релевантными - мусорными. Поэтому при загрузке' +
    'список будет чиститься при помощи списка минус-слов.' +
    'Вы можете кликнуть на "Пред ключи", чтобы загрузить' +
    'список. А двойным кликом Вы можете почистить снова.' +
    'Также двойной клик по фразе отправит ее в минус-' +
    'слова. Двойной клик по кнопке "Загрузить" переведет Вас на' +
    'следующий шаг.';
  PreKeyLoadB.BevelInner := bvLowered;
  PreKeyLoadB.BevelOuter := bvRaised;
  ObjShow(PreKeyHelpP);
end;

procedure TForm1.PreKeyLoadMouseLeave(Sender: TObject);
begin
  PreKeyLoadB.BevelInner := bvNone;
  PreKeyLoadB.BevelOuter := bvNone;
  PreKeyHelpP.Visible := false;
end;

procedure TForm1.PreKeyMouseUp(Sender: TObject; Button: TMouseButton;
  Shift: TShiftState; X, Y: integer);
begin
  PreKey.SelLength := 0;
end;

procedure TForm1.PreKeyRSYDblClick(Sender: TObject);
var
  stri: string;
  SL: TStringList;
begin
  if HandClearP.Visible = false then
  begin
    stri := PreKeyRSY.Lines.Strings[PreKeyRSY.CaretPos.Y];
    SL := TStringList.Create;
    SL.Text := StringReplace(stri, ' ', #13#10, [rfReplaceAll]);
    CheckBox1.Caption := '';
    CheckBox2.Caption := '';
    CheckBox3.Caption := '';
    CheckBox4.Caption := '';
    CheckBox5.Caption := '';
    CheckBox6.Caption := '';
    CheckBox7.Caption := '';
    CheckBox1.Checked := false;
    CheckBox2.Checked := false;
    CheckBox3.Checked := false;
    CheckBox4.Checked := false;
    CheckBox5.Checked := false;
    CheckBox6.Checked := false;
    CheckBox7.Checked := false;
    CheckBox1.Enabled := false;
    CheckBox2.Enabled := false;
    CheckBox3.Enabled := false;
    CheckBox4.Enabled := false;
    CheckBox5.Enabled := false;
    CheckBox6.Enabled := false;
    CheckBox7.Enabled := false;
    if (SL.Count >= 1) then
    begin
      CheckBox1.Enabled := true;
      if (length(SL[0]) > 0) then
        CheckBox1.Caption := SL[0];
    end
    else
      CheckBox1.Checked := false;
    if (SL.Count >= 2) then
    begin
      CheckBox2.Enabled := true;
      if (length(SL[1]) > 0) then
        CheckBox2.Caption := SL[1];
    end
    else
      CheckBox2.Checked := false;
    if (SL.Count >= 3) then
    begin
      CheckBox3.Enabled := true;
      if (length(SL[2]) > 0) then
        CheckBox3.Caption := SL[2];
    end
    else
      CheckBox3.Checked := false;
    if (SL.Count >= 4) then
    begin
      CheckBox4.Enabled := true;
      if (length(SL[3]) > 0) then
        CheckBox4.Caption := SL[3];
    end
    else
      CheckBox4.Checked := false;
    if (SL.Count >= 5) then
    begin
      CheckBox5.Enabled := true;
      if (length(SL[4]) > 0) then
        CheckBox5.Caption := SL[4]
    end
    else
      CheckBox5.Checked := false;
    if (SL.Count >= 6) then
    begin
      CheckBox6.Enabled := true;
      if (length(SL[5]) > 0) then
        CheckBox6.Caption := SL[5]
    end
    else
      CheckBox6.Checked := false;
    if (SL.Count >= 7) then
    begin
      CheckBox7.Enabled := true;
      if (length(SL[6]) > 0) then
        CheckBox7.Caption := SL[6]
    end
    else
      CheckBox7.Checked := false;
    FreeAndNil(SL);
    ObjShow(HandClearP);
  end;
end;

procedure TForm1.PreKeyRSYKeyDown(Sender: TObject; var Key: Word;
  Shift: TShiftState);
begin
  if ssShift in Shift then
    PreKeyRSY.SelLength := 0;
end;

procedure TForm1.PreKeyRSYKeyUp(Sender: TObject; var Key: Word;
  Shift: TShiftState);
begin
  PreKeyRSY.SelLength := 0;
end;

procedure TForm1.PreKeyRSYMouseUp(Sender: TObject; Button: TMouseButton;
  Shift: TShiftState; X, Y: integer);
begin
  PreKeyRSY.SelLength := 0;
end;

procedure TForm1.PreMinussDblClick(Sender: TObject);
begin
  PreMinuss.Lines.Delete(PreMinuss.CaretPos.Y);
end;

procedure TForm1.PriblPNGClick(Sender: TObject);
begin
  ObjShow(WorkTimesP);
  AdsControlP.Visible := false;
  SheetList.Enabled := false;
  LoadPNGfromRes(plusPNG, 'plus_PNG');
end;

procedure TForm1.prmarzhiChange(Sender: TObject);
begin
  if (SrChek.Text <> '') and (marzha.Text <> '') and (prmarzhi.Text <> '') and
    (k1.Text <> '') and (k2.Text <> '') and (Lids.Text <> '') then
  begin
    SrCheckF := strtofloat(SrChek.Text);
    MarzhaF := strtofloat(marzha.Text);
    K3F := strtofloat(prmarzhi.Text);
    K1F := strtofloat(k1.Text);
    K2F := strtofloat(k2.Text);
    StavkaF := SrCheckF * MarzhaF * K3F * K1F * K2F * koefrazb;
    Stavka.Caption := floattostr(StavkaF);

    LidsF := strtofloat(Lids.Text);
    ClicksF := LidsF / K1F / K2F;
    clicks.Caption := floattostr(ClicksF);
    clicksperdayF := Ceil(ClicksF / 30);
    clicksperday.Caption := floattostr(clicksperdayF);
    BudgetF := StavkaF * ClicksF;
    BudgetperdayF := StavkaF * clicksperdayF;
    BudgetPerDay.Caption := floattostr(BudgetperdayF);
    Budget.Caption := floattostr(BudgetF);
    ProgDohodF := SrCheckF * LidsF * MarzhaF - BudgetF;
    ProgDohod.Caption := floattostr(ProgDohodF);
  end;
end;

procedure TForm1.prmarzhiEnter(Sender: TObject);
begin
  DecimalSeparator := ',';
end;

procedure TForm1.prmarzhiKeyPress(Sender: TObject; var Key: Char);
begin
  case Key of
    #8, '0' .. '9':
      ;

    '.', ',':
      begin
        if Key <> DecimalSeparator then
          Key := DecimalSeparator;
        if AnsiPos(DecimalSeparator, prmarzhi.Text) <> 0 then
          Key := Chr(0);
      end;
    '-':
      if length(prmarzhi.Text) <> 0 then
        Key := Chr(0);
    #13:
      Lids.SetFocus;
  else
    Key := Chr(0);
  end;
end;

procedure TForm1.ProcClearEChange(Sender: TObject);
begin
  if ProcClearE.Text <> '' then
    ProcClearT.Position := strtoint(ProcClearE.Text)
  else
  begin
    ProcClearT.Position := 1;
    ProcClearE.SelStart := length(ProcClearE.Text);
    ProcClearE.SelLength := 0;
  end;
end;

procedure TForm1.ProcClearTChange(Sender: TObject);
begin
  ProcClearE.Text := inttostr(ProcClearT.Position);
end;

procedure TForm1.proPNGMouseEnter(Sender: TObject);
begin
  LoadPNGfromRes(proPNG, 'pro2_PNG');
end;

procedure TForm1.proPNGMouseLeave(Sender: TObject);
begin
  LoadPNGfromRes(proPNG, 'pro_PNG');
end;

procedure TForm1.ProxyEnablerTimer(Sender: TObject);
var
  ll, nn, pp, mm, oo, rr, i: integer;
  ps: string;
begin
  if FindProxy then
  begin
    if st = 666 then
    begin
      AdsBR.Load('http://spys.ru/proxys/RU/');
      st := 6661;
    end
    else if st = 6661 then
    begin
      TakePageCode2(PageCode, AdsBR);
      while PageCode.Text = '' do
      begin
        Application.ProcessMessages;
      end;
      if PageCode.Text <> '' then
        st := 6662;
    end
    else if st = 6662 then
    begin
      ParsePage(PageCode);
      st := 6660;
    end
    else if st = 6660 then
    begin
      if proxy_n > 0 then
      begin
        if ParsObjs.obji > 12 then
        begin
          ProxyEnabler.Enabled := false;
          Finality.Enabled := true;
          st := 24;
          // ShowMessage(inttostr(st));
        end
        else
          st := 6667;
      end
      else
      begin
        st := 6664;
      end;
    end
    else if st = 6664 then
    begin
      ll := 1;
      nn := 1;
      pp := 1;
      oo := 1;
      rr := 1;
      ProxyIps.Clear;
      ProxyPorts.Clear;
      // ShowMessage(inttostr( ParsObjs.obji ));
      for mm := 0 to ParsObjs.obji - 1 do
      begin
        if AnsiPos('spy14', ParsObjs.objs[mm].param) > 0 then
        begin
          if ll = 1 then
          begin
            if not wasstrfullT3(ParsObjs.objs[mm].innerTxt, ProxyT, 0, 0,
              ProxyT.RowCount) then
            begin
              ProxyIps.Lines.Add(ParsObjs.objs[mm].innerTxt);
              ProxyT.Cells[0, ProxyT.RowCount - 1] := ParsObjs.objs[mm]
                .innerTxt;
            end;
          end;
          if ll = 4 then
            ll := 0;
          if (ParsObjs.objs[mm].innerTxt <> 'S') and
            (ParsObjs.objs[mm].innerTxt <> '+') then
            ll := ll + 1;
        end;
        if AnsiPos('spy2', ParsObjs.objs[mm].param) > 0 then
        begin
          if nn > 9 then
          begin
            if pp = 2 then
            begin
              ProxyPorts.Lines.Add(ParsObjs.objs[mm + 1].innerTxt);
              ProxyT.Cells[1, ProxyT.RowCount - 1] :=
                ParsObjs.objs[mm + 1].innerTxt;
            end;
            if pp = 2 then
              pp := 0;
            if (ParsObjs.objs[mm + 1].innerTxt <> '') then
              inc(pp);
          end;
          inc(nn);
        end;
        if AnsiPos('spy1', ParsObjs.objs[mm].param) > 0 then
        begin
          if oo > 6 then
          begin
            ps := '';
            if String(ParsObjs.objs[mm].innerTxt).length > 0 then
              ps := String(ParsObjs.objs[mm].innerTxt[1]);
            if (ParsObjs.objs[mm].innerTxt <> 'S') and (ps <> '(') and
              (ParsObjs.objs[mm].innerTxt <> 'HIA') and
              (ParsObjs.objs[mm].innerTxt <> '!!') and
              (ParsObjs.objs[mm].innerTxt <> '+') then
            begin
              if (rr = 5) then
              begin { }
                ProxyT.Cells[2, ProxyT.RowCount - 1] :=
                  ParsObjs.objs[mm].innerTxt;
                ProxyT.Cells[3, ProxyT.RowCount - 1] := '1';
                if ProxyT.Cells[0, ProxyT.RowCount - 1] <> '' then
                  ProxyT.RowCount := ProxyT.RowCount + 1;
              end; { }
              if rr = 13 then
                rr := 1;
              inc(rr); { }
            end;
          end;
          inc(oo);
        end;
      end;
      st := 6667;
    end
    else if st = 6667 then
    begin
      proxy_n := -1;
      // ShowMessage( ' ttt ');
      for i := 0 to ProxyT.RowCount - 1 do
      begin
        if ProxyT.Cells[3, i] = '1' then
          if strtofloat(StringReplace(ProxyT.Cells[2, i], '.', ',',
            [rfReplaceAll])) < 3 then
            proxy_n := i;
      end;

      if proxy_n > -1 then
      begin
        st := 6665;
      end
      else
      begin
        proxy_n := 0;
        st := 666;
      end;
      // ProxyEnabler.Enabled := false;
    end
    else if st = 6665 then
    begin
      // ShowMessage(inttostr(ProxyIps.Lines.Count)+'!!'+inttostr(proxy_n));
      // ShowMessage(inttostr(ProxyIps.Lines.Count));
      // UrlFromProxy(AdsBR, 'http://spys.ru/proxys/RU/', ProxyIps.Lines.Strings[proxy_n], ProxyPorts.Lines.Strings[proxy_n]);
      UrlFromProxy(AdsBR, 'http://spys.ru/proxys/RU/', ProxyT.Cells[0, proxy_n],
        ProxyT.Cells[1, proxy_n]);
      st := 666;
    end
  end
  else
  begin
    st := 24;
    ProxyEnabler.Enabled := false;
    Finality.Enabled := true;
  end;
end;

procedure TForm1.proxyPNGClick(Sender: TObject);
begin
  if proxybool then
  begin
    UrlFromProxy(AdsBR, 'https://ya.ru', '', ''); // проверить  без адреса сайта
    proxybool := false;
  end
  else
  begin
    ProxyEnabler.Enabled := true;
    proxybool := true; // наверно в таймере включать?
  end;
end;

procedure TForm1.proxyPNGMouseEnter(Sender: TObject);
begin
  LoadPNGfromRes(proxyPNG, 'proxy_PNG');
  ObjShow(PreKeyHelpP);
  PreKeyHelpP.Left := eyePNG.Left;
  PreKeyHelpP.Top := MinimizeB.Top + MinimizeB.Height + 10;
  if proxybool then
  begin
    PreKeyHelp.Text := 'Выключает использование прокси-серверов';
    if (ProxyT.Cells[0, proxy_n] <> '') and (ProxyT.Cells[1, proxy_n] <> '')
    then
      PreKeyHelp.Text := PreKeyHelp.Text + ': ' + ProxyT.Cells[0, proxy_n] + ':'
        + ProxyT.Cells[1, proxy_n];
  end
  else
    PreKeyHelp.Text := 'Включает использование прокси-серверов';
end;

procedure TForm1.proxyPNGMouseLeave(Sender: TObject);
begin
  if proxybool = false then
  begin
    LoadPNGfromRes(proxyPNG, 'proxy2_PNG');
  end;
  PreKeyHelpP.Visible := false;
end;

procedure TForm1.RadioButton1Click(Sender: TObject);
begin
  Times.Visible := true;
  Days.Visible := false;
  Months.Visible := false;
  Dopiska.Text := ' часов!';
  TimeSliceRezult.Caption := Predpiska.Text + Times.Lines.Strings[0] +
    Dopiska.Text;
end;

procedure TForm1.RadioButton2Click(Sender: TObject);
begin
  Times.Visible := false;
  Days.Visible := true;
  Months.Visible := false;
  Dopiska.Text := '!';
  TimeSliceRezult.Caption := Predpiska.Text + Days.Lines.Strings[0] +
    Dopiska.Text;
end;

procedure TForm1.RadioButton3Click(Sender: TObject);
begin
  Times.Visible := false;
  Days.Visible := false;
  Months.Visible := true;
  Dopiska.Text := '!';
  TimeSliceRezult.Caption := Predpiska.Text + Months.Lines.Strings[0] +
    Dopiska.Text;
end;

procedure TForm1.reclickTimer(Sender: TObject);
begin
  LoadImgClick(LoadImg);
  onebool := false;
  reclick.Enabled := false;
end;

procedure TForm1.rsy2Click(Sender: TObject);
var
  ii: integer;
begin
  for ii := 0 to rsy2.ColCount - 1 do
    rsy2.ColWidths[ii] := 100;
  rsy2.Width := 800;
end;

procedure TForm1.rsyClick(Sender: TObject);
var
  ii: integer;
begin
  for ii := 0 to rsy.RowCount - 1 do
  begin
    if rsy.ColWidths[0] < rsy.Canvas.TextWidth(rsy.Cells[0, ii]) then
      rsy.ColWidths[0] := rsy.Canvas.TextWidth(rsy.Cells[0, ii]) + 10;
    if rsy.ColWidths[1] < rsy.Canvas.TextWidth(rsy.Cells[1, ii]) then
      rsy.ColWidths[1] := rsy.Canvas.TextWidth(rsy.Cells[1, ii]) + 10;
    if rsy.ColWidths[2] < rsy.Canvas.TextWidth(rsy.Cells[2, ii]) then
      rsy.ColWidths[2] := rsy.Canvas.TextWidth(rsy.Cells[2, ii]) + 10;
    if rsy.ColWidths[3] < rsy.Canvas.TextWidth(rsy.Cells[3, ii]) then
      rsy.ColWidths[3] := rsy.Canvas.TextWidth(rsy.Cells[3, ii]) + 10;
    if rsy.ColWidths[4] < rsy.Canvas.TextWidth(rsy.Cells[4, ii]) then
      rsy.ColWidths[4] := rsy.Canvas.TextWidth(rsy.Cells[4, ii]) + 10;
  end;
  rsy.Width := rsy.ColWidths[0] + rsy.ColWidths[1] + rsy.ColWidths[2] +
    rsy.ColWidths[3] + rsy.ColWidths[4] + 52;
end;

initialization

ReportMemoryLeaksOnShutdown := true;

end.
