@component('mail::message')
  # איפוס סיסמה

  ביקשת לאפס את סיסמתך ב Testly. נא ללחוץ על הלינק למטה כדי לסיים את האיפוס.

  @component('mail::button', ['url' => $forgotPasswordUrl])
    איפוס סיסמה
  @endcomponent

  אם אינך יכול ללחוץ על הקישור שלמעלה, פשוט העתק והדבק את הקישור הבא בדפדפן שלך.

  {{ $forgotPasswordUrl }}

  הלינק בתוקף רק ליום אחד. אם התוקף יפוג, תוכל לבקש אחד חדש.

  אם לא הגשת בקשה זו, נא התעלם מאימייל זה ומחק אותו.

  תודה,
  <br>
  Testly
@endcomponent
