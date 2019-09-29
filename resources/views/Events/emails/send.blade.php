<html xmlns="http://www.w3.org/1999/xhtml">

  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width">
    <title>Title</title>
    <link rel="stylesheet" href="{{asset('vendor/css/foundation-emails.css')}}"> </head>

  <body>
    <!-- <style> -->
    <table class="body" data-made-with-foundation="">
      <tr>
        <td class="float-center" align="center" valign="top">
          <center data-parsed="">
            <style type="text/css" align="center" class="float-center">
              body,
              html,
              .body {
                background: #f3f3f3 !important;
              }
            </style>
            <table align="center" class="container float-center">
              <tbody>
                <tr>
                  <td>
                    <table class="spacer">
                      <tbody>
                        <tr>
                          <td height="16px" style="font-size:16px;line-height:16px;">&#xA0;</td>
                        </tr>
                      </tbody>
                    </table>
                    <table class="row">
                      <tbody>
                        <tr>
                          <th class="small-12 large-12 columns first last">
                            <table>
                              <tr>
                                <th>
                                  <h1>Hello! I invite you to our {{$title}} event</h1>
                                  <p>{{$email_body}}</p>
                                  <table class="spacer">
                                    <tbody>
                                      <tr>
                                        <td height="16px" style="font-size:16px;line-height:16px;">&#xA0;</td>
                                      </tr>
                                    </tbody>
                                  </table>
                                  <table class="callout">
                                    <tr>
                                      <th class="callout-inner secondary">
                                        <table class="row">
                                          <tbody>
                                            <tr>
                                              <th class="small-12 large-6 columns first">
                                                <table>
                                                  <tr>
                                                    <th>
                                                      <p> <strong>Title</strong><br> {{$title}} </p>
                                                      <p> <strong>Start event</strong><br>  {{$start_date}} at {{$start_time}} </p>
                                                    </th>
                                                  </tr>
                                                </table>
                                              </th>
                                              <th class="small-12 large-6 columns last">
                                                <table>
                                                  <tr>
                                                    <th>
                                                      <p> <strong>Description</strong><br> {{$description}} <br> <strong>End event</strong><br> {{$end_date}} at {{$end_time}} </p>
                                                    </th>
                                                  </tr>
                                                </table>
                                              </th>
                                            </tr>
                                          </tbody>
                                        </table>
                                      </th>
                                      <th class="expander"></th>
                                    </tr>
                                  </table>
                                  
                                  <div>
                                      <p>
                                          <br>
                                          Av. Nova, 1265<br>
                                          Cidade Fantasma – CEP 023657-110<br>
                                          Cidade Nova – SP – Brasil<br>
                                          Tel.: +55 11 5252-2525
                                      </p>
                                  </div>
                                </th>
                              </tr>
                            </table>
                          </th>
                        </tr>
                      </tbody>
                    </table>
                  </td>
                </tr>
              </tbody>
            </table>
          </center>
        </td>
      </tr>
    </table>
  </body>

</html>