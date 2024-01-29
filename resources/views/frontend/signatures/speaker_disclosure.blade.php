<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
  <title>CME/CPD Activity Disclosure Form: Speaker</title>
  <!-- Web Fonts
         ======================= -->
  <style type="text/css">
    body {
      font-family: 'Roboto', sans-serif;
    }

    table {
      border-collapse: collapse;
      font-family: 'Titillium Web', sans-serif;
    }

    td,
    th {
      padding: 0;
    }

    /* td, th padding */
    /* padding: 15px 20px */
  </style>
</head>

<body style=" margin: 0; padding: 20px; background: #F6FBFF;">
  <table border-spacing="0" border-collapse="0" style="width: 100%; max-width: 670px;margin: 0 auto; background: #ffffff; border: 1px solid #999;">
    <tr>
      <th style="padding: 0;">
        <table style="width: 100%;">
          <thead style="text-align: left; border-bottom: 1px solid #e6e6e6; font-weight: 400;">
            <tr>
              <th style="width: 50%; padding: 20px 20px 15px;">
                <img src="https://ichs-prod-static-content.s3.eu-west-1.amazonaws.com/file_manager/images/efjkRsre9ib9pxpFIwdIcusizgdM8V9i22eUI2z0.png" />
              </th>
              <th style="width: 45%; padding: 20px; text-align: right; font-weight: 400;">
                <div style="margin: 3px 0; width: 100%; text-align: left;">Reference Id: <strong>{{($speaker['reference_id'] ? $speaker['reference_id'] : 'N/A')}}</strong></div>
                <div style="margin: 3px 0; width: 100%; text-align: left;">Date/Time: <strong>{{($speaker['date'] ? $speaker['date'] : 'N/A')}}</strong></div>
              </th>
            </tr>
          </thead>
          <tbody style="text-align: left; font-weight: 400;">
            <tr>
              <td colspan="2" style="padding: 15px 20px; text-align: left;">
                <h2 style="font-size: 26px; line-height: 32px; margin: 0; color: #01539D;">CME/CPD ACTIVITY DISCLOSURE FORM: SPEAKERS</h2>
              </td>
            </tr>

            <!-- Personal Informations -->
            <tr>
              <td colspan="2" style="padding: 5px 20px 15px;">
                <table style="width: 100%; border: 1px solid #ccc;">
                  <tr>
                    <th colspan="2" style="padding: 10px 15px; border-bottom: 1px solid #ccc; background: #01539D; color: #ffffff; text-align: left;">
                      <h4 style="margin: 0; font-size: 18px;">Personal Informations</h4>
                    </th>
                  </tr>
                  <tr style="background: #ffffff;">
                    <td style="max-width: max-content; padding: 10px 15px 5px;">
                      Name:
                      <br />
                      <strong class="color: #01539D;">{{($speaker['full_name'] ? $speaker['full_name'] : 'N/A')}}</strong>
                    </td>
                    <td style="max-width: max-content; padding: 10px 15px 5px;">
                      Email ID:
                      <br />
                      <strong class="color: #01539D;">{{($speaker['email'] ? $speaker['email'] : 'N/A')}}</strong>
                    </td>
                    <td style="max-width: max-content; padding: 10px 15px 5px;">
                      Degree:
                      <br />
                      <strong class="color: #01539D;">{{($speaker['degree'] ? $speaker['degree'] : 'N/A')}}</strong>
                    </td>
                    <td style="max-width: max-content; padding: 10px 15px 5px;">
                      Phone Number:
                      <br />
                      <strong class="color: #01539D;">{{($speaker['phone_no'] ? $speaker['phone_no'] : 'N/A')}}</strong>
                    </td>
                    @if($speaker['is_financial_relation_with_entity'] == 1)
                    <td style="max-width: max-content; padding: 10px 15px 5px;">
                      Company Name
                      <br />
                      <strong class="color: #01539D;">{{($speaker['company_name'] ? $speaker['company_name'] : 'N/A')}}</strong>
                    </td>
                    <td style="max-width: max-content; padding: 10px 15px 5px;">
                      Relation Type:
                      <br />
                      <strong class="color: #01539D;">{{($speaker['relation_type'] ? $speaker['relation_type'] : 'N/A')}}</strong>
                    </td>
                    <td style="max-width: max-content; padding: 10px 15px 5px;">
                      Content Area:
                      <br />
                      <strong class="color: #01539D;">{{($speaker['content_area'] ? $speaker['content_area'] : 'N/A')}}</strong>
                    </td>
                    @endif

                  </tr>

                </table>
              </td>

            </tr>
            <tr>
              <td colspan="2" style="padding: 5px 20px 15px;">
                <table style="width: 100%; border: 1px solid #ccc;">
                  <tr>
                    <th colspan="2" style="padding: 10px 15px; border-bottom: 1px solid #ccc; background: #01539D; color: #ffffff; text-align: left;">
                      <h4 style="margin: 0; font-size: 18px;">Activity Planned</h4>
                    </th>
                  </tr>
                  <tr style="background: #ffffff;">
                    <td style="max-width: max-content; padding: 10px 15px 5px;">
                      <strong class="color: #01539D;">{{($speaker['activity_planned'] ? $speaker['activity_planned'] : 'N/A')}}</strong>
                    </td>

                  </tr>

                </table>
              </td>
            </tr>

            <tr>
              <td colspan="2" style="padding: 5px 20px 15px;">
                <table style="padding: 2px 20px 15px;">
                  <tr>
                    <td colspan="2" style="text-align: left; padding: 10px 0; line-height: 22px;">
                      <span style="color: #EF8336; display: inline-block; margin-right: 10px; font-size: 24px;"></span>
                      <img src="https://ichs-prod-static-content.s3.eu-west-1.amazonaws.com/file_manager/images/c4e9RF9dzPBwDRqgHQb0i4hHoqsQUfwNtuD6S6HN.png" />

                      Is the financial relationships related to content of the CME/CPD activity?

                    </td>
                  </tr>
                  <tr>
                    <td style="padding: 8px 0; width: 50%; background: #ffffff;">
                      <span style="display: inline-block; margin-right: 5px; font-size: 26px;"></span>
                      <strong>@if($speaker['is_financial_relation_with_content'] == 1) Yes @else No @endif</strong>
                    </td>
                    <td></td>
                  </tr>

                </table>
              </td>
            </tr>

            <tr>
              <td colspan="2" style="padding: 5px 20px 0;">
                <table style="padding: 0 20px 0; width: 100%;">
                  <tr>
                    <td colspan="2" style="text-align: left; padding: 5px 0 10px 0; line-height: 22px; width: 100%;">
                      <span style="color: #EF8336; display: inline-block; margin-right: 10px; font-size: 24px;"></span>
                      <img src="https://ichs-prod-static-content.s3.eu-west-1.amazonaws.com/file_manager/images/c4e9RF9dzPBwDRqgHQb0i4hHoqsQUfwNtuD6S6HN.png" />

                      Within the past 12 months, have you or your spouse had a financial relationship with an entity that produces, markets, re-sells, or distributes healthcare goods or services consumed by, or used on, patients?

                    </td>
                  </tr>
                  <tr>
                    <td style="padding: 8px 0; width: 50%; background: #ffffff;">
                      <span style="display: inline-block; margin-right: 5px; font-size: 26px;"></span>
                      <strong>@if($speaker['is_financial_relation_with_entity'] == 1) Yes @else No @endif</strong>
                    </td>
                    <td></td>
                  </tr>
                </table>
              </td>
            </tr>



          </tbody>
          <tfoot style="border-top: 1px solid #e6e6e6; text-align: left; font-weight: 400;">
            <tr>
              <td colspan="2" style="padding: 20px 20px 5px;">
                <table style="width: 100%;">
                  <tr>
                    <td style="width: 50%; vertical-align: top;">
                      <span>Speaker Name:</span>
                      <br />
                      <strong>{{($speaker['full_name'] ? $speaker['full_name'] : 'N/A')}}</strong>
                    </td>
                    <!-- <td style="width: 50%; vertical-align: top;">
                      <span>Customer Signature:</span>
                      <br />
                      <img src="https://static.cdn.wisestamp.com/wp-content/uploads/2020/08/Oprah-Winfrey-Signature-1.png" alt="Customer signature" height="70" />
                    </td> -->
                  </tr>
                </table>
              </td>
            </tr>
            <tr>
              <td colspan="2" style="padding: 10px 20px 20px; border-top: 1px solid #e6e6e6;">
                <table style="width: 100%;">
                  <tr>
                    <td style="width: 100%; vertical-align: top;">
                      Agreed on Terms and Conditions
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
          </tfoot>
        </table>
        </td>
    </tr>
  </table>
</body>

</html>