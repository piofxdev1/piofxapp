<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MailTemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("mail_templates")->insert([
            'id' => '1',
            'agency_id' => '1',
            'client_id' => '1',
            'user_id' => '1',
            'name' => 'template1',
            'slug' => 'slug1',
            'subject' => 'some sample subject',
            'message' => '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
            <html xmlns="http://www.w3.org/1999/xhtml">
            <head>
                <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                <meta name="viewport" content="width=device-width, initial-scale=1.0" />
                <title>[SUBJECT]</title>
                <style type="text/css">
                  @media screen and (max-width: 600px) {
                    table[class="container"] {
                      width: 95% !important;
                    }
                  }
            
                  #outlook a {
                    padding: 0;
                  }
                  body {
                    width: 100% !important;
                    -webkit-text-size-adjust: 100%;
                    -ms-text-size-adjust: 100%;
                    margin: 0;
                    padding: 0;
                  }
                  .ExternalClass {
                    width: 100%;
                  }
                  .ExternalClass,
                  .ExternalClass p,
                  .ExternalClass span,
                  .ExternalClass font,
                  .ExternalClass td,
                  .ExternalClass div {
                    line-height: 100%;
                  }
                  #backgroundTable {
                    margin: 0;
                    padding: 0;
                    width: 100% !important;
                    line-height: 100% !important;
                  }
                  img {
                    outline: none;
                    text-decoration: none;
                    -ms-interpolation-mode: bicubic;
                  }
                  a img {
                    border: none;
                  }
                  .image_fix {
                    display: block;
                  }
                  p {
                    margin: 1em 0;
                  }
                  h1,
                  h2,
                  h3,
                  h4,
                  h5,
                  h6 {
                    color: black !important;
                  }
            
                  h1 a,
                  h2 a,
                  h3 a,
                  h4 a,
                  h5 a,
                  h6 a {
                    color: blue !important;
                  }
            
                  h1 a:active,
                  h2 a:active,
                  h3 a:active,
                  h4 a:active,
                  h5 a:active,
                  h6 a:active {
                    color: red !important;
                  }
            
                  h1 a:visited,
                  h2 a:visited,
                  h3 a:visited,
                  h4 a:visited,
                  h5 a:visited,
                  h6 a:visited {
                    color: purple !important;
                  }
            
                  table td {
                    border-collapse: collapse;
                  }
            
                  table {
                    border-collapse: collapse;
                    mso-table-lspace: 0pt;
                    mso-table-rspace: 0pt;
                  }
            
                  a {
                    color: #000;
                  }
            
                  @media only screen and (max-device-width: 480px) {
                    a[href^="tel"],
                    a[href^="sms"] {
                      text-decoration: none;
                      color: black; /* or whatever your want */
                      pointer-events: none;
                      cursor: default;
                    }
            
                    .mobile_link a[href^="tel"],
                    .mobile_link a[href^="sms"] {
                      text-decoration: default;
                      color: orange !important; /* or whatever your want */
                      pointer-events: auto;
                      cursor: default;
                    }
                  }
            
                  @media only screen and (min-device-width: 768px) and (max-device-width: 1024px) {
                    a[href^="tel"],
                    a[href^="sms"] {
                      text-decoration: none;
                      color: blue; /* or whatever your want */
                      pointer-events: none;
                      cursor: default;
                    }
            
                    .mobile_link a[href^="tel"],
                    .mobile_link a[href^="sms"] {
                      text-decoration: default;
                      color: orange !important;
                      pointer-events: auto;
                      cursor: default;
                    }
                  }
            
                  @media only screen and (-webkit-min-device-pixel-ratio: 2) {
                    /* Put your iPhone 4g styles in here */
                  }
            
                  @media only screen and (-webkit-device-pixel-ratio: 0.75) {
                    /* Put CSS for low density (ldpi) Android layouts in here */
                  }
                  @media only screen and (-webkit-device-pixel-ratio: 1) {
                    /* Put CSS for medium density (mdpi) Android layouts in here */
                  }
                  @media only screen and (-webkit-device-pixel-ratio: 1.5) {
                    /* Put CSS for high density (hdpi) Android layouts in here */
                  }
                  /* end Android targeting */
                  h2 {
                    color: #181818;
                    font-family: Helvetica, Arial, sans-serif;
                    font-size: 22px;
                    line-height: 22px;
                    font-weight: normal;
                  }
                  a.link1 {
                  }
                  a.link2 {
                    color: #fff;
                    text-decoration: none;
                    font-family: Helvetica, Arial, sans-serif;
                    font-size: 16px;
                    color: #fff;
                    border-radius: 4px;
                  }
                  p {
                    color: #555;
                    font-family: Helvetica, Arial, sans-serif;
                    font-size: 16px;
                    line-height: 160%;
                  }
                </style>
            
                <script type="colorScheme" class="swatch active">
                  {
                    "name":"Default",
                    "bgBody":"ffffff",
                    "link":"fff",
                    "color":"555555",
                    "bgItem":"ffffff",
                    "title":"181818"
                  }
                </script>
              </head>
              <body>
                <!-- Wrapper/Container Table: Use a wrapper table to control the width and the background color consistently of your email. Use this approach instead of setting attributes on the body tag. -->
                <table
                  cellpadding="0"
                  width="100%"
                  cellspacing="0"
                  border="0"
                  id="backgroundTable"
                  class="bgBody"
                >
                  <tr>
                    <td>
                      <table
                        cellpadding="0"
                        width="620"
                        class="container"
                        align="center"
                        cellspacing="0"
                        border="0"
                      >
                        <tr>
                          <td>
                            <!-- Tables are the most common way to format your email consistently. Set your table widths inside cells and in most cases reset cellpadding, cellspacing, and border to zero. Use nested tables as a way to space effectively in your message. -->
            
                            <table
                              cellpadding="0"
                              cellspacing="0"
                              border="0"
                              align="center"
                              width="600"
                              class="container"
                            >
                              <tr>
                                <td class="movableContentContainer bgItem">
                                  <div class="movableContent">
                                    <table
                                      cellpadding="0"
                                      cellspacing="0"
                                      border="0"
                                      align="center"
                                      width="600"
                                      class="container"
                                    >
                                      <tr height="40">
                                        <td width="200">&nbsp;</td>
                                        <td width="200">&nbsp;</td>
                                        <td width="200">&nbsp;</td>
                                      </tr>
                                      <tr>
                                        <td width="200" valign="top">&nbsp;</td>
                                        <td width="200" valign="top" align="center">
                                          <div
                                            class="
                                              contentEditableContainer
                                              contentImageEditable
                                            "
                                          >
                                            <div class="contentEditable" align="center">
                                              <img
                                                src="https://trimitiy.com/assets/images/logo/new-logo-white.png"
                                                width="155"
                                                height="155"
                                                alt="Logo"
                                                data-default="placeholder"
                                              />
                                            </div>
                                          </div>
                                        </td>
                                        <td width="200" valign="top">&nbsp;</td>
                                      </tr>
                                      <tr height="25">
                                        <td width="200">&nbsp;</td>
                                        <td width="200">&nbsp;</td>
                                        <td width="200">&nbsp;</td>
                                      </tr>
                                    </table>
                                  </div>
            
                                  <div class="movableContent">
                                    <table
                                      cellpadding="0"
                                      cellspacing="0"
                                      border="0"
                                      align="center"
                                      width="600"
                                      class="container"
                                    >
                                      <tr>
                                        <td
                                          width="100%"
                                          colspan="3"
                                          align="center"
                                          style="padding-bottom: 10px; padding-top: 25px"
                                        >
                                          <div
                                            class="
                                              contentEditableContainer
                                              contentTextEditable
                                            "
                                          >
                                            <div class="contentEditable" align="center">
                                              <h2>Its been a while...</h2>
                                            </div>
                                          </div>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td width="100">&nbsp;</td>
                                        <td width="400" align="center">
                                          <div
                                            class="
                                              contentEditableContainer
                                              contentTextEditable
                                            "
                                          >
                                            <div class="contentEditable" align="left">
                                              <p>
                                                Hi [FirstName,there],
                                                <br />
                                                <br />
                                                Click on the link below to update your
                                                profile. If you are no longer interested in
                                                hearing from us, simply click on unsubscribe
                                                below (or ignore this message) and we wont
                                                send you any more newsletters.
                                              </p>
                                            </div>
                                          </div>
                                        </td>
                                        <td width="100">&nbsp;</td>
                                      </tr>
                                    </table>
                                    <table
                                      cellpadding="0"
                                      cellspacing="0"
                                      border="0"
                                      align="center"
                                      width="600"
                                      class="container"
                                    >
                                      <tr>
                                        <td width="200">&nbsp;</td>
                                        <td
                                          width="200"
                                          align="center"
                                          style="padding-top: 25px"
                                        >
                                          <table
                                            cellpadding="0"
                                            cellspacing="0"
                                            border="0"
                                            align="center"
                                            width="200"
                                            height="50"
                                          >
                                            <tr>
                                              <td
                                                bgcolor="#ED006F"
                                                align="center"
                                                style="border-radius: 4px"
                                                width="200"
                                                height="50"
                                              >
                                                <div
                                                  class="
                                                    contentEditableContainer
                                                    contentTextEditable
                                                  "
                                                >
                                                  <div
                                                    class="contentEditable"
                                                    align="center"
                                                  >
                                                    <a
                                                      target="_blank"
                                                      href="#"
                                                      class="link2"
                                                      >Click here to reset it</a
                                                    >
                                                  </div>
                                                </div>
                                              </td>
                                            </tr>
                                          </table>
                                        </td>
                                        <td width="200">&nbsp;</td>
                                      </tr>
                                    </table>
                                  </div>
            
                                  <div class="movableContent">
                                    <table
                                      cellpadding="0"
                                      cellspacing="0"
                                      border="0"
                                      align="center"
                                      width="600"
                                      class="container"
                                    >
                                      <tr>
                                        <td
                                          width="100%"
                                          colspan="2"
                                          style="padding-top: 65px"
                                        >
                                          <hr
                                            style="
                                              height: 1px;
                                              border: none;
                                              color: #333;
                                              background-color: #ddd;
                                            "
                                          />
                                        </td>
                                      </tr>
                                      <tr>
                                        <td
                                          width="60%"
                                          height="70"
                                          valign="middle"
                                          style="padding-bottom: 20px"
                                        >
                                          <div
                                            class="
                                              contentEditableContainer
                                              contentTextEditable
                                            "
                                          >
                                            <div class="contentEditable" align="left">
                                              <span
                                                style="
                                                  font-size: 13px;
                                                  color: #181818;
                                                  font-family: Helvetica, Arial, sans-serif;
                                                  line-height: 200%;
                                                "
                                                >Sent to [email] by
                                                [CLIENTS.COMPANY_NAME]</span
                                              >
                                              <br />
                                              <span
                                                style="
                                                  font-size: 11px;
                                                  color: #555;
                                                  font-family: Helvetica, Arial, sans-serif;
                                                  line-height: 200%;
                                                "
                                                >[CLIENTS.ADDRESS] | [CLIENTS.PHONE]</span
                                              >
                                              <br />
                                              <span
                                                style="
                                                  font-size: 13px;
                                                  color: #181818;
                                                  font-family: Helvetica, Arial, sans-serif;
                                                  line-height: 200%;
                                                "
                                              >
                                                <a
                                                  target="_blank"
                                                  href="[FORWARD]"
                                                  style="text-decoration: none; color: #555"
                                                  >Forward to a friend</a
                                                >
                                              </span>
                                              <br />
                                              <span
                                                style="
                                                  font-size: 13px;
                                                  color: #181818;
                                                  font-family: Helvetica, Arial, sans-serif;
                                                  line-height: 200%;
                                                "
                                              >
                                                <a
                                                  target="_blank"
                                                  href="[UNSUBSCRIBE]"
                                                  style="text-decoration: none; color: #555"
                                                  >click here to unsubscribe</a
                                                ></span
                                              >
                                            </div>
                                          </div>
                                        </td>
                                        <td
                                          width="40%"
                                          height="70"
                                          align="right"
                                          valign="top"
                                          align="right"
                                          style="padding-bottom: 20px"
                                        >
                                          <table
                                            width="100%"
                                            border="0"
                                            cellspacing="0"
                                            cellpadding="0"
                                            align="right"
                                          >
                                            <tr>
                                              <td width="57%"></td>
                                              <td valign="top" width="34">
                                                <div
                                                  class="
                                                    contentEditableContainer
                                                    contentFacebookEditable
                                                  "
                                                  style="display: inline"
                                                >
                                                  <div class="contentEditable">
                                                    <img
                                                      src="https://1000logos.net/wp-content/uploads/2021/04/Facebook-logo.png"
                                                      data-default="placeholder"
                                                      data-max-width="30"
                                                      data-customIcon="true"
                                                      width="60"
                                                      height="40"
                                                      alt="facebook"
                                                      style="margin-right: 40x"
                                                    />
                                                  </div>
                                                </div>
                                              </td>
                                              <td valign="top" width="34">
                                                <div
                                                  class="
                                                    contentEditableContainer
                                                    contentTwitterEditable
                                                  "
                                                  style="display: inline"
                                                >
                                                  <div class="contentEditable">
                                                    <img
                                                      src="https://i.pinimg.com/236x/b7/91/26/b79126d537c628d7ac5429f7f84ffc8e--twitter-logo-twitter-icon.jpg"
                                                      data-default="placeholder"
                                                      data-max-width="30"
                                                      data-customIcon="true"
                                                      width="45"
                                                      height="45"
                                                      alt="twitter"
                                                      style="margin-right: 40x"
                                                    />
                                                  </div>
                                                </div>
                                              </td>
                                            </tr>
                                          </table>
                                        </td>
                                      </tr>
                                    </table>
                                  </div>
                                </td>
                              </tr>
                            </table>
                          </td>
                        </tr>
                      </table>
                    </td>
                  </tr>
                </table>
                <!-- End of wrapper table -->
              </body>
            </html>',
            'status' => "1",
        ]);

        DB::table("mail_templates")->insert([
            'id' => '2',
            'agency_id' => '1',
            'client_id' => '1',
            'user_id' => '1',
            'name' => 'template2',
            'slug' => 'slug2',
            'subject' => 'some sample subject',
            'message' => '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
            <html xmlns="http://www.w3.org/1999/xhtml">
              <head>
                <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                <title>[SUBJECT]</title>
                <style type="text/css">
                  body {
                    padding-top: 0 !important;
                    padding-bottom: 0 !important;
                    padding-top: 0 !important;
                    padding-bottom: 0 !important;
                    margin: 0 !important;
                    width: 100% !important;
                    -webkit-text-size-adjust: 100% !important;
                    -ms-text-size-adjust: 100% !important;
                    -webkit-font-smoothing: antialiased !important;
                  }
                  .tableContent img {
                    border: 0 !important;
                    display: block !important;
                    outline: none !important;
                  }
                  a {
                    color: #382f2e;
                  }
            
                  p,
                  h1,
                  ul,
                  ol,
                  li,
                  div {
                    margin: 0;
                    padding: 0;
                  }
            
                  td,
                  table {
                    vertical-align: top;
                  }
                  td.middle {
                    vertical-align: middle;
                  }
            
                  a.link1 {
                    color: #ffffff;
                    font-size: 14px;
                    text-decoration: none;
                  }
            
                  a.link2 {
                    font-size: 13px;
                    color: #999999;
                    text-decoration: none;
                    line-height: 19px;
                  }
            
                  .bigger {
                    font-size: 24px;
                  }
                  .bgBody {
                    background: #dddddd;
                  }
                  .bgItem {
                    background: #ffffff;
                  }
                  h2 {
                    font-family: Georgia;
                    font-size: 36px;
                    text-align: center;
                    color: #b57801;
                    font-weight: normal;
                  }
                  p {
                    color: #ffffff;
                  }
            
                  @media only screen and (max-width: 480px) {
                    table[class="MainContainer"],
                    td[class="cell"] {
                      width: 100% !important;
                      height: auto !important;
                    }
                    td[class="specbundle"] {
                      width: 100% !important;
                      float: left !important;
                      font-size: 13px !important;
                      line-height: 17px !important;
                      display: block !important;
                      padding-bottom: 15px !important;
                    }
                    td[class="specbundle2"] {
                      width: 90% !important;
                      float: left !important;
                      font-size: 14px !important;
                      line-height: 18px !important;
                      display: block !important;
                      padding-bottom: 10px !important;
                      padding-left: 5% !important;
                      padding-right: 5% !important;
                    }
            
                    td[class="spechide"] {
                      display: none !important;
                    }
                    img[class="banner"] {
                      width: 100% !important;
                      height: auto !important;
                    }
                    td[class="left_pad"] {
                      padding-left: 15px !important;
                      padding-right: 15px !important;
                    }
                  }
            
                  @media only screen and (max-width: 540px) {
                    table[class="MainContainer"],
                    td[class="cell"] {
                      width: 100% !important;
                      height: auto !important;
                    }
                    td[class="specbundle"] {
                      width: 100% !important;
                      float: left !important;
                      font-size: 13px !important;
                      line-height: 17px !important;
                      display: block !important;
                      padding-bottom: 15px !important;
                    }
                    td[class="specbundle2"] {
                      width: 90% !important;
                      float: left !important;
                      font-size: 14px !important;
                      line-height: 18px !important;
                      display: block !important;
                      padding-bottom: 10px !important;
                      padding-left: 5% !important;
                      padding-right: 5% !important;
                    }
            
                    td[class="spechide"] {
                      display: none !important;
                    }
                    img[class="banner"] {
                      width: 100% !important;
                      height: auto !important;
                    }
                    td[class="left_pad"] {
                      padding-left: 15px !important;
                      padding-right: 15px !important;
                    }
                  }
                </style>
                <script type="colorScheme" class="swatch active">
                  {
                    "name":"Default",
                    "bgBody":"DDDDDD",
                    "link":"999999",
                    "color":"ffffff",
                    "bgItem":"ffffff",
                    "title":"B57801"
                  }
                </script>
              </head>
              <body
                paddingwidth="0"
                paddingheight="0"
                class="bgBody"
                style="
                  padding-top: 0;
                  padding-bottom: 0;
                  padding-top: 0;
                  padding-bottom: 0;
                  background-repeat: repeat;
                  width: 100% !important;
                  -webkit-text-size-adjust: 100%;
                  -ms-text-size-adjust: 100%;
                  -webkit-font-smoothing: antialiased;
                "
                offset="0"
                toppadding="0"
                leftpadding="0"
              >
                <table
                  width="100%"
                  border="0"
                  cellspacing="0"
                  cellpadding="0"
                  class="tableContent bgBody"
                  align="center"
                  style="font-family: helvetica, sans-serif"
                >
                  <!-- ================ header=============== -->
                  <tbody>
                    <tr>
                      <td>
                        <table
                          width="600"
                          border="0"
                          cellspacing="0"
                          cellpadding="0"
                          align="center"
                          class="MainContainer"
                        >
                          <tbody>
                            <tr>
                              <td class="movableContentContainer">
                                <div
                                  class="movableContent"
                                  style="border: 0px; padding-top: 0px; position: relative"
                                >
                                  <table
                                    width="100%"
                                    border="0"
                                    cellspacing="0"
                                    cellpadding="0"
                                  >
                                    <tbody>
                                      <tr>
                                        <td height="22" bgcolor="#272727"></td>
                                      </tr>
                                      <tr>
                                        <td bgcolor="#272727">
                                          <table
                                            width="100%"
                                            border="0"
                                            cellspacing="0"
                                            cellpadding="0"
                                          >
                                            <tbody>
                                              <tr>
                                                <td
                                                  valign="top"
                                                  width="20"
                                                  class="spechide"
                                                >
                                                  &nbsp;
                                                </td>
                                                <td>
                                                  <table
                                                    width="100%"
                                                    border="0"
                                                    cellspacing="0"
                                                    cellpadding="0"
                                                  >
                                                    <tbody>
                                                      <tr>
                                                        <td
                                                          valign="top"
                                                          width="340"
                                                          class="specbundle2"
                                                        >
                                                          <div
                                                            class="
                                                              contentEditableContainer
                                                              contentImageEditable
                                                            "
                                                          >
                                                            <div class="contentEditable">
                                                              <img
                                                                src="images/logo.png"
                                                                data-max-width="340"
                                                                alt="[CLIENTS.COMPANY_NAME]"
                                                              />
                                                            </div>
                                                          </div>
                                                        </td>
                                                        <td
                                                          valign="top"
                                                          class="specbundle2"
                                                          align="right"
                                                        >
                                                          <div
                                                            class="
                                                              contentEditableContainer
                                                              contentTextEditable
                                                            "
                                                          >
                                                            <div
                                                              style="font-size: 14px"
                                                              class="contentEditable"
                                                            >
                                                              <p>
                                                                <a
                                                                  target="_blank"
                                                                  href="#"
                                                                  class="link1"
                                                                  >About us</a
                                                                >
                                                                /
                                                                <a
                                                                  target="_blank"
                                                                  href="#"
                                                                  class="link1"
                                                                  >Contact</a
                                                                >
                                                                /
                                                                <a
                                                                  target="_blank"
                                                                  href="#"
                                                                  class="link1"
                                                                  >Menu</a
                                                                >
                                                              </p>
                                                            </div>
                                                          </div>
                                                        </td>
                                                      </tr>
                                                    </tbody>
                                                  </table>
                                                </td>
                                                <td
                                                  valign="top"
                                                  width="20"
                                                  class="spechide"
                                                >
                                                  &nbsp;
                                                </td>
                                              </tr>
                                            </tbody>
                                          </table>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td height="22" bgcolor="#272727"></td>
                                      </tr>
                                    </tbody>
                                  </table>
                                </div>
                                <div
                                  class="movableContent"
                                  style="border: 0px; padding-top: 0px; position: relative"
                                >
                                  <table
                                    width="100%"
                                    border="0"
                                    cellspacing="0"
                                    cellpadding="0"
                                  >
                                    <tr>
                                      <td height="22" bgcolor="#272727"></td>
                                    </tr>
                                    <tr>
                                      <td bgcolor="#B57801">
                                        <div
                                          class="
                                            contentEditableContainer
                                            contentImageEditable
                                          "
                                        >
                                          <div class="contentEditable">
                                            <img
                                              class="banner"
                                              src="https://c4.wallpaperflare.com/wallpaper/371/69/249/happy-new-year-champagne-stemware-ribbon-wallpaper-preview.jpg"
                                              data-default="placeholder"
                                              data-max-width="600"
                                              width="600"
                                              height="400"
                                              alt="Happy New Year!"
                                              border="0"
                                            />
                                          </div>
                                        </div>
                                      </td>
                                    </tr>
                                  </table>
                                </div>
                                <div
                                  class="movableContent"
                                  style="border: 0px; padding-top: 0px; position: relative"
                                >
                                  <table
                                    width="100%"
                                    border="0"
                                    cellspacing="0"
                                    cellpadding="0"
                                    bgcolor="#B57801"
                                  >
                                    <tr>
                                      <td height="55" colspan="3"></td>
                                    </tr>
                                    <tr>
                                      <td width="125"></td>
                                      <td>
                                        <table
                                          width="350"
                                          border="0"
                                          cellspacing="0"
                                          cellpadding="0"
                                        >
                                          <tr>
                                            <td>
                                              <div
                                                class="
                                                  contentEditableContainer
                                                  contentTextEditable
                                                "
                                              >
                                                <div
                                                  style="
                                                    font-family: Georgia;
                                                    text-align: center;
                                                  "
                                                  class="contentEditable"
                                                >
                                                  <p
                                                    style="font-size: 36px; color: #ffffff"
                                                  >
                                                    Happy New Year! [firstname, buddy]!
                                                  </p>
                                                </div>
                                              </div>
                                            </td>
                                          </tr>
                                          <tr>
                                            <td height="25"></td>
                                          </tr>
                                          <tr>
                                            <td>
                                              <div
                                                class="
                                                  contentEditableContainer
                                                  contentTextEditable
                                                "
                                              >
                                                <div
                                                  style="
                                                    font-family: Georgia;
                                                    font-size: 15px;
                                                    line-height: 17px;
                                                    text-align: center;
                                                  "
                                                  class="contentEditable"
                                                >
                                                  <p>
                                                    Being a good marketer is all about
                                                    creating good habits and sticking to
                                                    them.  As we usher in [DATE|86750|Y],
                                                    we’re counting down our very own top ten
                                                    marketing resolutions - feel free to
                                                    steal any (or all!) of them.
                                                  </p>
                                                </div>
                                              </div>
                                            </td>
                                          </tr>
                                        </table>
                                      </td>
                                      <td width="125"></td>
                                    </tr>
                                    <tr>
                                      <td height="55" colspan="3"></td>
                                    </tr>
                                  </table>
                                </div>
                                <div
                                  class="movableContent"
                                  style="border: 0px; padding-top: 0px; position: relative"
                                >
                                  <table
                                    width="100%"
                                    border="0"
                                    cellspacing="0"
                                    cellpadding="0"
                                    class="bgItem"
                                  >
                                    <tr>
                                      <td height="55"></td>
                                    </tr>
                                    <tr>
                                      <td>
                                        <div
                                          class="
                                            contentEditableContainer
                                            contentTextEditable
                                          "
                                        >
                                          <div class="contentEditable">
                                            <h2 style="color: #b57801; font-size: 36px">
                                              Top 10
                                            </h2>
                                          </div>
                                        </div>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td height="15"></td>
                                    </tr>
                                    <tr>
                                      <td>
                                        <div
                                          class="
                                            contentEditableContainer
                                            contentTextEditable
                                          "
                                        >
                                          <div
                                            style="
                                              font-family: Georgia;
                                              font-size: 18px;
                                              text-align: center;
                                            "
                                            class="contentEditable"
                                          >
                                            <p style="color: #333333">
                                              Marketing Resolutions for 2014
                                            </p>
                                          </div>
                                        </div>
                                      </td>
                                    </tr>
                                  </table>
                                </div>
                                <div
                                  class="movableContent"
                                  style="border: 0px; padding-top: 0px; position: relative"
                                >
                                  <table
                                    width="100%"
                                    border="0"
                                    cellspacing="0"
                                    cellpadding="0"
                                    class="bgItem"
                                  >
                                    <tr>
                                      <td height="55" colspan="5"></td>
                                    </tr>
                                    <tr>
                                      <td width="20" class="spechide"></td>
                                      <td width="238" valign="top" class="specbundle2">
                                        <table
                                          width="100%"
                                          border="0"
                                          cellspacing="0"
                                          cellpadding="0"
                                        >
                                          <tr>
                                            <td>
                                              <div
                                                class="
                                                  contentEditableContainer
                                                  contentTextEditable
                                                "
                                              >
                                                <div
                                                  style="
                                                    font-family: Georgia;
                                                    font-size: 20px;
                                                  "
                                                  class="contentEditable"
                                                >
                                                  <p style="color: #333333">
                                                    <span style="color: #b57801">10.</span>
                                                    Blog Often
                                                  </p>
                                                </div>
                                              </div>
                                            </td>
                                          </tr>
                                          <tr>
                                            <td height="15"></td>
                                          </tr>
                                          <tr>
                                            <td>
                                              <div
                                                class="
                                                  contentEditableContainer
                                                  contentTextEditable
                                                "
                                              >
                                                <div
                                                  style="font-size: 14px; line-height: 22px"
                                                  class="contentEditable"
                                                >
                                                  <p style="color: #333333">
                                                    Hands down the best way build
                                                    credibility and drive traffic  toward
                                                    your site. Caution: May cause addiction.
                                                  </p>
                                                </div>
                                              </div>
                                            </td>
                                          </tr>
                                        </table>
                                      </td>
                                      <td width="84" class="specbundle2"></td>
                                      <td width="238" valign="top" class="specbundle2">
                                        <table
                                          width="100%"
                                          border="0"
                                          cellspacing="0"
                                          cellpadding="0"
                                        >
                                          <tr>
                                            <td>
                                              <div
                                                class="
                                                  contentEditableContainer
                                                  contentTextEditable
                                                "
                                              >
                                                <div
                                                  style="
                                                    font-family: Georgia;
                                                    font-size: 20px;
                                                  "
                                                  class="contentEditable"
                                                >
                                                  <p style="color: #333333">
                                                    <span style="color: #b57801">9.</span>
                                                    Be more Social
                                                  </p>
                                                </div>
                                              </div>
                                            </td>
                                          </tr>
                                          <tr>
                                            <td height="15"></td>
                                          </tr>
                                          <tr>
                                            <td>
                                              <div
                                                class="
                                                  contentEditableContainer
                                                  contentTextEditable
                                                "
                                              >
                                                <div
                                                  style="font-size: 14px; line-height: 22px"
                                                  class="contentEditable"
                                                >
                                                  <p style="color: #333333">
                                                    Go to more events, meet more people;
                                                    like, share and engage on social
                                                    networks and do it every day. Your
                                                    business will thank you.
                                                  </p>
                                                </div>
                                              </div>
                                            </td>
                                          </tr>
                                        </table>
                                      </td>
                                      <td width="20" class="spechide"></td>
                                    </tr>
                                  </table>
                                </div>
                                <div
                                  class="movableContent"
                                  style="border: 0px; padding-top: 0px; position: relative"
                                >
                                  <table
                                    width="100%"
                                    border="0"
                                    cellspacing="0"
                                    cellpadding="0"
                                    class="bgItem"
                                  >
                                    <tr>
                                      <td height="55" colspan="3"></td>
                                    </tr>
                                    <tr>
                                      <td width="20"></td>
                                      <td width="560">
                                        <table
                                          width="100%"
                                          border="0"
                                          cellspacing="0"
                                          cellpadding="0"
                                          bgcolor="#FFFAEF"
                                          style="
                                            border: 2px solid #b57801;
                                            border-radius: 3px;
                                            -moz-border-radius: 3px;
                                            -webkit-border-radius: 3px;
                                          "
                                        >
                                          <tr>
                                            <td height="35" colspan="3"></td>
                                          </tr>
                                          <tr>
                                            <td width="55"></td>
                                            <td width="442">
                                              <table
                                                width="100%"
                                                border="0"
                                                cellspacing="0"
                                                cellpadding="0"
                                              >
                                                <tr>
                                                  <td>
                                                    <div
                                                      class="
                                                        contentEditableContainer
                                                        contentTextEditable
                                                      "
                                                    >
                                                      <div
                                                        style="
                                                          font-family: Georgia;
                                                          font-size: 24px;
                                                          text-align: center;
                                                        "
                                                        class="contentEditable"
                                                      >
                                                        <p style="color: #b57801">
                                                          8. Send Loving Newsletters
                                                        </p>
                                                      </div>
                                                    </div>
                                                  </td>
                                                </tr>
                                                <tr>
                                                  <td height="10"></td>
                                                </tr>
                                                <tr>
                                                  <td>
                                                    <div
                                                      class="
                                                        contentEditableContainer
                                                        contentTextEditable
                                                      "
                                                    >
                                                      <div
                                                        style="
                                                          font-size: 14px;
                                                          line-height: 22px;
                                                          text-align: center;
                                                        "
                                                        class="contentEditable"
                                                      >
                                                        <p style="color: #b57801">
                                                          It’s a no brainer, right? Using
                                                          resolutions 9 and 10 for
                                                          inspiration. Make it weekly,
                                                          bi-weekly or  monthly, it’s up to
                                                          you but stick to it.
                                                        </p>
                                                      </div>
                                                    </div>
                                                  </td>
                                                </tr>
                                              </table>
                                            </td>
                                            <td width="55"></td>
                                          </tr>
                                          <tr>
                                            <td height="35" colspan="3"></td>
                                          </tr>
                                        </table>
                                      </td>
                                      <td width="20"></td>
                                    </tr>
                                  </table>
                                </div>
                                <div
                                  class="movableContent"
                                  style="border: 0px; padding-top: 0px; position: relative"
                                >
                                  <table
                                    width="100%"
                                    border="0"
                                    cellspacing="0"
                                    cellpadding="0"
                                    class="bgItem"
                                  >
                                    <tr>
                                      <td height="55" colspan="5"></td>
                                    </tr>
                                    <tr>
                                      <td width="20" class="spechide"></td>
                                      <td width="238" valign="top" class="specbundle2">
                                        <table
                                          width="100%"
                                          border="0"
                                          cellspacing="0"
                                          cellpadding="0"
                                        >
                                          <tr>
                                            <td>
                                              <div
                                                class="
                                                  contentEditableContainer
                                                  contentTextEditable
                                                "
                                              >
                                                <div
                                                  style="
                                                    font-family: Georgia;
                                                    font-size: 20px;
                                                  "
                                                  class="contentEditable"
                                                >
                                                  <p style="color: #333333">
                                                    <span style="color: #b57801">7.</span>
                                                    Targeted Content
                                                  </p>
                                                </div>
                                              </div>
                                            </td>
                                          </tr>
                                          <tr>
                                            <td height="15"></td>
                                          </tr>
                                          <tr>
                                            <td>
                                              <div
                                                class="
                                                  contentEditableContainer
                                                  contentTextEditable
                                                "
                                              >
                                                <div
                                                  style="font-size: 14px; line-height: 22px"
                                                  class="contentEditable"
                                                >
                                                  <p style="color: #333333">
                                                    The more you know about your customers
                                                    the more ways you’ll find to delight
                                                    them, so segment your list by creating
                                                    groups to send timely, targeted emails.
                                                  </p>
                                                </div>
                                              </div>
                                            </td>
                                          </tr>
                                        </table>
                                      </td>
                                      <td width="84" valign="top" class="specbundle2"></td>
                                      <td width="238" valign="top" class="specbundle2">
                                        <table
                                          width="100%"
                                          border="0"
                                          cellspacing="0"
                                          cellpadding="0"
                                        >
                                          <tr>
                                            <td>
                                              <div
                                                class="
                                                  contentEditableContainer
                                                  contentTextEditable
                                                "
                                              >
                                                <div
                                                  style="
                                                    font-family: Georgia;
                                                    font-size: 20px;
                                                  "
                                                  class="contentEditable"
                                                >
                                                  <p style="color: #333333">
                                                    <span style="color: #b57801">6.</span>
                                                    Ask for Feedback
                                                  </p>
                                                </div>
                                              </div>
                                            </td>
                                          </tr>
                                          <tr>
                                            <td height="15"></td>
                                          </tr>
                                          <tr>
                                            <td>
                                              <div
                                                class="
                                                  contentEditableContainer
                                                  contentTextEditable
                                                "
                                              >
                                                <div
                                                  style="font-size: 14px; line-height: 22px"
                                                  class="contentEditable"
                                                >
                                                  <p style="color: #333333">
                                                    Real world customer validation is key.
                                                    Call up one great customer a week and
                                                    ask them for a quote. You’d be surprised
                                                    at how positively they’ll respond.
                                                  </p>
                                                </div>
                                              </div>
                                            </td>
                                          </tr>
                                        </table>
                                      </td>
                                      <td width="20" class="spechide"></td>
                                    </tr>
                                  </table>
                                </div>
                                <div
                                  class="movableContent"
                                  style="border: 0px; padding-top: 0px; position: relative"
                                >
                                  <table
                                    class="bgItem"
                                    width="100%"
                                    border="0"
                                    cellspacing="0"
                                    cellpadding="0"
                                  >
                                    <tr>
                                      <td height="55"></td>
                                    </tr>
                                  </table>
                                </div>
                                <div
                                  class="movableContent"
                                  style="border: 0px; padding-top: 0px; position: relative"
                                >
                                  <table
                                    width="100%"
                                    border="0"
                                    cellspacing="0"
                                    cellpadding="0"
                                    bgcolor="#262626"
                                  >
                                    <tr>
                                      <td height="55" colspan="3"></td>
                                    </tr>
                                    <tr>
                                      <td width="20"></td>
                                      <td>
                                        <table
                                          width="100%"
                                          border="0"
                                          cellspacing="0"
                                          cellpadding="0"
                                        >
                                          <tr>
                                            <td>
                                              <div
                                                class="
                                                  contentEditableContainer
                                                  contentTextEditable
                                                "
                                              >
                                                <div
                                                  style="
                                                    font-family: Georgia;
                                                    font-size: 20px;
                                                  "
                                                  class="contentEditable"
                                                >
                                                  <p>
                                                    <span style="color: #b57801">5.</span>
                                                    Create an Editorial Calendar and Stick
                                                    to It
                                                  </p>
                                                </div>
                                              </div>
                                            </td>
                                          </tr>
                                          <tr>
                                            <td height="10"></td>
                                          </tr>
                                          <tr>
                                            <td>
                                              <div
                                                class="
                                                  contentEditableContainer
                                                  contentTextEditable
                                                "
                                              >
                                                <div
                                                  style="font-size: 14px; line-height: 22px"
                                                  class="contentEditable"
                                                >
                                                  <p>
                                                    This is where your blog, newsletter,
                                                    social networks and eMail Marketing
                                                    activities all come together like a
                                                    seasoned orchestra. <br /><br />
                                                    Keep in mind:<span
                                                      style="color: #999999"
                                                    >
                                                      your calendar should be the baseline
                                                      of your communications; feel free to
                                                      improvise when situations demand
                                                      it!</span
                                                    >
                                                  </p>
                                                </div>
                                              </div>
                                            </td>
                                          </tr>
                                        </table>
                                      </td>
                                      <td width="20"></td>
                                    </tr>
                                  </table>
                                </div>
                                <div
                                  class="movableContent"
                                  style="border: 0px; padding-top: 0px; position: relative"
                                >
                                  <table
                                    width="100%"
                                    border="0"
                                    cellspacing="0"
                                    cellpadding="0"
                                    bgcolor="#262626"
                                  >
                                    <tr>
                                      <td height="35" colspan="3"></td>
                                    </tr>
                                    <tr>
                                      <td width="20"></td>
                                      <td>
                                        <table
                                          width="100%"
                                          border="0"
                                          cellspacing="0"
                                          cellpadding="0"
                                        >
                                          <tr>
                                            <td>
                                              <div
                                                class="
                                                  contentEditableContainer
                                                  contentTextEditable
                                                "
                                              >
                                                <div
                                                  style="
                                                    font-family: Georgia;
                                                    font-size: 20px;
                                                  "
                                                  class="contentEditable"
                                                >
                                                  <p>
                                                    <span style="color: #b57801">4.</span>
                                                    Get a Good Task Management App
                                                  </p>
                                                </div>
                                              </div>
                                            </td>
                                          </tr>
                                          <tr>
                                            <td height="10"></td>
                                          </tr>
                                          <tr>
                                            <td>
                                              <div
                                                class="
                                                  contentEditableContainer
                                                  contentTextEditable
                                                "
                                              >
                                                <div
                                                  style="font-size: 14px; line-height: 22px"
                                                  class="contentEditable"
                                                >
                                                  <p>
                                                    There’s just no way to stay up on it
                                                    all, but by assigning it all out and
                                                    knocking items off daily, you’re
                                                    guaranteed to improve your performance.
                                                  </p>
                                                </div>
                                              </div>
                                            </td>
                                          </tr>
                                        </table>
                                      </td>
                                      <td width="20"></td>
                                    </tr>
                                    <tr>
                                      <td height="55" colspan="3"></td>
                                    </tr>
                                  </table>
                                </div>
                                <div
                                  class="movableContent"
                                  style="border: 0px; padding-top: 0px; position: relative"
                                >
                                  <table
                                    width="100%"
                                    border="0"
                                    cellspacing="0"
                                    cellpadding="0"
                                    bgcolor="#363636"
                                  >
                                    <tr>
                                      <td height="55" colspan="5"></td>
                                    </tr>
                                    <tr>
                                      <td width="20" class="spechide"></td>
                                      <td width="238" valign="top" class="specbundle2">
                                        <table
                                          width="100%"
                                          border="0"
                                          cellspacing="0"
                                          cellpadding="0"
                                        >
                                          <tr>
                                            <td>
                                              <div
                                                class="
                                                  contentEditableContainer
                                                  contentTextEditable
                                                "
                                              >
                                                <div
                                                  style="
                                                    font-family: Georgia;
                                                    font-size: 20px;
                                                  "
                                                  class="contentEditable"
                                                >
                                                  <p>
                                                    <span style="color: #b57801">3.</span>
                                                    Create a Swag Bag
                                                  </p>
                                                </div>
                                              </div>
                                            </td>
                                          </tr>
                                          <tr>
                                            <td height="15"></td>
                                          </tr>
                                          <tr>
                                            <td>
                                              <div
                                                class="
                                                  contentEditableContainer
                                                  contentTextEditable
                                                "
                                              >
                                                <div
                                                  style="font-size: 14px; line-height: 22px"
                                                  class="contentEditable"
                                                >
                                                  <p>
                                                    Hands down the best way build
                                                    credibility and drive traffic  toward
                                                    your site. Caution: May cause addiction.
                                                  </p>
                                                </div>
                                              </div>
                                            </td>
                                          </tr>
                                        </table>
                                      </td>
                                      <td width="84" class="specbundle2" valign="top"></td>
                                      <td width="238" valign="top" class="specbundle2">
                                        <table
                                          width="100%"
                                          border="0"
                                          cellspacing="0"
                                          cellpadding="0"
                                        >
                                          <tr>
                                            <td>
                                              <div
                                                class="
                                                  contentEditableContainer
                                                  contentTextEditable
                                                "
                                              >
                                                <div
                                                  style="
                                                    font-family: Georgia;
                                                    font-size: 20px;
                                                  "
                                                  class="contentEditable"
                                                >
                                                  <p>
                                                    <span style="color: #b57801">2.</span>
                                                    Schedule a Weekly Metrics Meeting
                                                  </p>
                                                </div>
                                              </div>
                                            </td>
                                          </tr>
                                          <tr>
                                            <td height="15"></td>
                                          </tr>
                                          <tr>
                                            <td>
                                              <div
                                                class="
                                                  contentEditableContainer
                                                  contentTextEditable
                                                "
                                              >
                                                <div
                                                  style="font-size: 14px; line-height: 22px"
                                                  class="contentEditable"
                                                >
                                                  <p>
                                                    Take a minute to look at your numbers
                                                    (website traffic, PPC, emails etc. )
                                                    once a week. <br /><br />
                                                    Remember:<br />
                                                    <span style="color: #999999"
                                                      >You manage what you measure.</span
                                                    >
                                                  </p>
                                                </div>
                                              </div>
                                            </td>
                                          </tr>
                                        </table>
                                      </td>
                                      <td width="20" class="spechide"></td>
                                    </tr>
                                  </table>
                                </div>
                                <div
                                  class="movableContent"
                                  style="border: 0px; padding-top: 0px; position: relative"
                                >
                                  <table
                                    width="100%"
                                    border="0"
                                    cellspacing="0"
                                    cellpadding="0"
                                    bgcolor="#363636"
                                  >
                                    <tr>
                                      <td height="35" colspan="3"></td>
                                    </tr>
                                    <tr>
                                      <td width="20"></td>
                                      <td>
                                        <table
                                          width="100%"
                                          border="0"
                                          cellspacing="0"
                                          cellpadding="0"
                                        >
                                          <tr>
                                            <td>
                                              <div
                                                class="
                                                  contentEditableContainer
                                                  contentTextEditable
                                                "
                                              >
                                                <div
                                                  style="
                                                    font-family: Georgia;
                                                    font-size: 20px;
                                                  "
                                                  class="contentEditable"
                                                >
                                                  <p>
                                                    <span style="color: #b57801">1.</span>
                                                    Share your Resolutions
                                                  </p>
                                                </div>
                                              </div>
                                            </td>
                                          </tr>
                                          <tr>
                                            <td height="10"></td>
                                          </tr>
                                          <tr>
                                            <td>
                                              <div
                                                class="
                                                  contentEditableContainer
                                                  contentTextEditable
                                                "
                                              >
                                                <div
                                                  style="font-size: 14px; line-height: 22px"
                                                  class="contentEditable"
                                                >
                                                  <p>
                                                    Today’s a great day to get started:
                                                    replace the content in here with your
                                                    own, and tell your customers about your
                                                    resolutions and ask them for theirs.
                                                    Have fun with it! If you aren’t having
                                                    any fun, it’s pretty certain your
                                                    customers won’t either.
                                                  </p>
                                                </div>
                                              </div>
                                            </td>
                                          </tr>
                                        </table>
                                      </td>
                                      <td width="20"></td>
                                    </tr>
                                    <tr>
                                      <td height="55" colspan="3"></td>
                                    </tr>
                                  </table>
                                </div>
                                <div
                                  class="movableContent"
                                  style="border: 0px; padding-top: 0px; position: relative"
                                >
                                  <table
                                    width="100%"
                                    border="0"
                                    cellspacing="0"
                                    cellpadding="0"
                                    bgcolor="#B57801"
                                  >
                                    <tr>
                                      <td height="30"></td>
                                    </tr>
                                    <tr>
                                      <td width="600">
                                        <div
                                          class="
                                            contentEditableContainer
                                            contentTextEditable
                                          "
                                        >
                                          <div
                                            style="
                                              font-family: Georgia;
                                              font-size: 20px;
                                              text-align: center;
                                              line-height: 32px;
                                            "
                                            class="contentEditable"
                                          >
                                            <p>
                                              Happy Holidays<br />
                                              from everyone at [CLIENTS.COMPANY_NAME]!
                                            </p>
                                          </div>
                                        </div>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td height="30"></td>
                                    </tr>
                                  </table>
                                </div>
                                <div
                                  class="movableContent"
                                  style="border: 0px; padding-top: 0px; position: relative"
                                >
                                  <table
                                    width="100%"
                                    border="0"
                                    cellspacing="0"
                                    cellpadding="0"
                                  >
                                    <tr>
                                      <td height="180" class="bgItem" align="center">
                                        <table
                                          width="100%"
                                          border="0"
                                          cellspacing="0"
                                          cellpadding="0"
                                        >
                                          <tr>
                                            <td height="55"></td>
                                          </tr>
                                          <tr>
                                            <td align="center">
                                              <div
                                                class="
                                                  contentEditableContainer
                                                  contentTextEditable
                                                "
                                              >
                                                <div
                                                  style="font-size: 13px; font-weight: bold"
                                                  class="contentEditable"
                                                >
                                                  <p style="color: #999999">
                                                    Sent to [email] by
                                                    [CLIENTS.COMPANY_NAME] |
                                                    [CLIENTS.ADDRESS] | [CLIENTS.PHONE]
                                                  </p>
                                                </div>
                                              </div>
                                            </td>
                                          </tr>
                                          <tr>
                                            <td height="10"></td>
                                          </tr>
                                          <tr>
                                            <td align="center" style="font-size: 13px">
                                              <div
                                                class="
                                                  contentEditableContainer
                                                  contentTextEditable
                                                "
                                              >
                                                <div class="contentEditable">
                                                  <p style="color: #999999">
                                                    <a
                                                      target="_blank"
                                                      href="[CLIENTS.WEBSITE]"
                                                      class="link2"
                                                      >Home</a
                                                    >
                                                    |
                                                    <a
                                                      target="_blank"
                                                      href="[SHOWEMAIL]"
                                                      class="link2"
                                                    >
                                                      Open in browser
                                                    </a>
                                                    |
                                                    <a
                                                      target="_blank"
                                                      href="[FORWARD]"
                                                      class="link2"
                                                      >Forward to a friend</a
                                                    >
                                                    |
                                                    <a
                                                      target="_blank"
                                                      href="[UNSUBSCRIBE]"
                                                      class="link2"
                                                      >Unsubscribe</a
                                                    >
                                                  </p>
                                                </div>
                                              </div>
                                            </td>
                                          </tr>
                                        </table>
                                      </td>
                                    </tr>
                                  </table>
                                </div>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </td>
                    </tr>
                  </tbody>
                </table>
            
                  </body>
            </html>
            ',
            'status' => "1",
        ]);




        
    }
}
