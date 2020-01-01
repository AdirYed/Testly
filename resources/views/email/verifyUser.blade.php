@component('mail::message')
###### תודה על שנרשמת ל Testly!

נא ללחוץ על הלינק למטה כדי לאמת את האימייל ולהשלים את ההרשמה. אנו ניצור איתך קשר על ידי אימייל זה, לכן חשוב שתהיה לנו כתובת אימייל תקינה ומעודכנת.

@component('mail::button', ['url' => $verifyUrl])
אימות
@endcomponent

אם לא נרשמת ל Testly, נא להתעלם מאימייל זה.

תודה,
<br>
Testly
@endcomponent
