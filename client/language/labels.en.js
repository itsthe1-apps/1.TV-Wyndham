var COMMON_LABELS = [];
COMMON_LABELS.DAY_NAME = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
COMMON_LABELS.SHORT_DAY_NAME = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];
COMMON_LABELS.MONTH_NAME = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
COMMON_LABELS.SHORT_MONTH_NAME = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
COMMON_LABELS.CH_LIST_TITLE = "Select Your Favorite Channel";
COMMON_LABELS.CH_LIST_EMPTY = "There are no channels available...";
COMMON_LABELS.LOCAL_LIST_TITLE = "Local Information";
COMMON_LABELS.LOCAL_DETAIL_TITLE = "Local Information Details";
COMMON_LABELS.SERVICE_TITLE = "Guest Services";
COMMON_LABELS.RADIO_LIST_TITLE = "Listen Radio";
COMMON_LABELS.SPA_LIST_EMPTY = "The page is empty...";
COMMON_LABELS.SPA_LIST_TITLE = "Spa & Relaxation";
COMMON_LABELS.EXP_LIST_EMPTY = "The page is empty...";
COMMON_LABELS.EXP_LIST_TITLE = "Experience With Us";
COMMON_LABELS.NEWSNPROMO_LIST_TITLE = "News N Promotion With Us";
COMMON_LABELS.SERVICELIST_EMPTY = "The page is empty...";
COMMON_LABELS.SERVICELIST_TITLE = "Spa Information";
COMMON_LABELS.CH_CHOOSER_TITLE = "Select Your Favorite Channel";
COMMON_LABELS.INFOBAR_INFORMATION_UNAVAILABLE = "Information unavailable...";
COMMON_LABELS.CH_LIST_FAV = "<div class=footerImage><img src=images/rc/yellow-bt.jpg  /></div><div class=footerText> Add to Favourite&nbsp;&nbsp;&nbsp;&nbsp;  </div>";
COMMON_LABELS.CH_LIST_RMFAV = "<div class=footerImage><img src=images/rc/orange-bt.jpg  /></div><div class=footerText> Remove from Favourite&nbsp;&nbsp;&nbsp;&nbsp;  </div>";
COMMON_LABELS.CH_LIST_BACK = "<div class=footerImage><img src=images/rc/blue-bt.jpg  /></div><div class=footerText> Sub Menu&nbsp;&nbsp;&nbsp;&nbsp;</div>";
COMMON_LABELS.RADIO_LIST_FAV = "<div class=footerImage><img src=images/rc/yellow-bt.jpg  /></div><div class=footerText> Add to Favourite&nbsp;&nbsp;&nbsp;&nbsp;  </div>";
COMMON_LABELS.RADIO_LIST_BACK = "<div class=footerImage><img src=images/rc/blue-bt.jpg  /></div><div class=footerText> Sub Menu&nbsp;&nbsp;&nbsp;&nbsp;</div>";
COMMON_LABELS.VOD_LIST_BACK = "<div class=footerImage><img src=images/rc/blue-bt.jpg  /></div><div class=footerText> Sub Menu, Back&nbsp;&nbsp;&nbsp;&nbsp;</div>";
COMMON_LABELS.VOD_LIST_TITLE = "Select Your Favorite Movie";
COMMON_LABELS.VOD_LIST_EMPTY = "There are no movies available...";
COMMON_LABELS.VOD_CHOOSER_TITLE = "Select Your Favorite Movie";
COMMON_LABELS.REST_LIST_TITLE = "Restaurant Menu";
COMMON_LABELS.REST_LIST_EMPTY = "The page is empty...";
COMMON_LABELS.REST_ORDER_TITLE = "Restaurant Order Form";
COMMON_LABELS.RESTDETAIL_LIST_TITLE = "Restaurants";
COMMON_LABELS.REST_RED = "<div class=footerImage><img src=images/rc/yellow-bt.jpg  /></div><div class=footerText> View Menu&nbsp;&nbsp;&nbsp;&nbsp;    </div>";
COMMON_LABELS.REST_GREEN = "<div class=footerImage><img src=images/rc/green-bt.jpg  /></div><div class=footerText> Book a Table&nbsp;&nbsp;&nbsp;&nbsp;    </div>";
COMMON_LABELS.REST_OK = "<div class=footerImage><img src=images/rc/ok_button.jpg  /></div><div class=footerText>View Menu&nbsp;&nbsp;&nbsp;&nbsp;    </div>";
COMMON_LABELS.RC_BACK = "<div class=footerImage><img src=images/rc/blue-bt.jpg  /></div><div class=footerText> Back&nbsp;&nbsp;&nbsp;&nbsp;    </div>";
COMMON_LABELS.RC_INFO = "<div class=footerImage><img src=images/rc/info_button.png  /></div><div class=footerText> Channel Detail&nbsp;&nbsp;&nbsp;&nbsp;    </div>";
COMMON_LABELS.RC_MENU = "<div class=footerImage><img src=images/rc/menu-button.jpg  /></div><div class=footerText> Main Menu&nbsp;&nbsp;&nbsp;&nbsp;    </div>";
COMMON_LABELS.RC_EPG = "<div class=footerImage><img src=images/rc/guide-button.png  /></div><div class=footerText> EPG Menu&nbsp;&nbsp;&nbsp;&nbsp;    </div>";
COMMON_LABELS.RC_ORDER = "<div class=footerImage><img src=images/rc/ok_button.png  /></div><div class=footerText> Order.&nbsp;&nbsp;&nbsp;&nbsp;    </div>";
COMMON_LABELS.RADIO_BACK = "<div class=footerImage><img src=images/rc/blue-bt.jpg  /></div><div class=footerText> Back&nbsp;&nbsp;&nbsp;&nbsp;</div>";
COMMON_LABELS.RADIO_CHOOSER_TITLE = "Select Your Favorite Radio";
COMMON_LABELS.MSG_LIST_TITLE = "Inbox";
COMMON_LABELS.TAPE_TITLE = "World News";
COMMON_LABELS.INTERNET_CHOOSER_TITLE = "Internet";
COMMON_LABELS.MSG_OK = "<div class=footerImage><img src=images/rc/ok_button.png  /></div><div class=footerText> View Message&nbsp;&nbsp;&nbsp;&nbsp;    </div>";

function globalGetLabel(b) {
    return COMMON_LABELS[b] || b
}

function languageLoaded() {
    return true
};