@component('mail::message')
  ###### תודה על שנרשמת ל Testly!

  נא ללחוץ על הלינק למטה כדי לאמת את האימייל ולהשלים את ההרשמה. אנו רק צריכים לאשר שאתה בן אדם.

  @component('mail::button', ['url' => $verifyUrl])
    אני בן אדם
  @endcomponent

  אם אינך יכול ללחוץ על הקישור שלמעלה, פשוט העתק והדבק את הקישור הבא בדפדפן שלך.

  {{ $verifyUrl }}

  אם לא נרשמת ל Testly, נא להתעלם מאימייל זה.

  תודה,
  <br>
  Testly
@endcomponent
