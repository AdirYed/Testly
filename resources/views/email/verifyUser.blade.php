@component('mail::message')
###### תודה על שנרשמת ל Testly!

נא ללחוץ על הלינק למטה כדי לאמת את האימייל ולהשלים את ההרשמה. אנו רק צריכים לאשר שאתה בן אדם.

@component('mail::button', ['url' => $verifyUrl])
אני בן אדם
@endcomponent

אם לא נרשמת ל Testly, נא להתעלם מאימייל זה.

##### * הטקסט בלשון זכר אך זה מכוון לשני המינים.

תודה,
<br>
Testly
@endcomponent
