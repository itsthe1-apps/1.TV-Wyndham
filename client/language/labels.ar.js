var COMMON_LABELS = [];
COMMON_LABELS.DAY_NAME = ["الأحد", "الاثنين", "الثلاثاء", "الأربعاء", "الخميس", "الجمعة", "السبت"];
COMMON_LABELS.SHORT_DAY_NAME = ["الأحد", "الاثنين", "الثلاثاء", "الأربعاء", "الخميس", "الجمعة", "السبت"];
COMMON_LABELS.MONTH_NAME = ["كانون الثاني", "شباط", "آذار", "نيسان", "قد", "حزيران", "تموز", "آب", "أيلول", "تشرين الأول", "تشرين الثاني", "كانون الأول"];
COMMON_LABELS.SHORT_MONTH_NAME = ["يناير", "فبراير", "مارس", "أبريل", "قد", "يونيو", "يوليو", "أغسطس", "سبتمبر", "أكتوبر", "نوفمبر", "ديسمبر"];
COMMON_LABELS.CH_LIST_TITLE = "اختيار قناتك المفضلة";
COMMON_LABELS.CH_LIST_EMPTY = "لا توجد القنوات المتاحة...";
COMMON_LABELS.LOCAL_LIST_TITLE = "معلومات محلية";
COMMON_LABELS.LOCAL_DETAIL_TITLE = "تفاصيل المعلومات المحلية";
COMMON_LABELS.SERVICE_TITLE = "خدمات الضيوف";
COMMON_LABELS.RADIO_LIST_TITLE = "الاستماع راديو";
COMMON_LABELS.CH_CHOOSER_TITLE = "حدد القناة المفضلة لديك";
COMMON_LABELS.INFOBAR_INFORMATION_UNAVAILABLE = "المعلومات غير متوفرة...";
COMMON_LABELS.CH_LIST_FAV = "<div class=footerImage><img src=images/rc/yellow-bt.png height=35 /></div><div class=footerText>  أضف إلى المفضلة...&nbsp;&nbsp;&nbsp;&nbsp;  </div>";
COMMON_LABELS.CH_LIST_RMFAV = "<div class=footerImage><img src=images/rc/orange-bt.png height=35 /></div><div class=footerText> إزالة من المفضلة&nbsp;&nbsp;&nbsp;&nbsp;  </div>";
COMMON_LABELS.CH_LIST_BACK = "<div class=footerImage><img src=images/rc/blue-bt.png height=35 /></div><div class=footerText> القائمة الفرعية.&nbsp;&nbsp;&nbsp;&nbsp;</div>";
COMMON_LABELS.RADIO_LIST_FAV = "<div class=footerImage><img src=images/rc/yellow-bt.png height=35 /></div><div class=footerText>  أضف إلى المفضلة...&nbsp;&nbsp;&nbsp;&nbsp;  </div>";
COMMON_LABELS.RADIO_LIST_BACK = "<div class=footerImage><img src=images/rc/blue-bt.png height=35 /></div><div class=footerText>  القائمة الفرعية.&nbsp;&nbsp;&nbsp;&nbsp;</div>";
COMMON_LABELS.VOD_LIST_BACK = "<div class=footerImage><img src=images/rc/blue-bt.png height=35 /></div><div class=footerText> القائمة الفرعية&nbsp;&nbsp;&nbsp;&nbsp;</div>";
COMMON_LABELS.VOD_LIST_TITLE = "حدد الفيلم المفضل لديك";
COMMON_LABELS.VOD_LIST_EMPTY = "لا توجد الأفلام المتوفرة...";
COMMON_LABELS.VOD_CHOOSER_TITLE = "حدد الفيلم المفضل لديك";
COMMON_LABELS.REST_LIST_TITLE = "حدد مطعمك المفضل";
COMMON_LABELS.REST_LIST_EMPTY = "صفحة فارغة...";
COMMON_LABELS.REST_ORDER_TITLE = "مطعم توصيل الطلبات نموذج";
COMMON_LABELS.RESTDETAIL_LIST_TITLE = "المطاعم";
COMMON_LABELS.REST_RED = "<div class=footerImage><img src=images/rc/yellow-bt.png height=35 /></div><div class=footerText> عرض القائمة.&nbsp;&nbsp;&nbsp;&nbsp;        </div>";
COMMON_LABELS.REST_GREEN = "<div class=footerImage><img src=images/rc/green-bt.png height=35 /></div><div class=footerText> حجز طاولة&nbsp;&nbsp;&nbsp;&nbsp;    </div>";
COMMON_LABELS.REST_OK = "<div class=footerImage><img src=images/rc/ok_button.png height=35 /></div><div class=footerText>عرض القائمة&nbsp;&nbsp;&nbsp;&nbsp;    </div>";
COMMON_LABELS.RC_BACK = "<div class=footerImage><img src=images/rc/blue-bt.png height=35 /></div><div class=footerText>  القائمة السابقة.&nbsp;&nbsp;&nbsp;&nbsp; </div>";
COMMON_LABELS.RC_INFO = "<div class=footerImage><img src=images/rc/info_button.png height=35 /></div><div class=footerText>  قناة التفاصيل.&nbsp;&nbsp;&nbsp;&nbsp;       </div>";
COMMON_LABELS.RC_MENU = "<div class=footerImage><img src=images/rc/menu-button.png height=35 /></div><div class=footerText>  القائمة الرئيسية.&nbsp;&nbsp;&nbsp;&nbsp;   </div>";
COMMON_LABELS.RC_EPG = "<div class=footerImage><img src=images/rc/guide-button.png height=35 /></div><div class=footerText>  القائمة.&nbsp;&nbsp;&nbsp;&nbsp;    </div>";
COMMON_LABELS.RC_ORDER = "<div class=footerImage><img src=images/rc/ok_button.png height=35 /></div><div class=footerText> النظام.&nbsp;&nbsp;&nbsp;&nbsp;    </div>";
COMMON_LABELS.RADIO_BACK = "<div class=footerImage><img src=images/rc/blue-bt.png height=35 /></div><div class=footerText> عودة&nbsp;&nbsp;&nbsp;&nbsp;</div>";
COMMON_LABELS.MSG_LIST_TITLE = "Inbox";
COMMON_LABELS.MSG_OK = "<div class=footerImage><img src=images/rc/ok_button.png height=35 /></div><div class=footerText> عرض رسالة&nbsp;&nbsp;&nbsp;&nbsp;    </div>";
COMMON_LABELS.TAPE_TITLE = "أخبار العالم";

function globalGetLabel(b) {
    return COMMON_LABELS[b] || b
}

function languageLoaded() {
    return true
};