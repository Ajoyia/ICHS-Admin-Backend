<?php

return [
    'journal'=>[
        'review'=> array('Title', 'Author/s Information', 'Keywords', 'Introduction','Body','Conclusion','References'),
        'case_report'=> array(
            'Title',
            'Abstract',
            'Author/s Information',
            'Keywords',
            'Introduction',
            'Case Description',
            'Discussion',
            'Conclusion',
            'Acknowledgements',
            'Conflict of Interest',
            'References'
        ),
        'original_article'=> array(
            'Title',
            'Author/s Information',
            'Keywords',
            'Abstract',
            'Introduction',
            'Methods/Materials',
            'Results',
            'Discussion',
            'Conclusion',
            'Summary',
            'Acknowledgements',
            'Funding/Conflict of Interest',
            'References'
        ),
        'technical_note'=> array(
            'Title',
            'Author/s Information',
            'Keywords',
            'Abstract',
            'Introduction',
            'Technical Note Structure',
            'Lessons Learned',
            'Summary',
            'References',
            'Appendix',
        ),
        'commentary_upload'=> array(
            'Title',
            'Author/s Information',
            'Keywords',
            'Background',
            'Main Text',
            'Conclusion',
            'References',
            'Declarations',
        ),
        'pictorial_essay'=> array(
            'Title',
            'Author/s Information',
            'Keywords',
            'Abstract',
            'Introduction',
            'Material - Figures',
            'Conclusion',
            'References',
            'Declarations'
        ),
        'editorial'=> array(
            'Title',
            'Author/s Information',
            'Introduction',
            'Body',
            'Conclusion'
        ),
        'interview'=> array(
            'Title',
            'Author/s Information',
            'Main Editorial Text'
        ),
        'editorial'=> array(
            'Title','Author/s Information','Introduction','Body','Conclusion'
        ),
    ],
    'pages_categories_templates' => [
        ['template_name'=>'profile_card', 'template_view'=>'templates.profilecard'],
        ['template_name'=>'affiliations_listing', 'template_view'=>'templates.affiliations_listing'],
        ['template_name'=>'executive_office', 'template_view'=>'templates.executive_office'],
        ['template_name'=>'international_executive_board', 'template_view'=>'templates.international_executive_board'],
    ],
    'notifications' =>  [
        'notifications_type' => [
            ['type'=>'sign_in','description'=>'For User Sign In'],
            ['type'=>'sign_up','description'=>'For User Sign Up'],
            ['type'=>'membership','description'=>'Membership'],
            ['type'=>'invoice_generation','description'=>'Invoice Generation'],
            ['type' => 'send_approve_mail_chapter', 'description' => 'Approve Mail For Chapters'],
            ['type' => 'send_reject_mail_chapter', 'description' => 'Reject Mail For Chapters'],
            ['type'=>'pay','description'=>'For User to Pay'],
            ['type'=>'cme_signature_payment','description'=>'CME Signature Successful'],
            ['type'=>'agreement_form_speaker','description'=>'CME/CPD Activity Policy Agreement Form: Speakers'],
            ['type'=>'agreement_form_administrator','description'=>'CME/CPD Activity Policy Agreement Form: Administrators'],
            ['type' => 'disclosure_form_speaker', 'description' => 'CME/CPD Activity Disclosure Form: Speakers'],

            ['type'=>'receipt_generation','description'=>'Receipt Generation'],
            ['type'=>'password_reset','description'=>'Password reset link'],
            ['type'=>'for_send_email_organization_member','description'=>'For send email to organization membership'],
            ['type'=>'contact_email','description'=>'Contact email for user to ask query'],
            ['type'=>'fellowship_approve','description'=>'Approve Fellowship Membership'],
            ['type'=>'fellowship_reject','description'=>'Reject Fellowship Membership'],
            ['type' => 'chapter_endorsement', 'description' => 'Chapter Endorsement']
        ],
        'chapter_endorsement' => [
            ['tag' => '{{first_name}}', 'description' => 'User First Name'],
            ['tag' => '{{last_name}}', 'description' => 'User Last Name'],
            ['tag' => '{{chapter_name}}', 'description' => 'Chapter Name'],
            ['tag' => '{{country}}', 'description' => 'Chapter Country'],
            ['tag' => '{{city}}', 'description' => 'Chapter City'],
            ['tag' => '{{link}}', 'description' => 'Link']
        ],
        'send_approve_mail_chapter' => [
            ['tag' => '{{first_name}}', 'description' => 'User First Name'],
            ['tag' => '{{last_name}}', 'description' => 'User Last Name'],
            ['tag' => '{{chapter_name}}', 'description' => 'Chapter Name'],
            ['tag' => '{{created_at}}', 'description' => 'Creation Date'],
            ['tag' => '{{country}}', 'description' => 'Chapter Country'],
            ['tag' => '{{city}}', 'description' => 'Chapter City']
        ],
        'send_reject_mail_chapter' => [
            ['tag' => '{{first_name}}', 'description' => 'User First Name'],
            ['tag' => '{{last_name}}', 'description' => 'User Last Name'],
            ['tag' => '{{chapter_name}}', 'description' => 'Chapter Name'],
            ['tag' => '{{created_at}}', 'description' => 'Creation Date'],
            ['tag' => '{{country}}', 'description' => 'Chapter Country'],
            ['tag' => '{{city}}', 'description' => 'Chapter City']
        ],
        'send_approve_mail_chapter' => [
            ['tag' => '{{first_name}}', 'description' => 'User First Name'],
            ['tag' => '{{last_name}}', 'description' => 'User Last Name'],
            ['tag' => '{{chapter_name}}', 'description' => 'Chapter Name'],
            ['tag' => '{{created_at}}', 'description' => 'Creation Date'],
            ['tag' => '{{country}}', 'description' => 'Chapter Country'],
            ['tag' => '{{city}}', 'description' => 'Chapter City']
        ],
        'send_reject_mail_chapter' => [
            ['tag' => '{{first_name}}', 'description' => 'User First Name'],
            ['tag' => '{{last_name}}', 'description' => 'User Last Name'],
            ['tag' => '{{chapter_name}}', 'description' => 'Chapter Name'],
            ['tag' => '{{created_at}}', 'description' => 'Creation Date'],
            ['tag' => '{{country}}', 'description' => 'Chapter Country'],
            ['tag' => '{{city}}', 'description' => 'Chapter City']
        ],
        'agreement_form_speaker' => [
            ['tag'=>'{{first_name}}','description'=>'User First Name'],
            ['tag'=>'{{last_name}}','description'=>'User Last Name'],
            ['tag'=>'{{email}}','description'=>'User Email'],
            ['tag'=>'{{mobile_no}}','description'=>'User Mobile No.'],
            ['tag'=>'{{address}}','description'=>'User Address'],
            ['tag'=>'{{data}}','description'=>'Taxes Data and Product Name'],
            ['tag'=>'{{link}}','description'=>'Invoice Link'],
            ['tag'=>'{{total_amount}}','description'=>'Total Amount'],
            ['tag'=>'{{net_amount}}','description'=>'Net Amount'],
            ['tag'=>'{{vat}}','description'=>'Vat'],
            ['tag'=>'{{currency}}','description'=>'Currency'],
            ['tag'=>'{{reciept}}','description'=>'Reciept File'],

        ],
        'disclosure_form_speaker' => [
            ['tag' => '{{first_name}}', 'description' => 'User First Name'],
            ['tag' => '{{last_name}}', 'description' => 'User Last Name'],
            ['tag' => '{{email}}', 'description' => 'User Email'],
            ['tag' => '{{link}}', 'description' => 'Link']

        ],

        'receipt_generation' => [
            ['tag'=>'{{first_name}}','description'=>'User First Name'],
            ['tag'=>'{{last_name}}','description'=>'User Last Name'],
            ['tag'=>'{{email}}','description'=>'User Email'],
            ['tag'=>'{{mobile_no}}','description'=>'User Mobile No.'],
            ['tag'=>'{{address}}','description'=>'User Address'],
            ['tag'=>'{{data}}','description'=>'Taxes Data and Product Name'],
            ['tag'=>'{{link}}','description'=>'Invoice Link'],
            ['tag'=>'{{total_amount}}','description'=>'Total Amount'],
            ['tag'=>'{{net_amount}}','description'=>'Net Amount'],
            ['tag'=>'{{vat}}','description'=>'Vat'],
            ['tag'=>'{{currency}}','description'=>'Currency'],
            ['tag'=>'{{reciept}}','description'=>'Reciept File'],

        ],
        'invoice_generation' => [
            ['tag'=>'{{first_name}}','description'=>'User First Name'],
            ['tag'=>'{{last_name}}','description'=>'User Last Name'],
            ['tag'=>'{{email}}','description'=>'User Email'],
            ['tag'=>'{{mobile_no}}','description'=>'User Mobile No.'],
            ['tag'=>'{{address}}','description'=>'User Address'],
            ['tag'=>'{{data}}','description'=>'Taxes Data and Product Name'],
            ['tag'=>'{{link}}','description'=>'Invoice Link'],
            ['tag'=>'{{total_amount}}','description'=>'Total Amount'],
            ['tag'=>'{{net_amount}}','description'=>'Net Amount'],
            ['tag'=>'{{vat}}','description'=>'Vat'],
            ['tag'=>'{{currency}}','description'=>'Currency'],
            ['tag'=>'{{link_to_Pay}}','description'=>'Link to pay']
        ],
        'sign_in' => [
            ['tag'=>'{{first_name}}','description'=>'User First Name'],
            ['tag'=>'{{last_name}}','description'=>'User Last Name'],
            ['tag'=>'{{email}}','description'=>'User Email'],
            ['tag'=>'{{mobile_no}}','description'=>'User Mobile No.'],
            ['tag'=>'{{address}}','description'=>'User Address']
        ],
        'sign_up' => [
            ['tag'=>'{{first_name}}','description'=>'User First Name'],
            ['tag'=>'{{last_name}}','description'=>'User Last Name'],
            ['tag'=>'{{email}}','description'=>'User Email'],
            ['tag'=>'{{mobile_no}}','description'=>'User Mobile No.'],
            ['tag'=>'{{address}}','description'=>'User Address'],
            ['tag'=>'{{url}}','description'=>'User URL'],
            ['tag'=>'{{token}}','description'=>'User token']
        ],
        'password_reset' => [
            ['tag'=>'{{first_name}}','description'=>'User First Name'],
            ['tag'=>'{{last_name}}','description'=>'User Last Name'],
            ['tag'=>'{{email}}','description'=>'User Email'],
            ['tag'=>'{{url}}','description'=>'User URL'],
            ['tag'=>'{{token}}','description'=>'User token']
        ],
        'membership' => [
            ['tag'=>'{{first_name}}','description'=>'User First Name'],
            ['tag'=>'{{last_name}}','description'=>'User Last Name'],
            ['tag'=>'{{email}}','description'=>'User Email'],
            ['tag'=>'{{mobile_no}}','description'=>'User Mobile No.'],
            ['tag'=>'{{address}}','description'=>'User Address'],
            ['tag'=>'{{start_date}}','description'=>'Membership Start Date'],
            ['tag'=>'{{end_date}}','description'=>'Membership End Date'],
            ['tag'=>'{{medical_facility}}','description'=>'Membership Medical Facility'],
            ['tag'=>'{{medical_interests}}','description'=>'Membership Medical Interest']
        ],
        'pay'=>[
            ['tag'=>'{{first_name}}','description'=>'User First Name'],
            ['tag'=>'{{last_name}}','description'=>'User Last Name'],
            ['tag'=>'{{email}}','description'=>'User Email'],
            ['tag'=>'{{mobile_no}}','description'=>'User Mobile No.'],
            ['tag'=>'{{link_to_Pay}}','description'=>'Link to pay'],
            ['tag'=>'{{amount}}','description'=>'Amount to pay']
        ],
        'agreement_form_speaker'=>[
            ['tag'=>'{{first_name}}','description'=>'User First Name'],
            ['tag'=>'{{last_name}}','description'=>'User Last Name'],
            ['tag'=>'{{email}}','description'=>'User Email'],
            ['tag'=>'{{link}}','description'=>'Link']
        ],
        'agreement_form_administrator'=>[
            ['tag'=>'{{first_name}}','description'=>'User First Name'],
            ['tag'=>'{{last_name}}','description'=>'User Last Name'],
            ['tag'=>'{{email}}','description'=>'User Email'],
            ['tag'=>'{{link}}','description'=>'Link']
        ],
        'cme_signature_payment'=>[
            ['tag'=>'{{first_name}}','description'=>'User First Name'],
            ['tag'=>'{{last_name}}','description'=>'User Last Name'],
            ['tag'=>'{{email}}','description'=>'User Email'],
            ['tag'=>'{{pdf_path}}','description'=>'URL To Be Send']
        ],
        'for_send_email_organization_member'=>[
            ['tag'=>'{{email}}','description'=>'User Email'],
            ['tag'=>'{{token}}','description'=>'User token'],
        ],

        'contact_email'=>[
            ['tag'=>'{{name}}','description'=>'User name'],
            ['tag'=>'{{email}}','description'=>'User email'],
            ['tag'=>'{{organization}}','description'=>'User organization'],
            ['tag'=>'{{subject}}','description'=>'User subject'],
            ['tag'=>'{{message}}','description'=>'User message'],
        ],
        'fellowship_approve'=>[
            ['tag'=>'{{user}}','description'=>'User name'],
            ['tag'=>'{{link}}','description'=>'Approve Link'],
        ],
        'fellowship_reject'=>[
            ['tag'=>'{{first_name}}','description'=>'User name'],
            ['tag'=>'{{rejection_reason}}','description'=>'User name'],
        ],
    ],
    'lecture_types'=>[
        ['name'=>'Video','id'=>1],
        ['name'=>'DOCX','id'=>2],
        ['name'=>'PDF','id'=>3],
        ['name'=>'PPT','id'=>4],
    ],
    'user_types'=>[
        ['name'=>'Front End User','id'=>0],
        ['name'=>'Admin User','id'=>1],
        ['name'=>'Both','id'=>2],
    ],
    'currency_rate' => env('CURRENCY_RATE',3.6725),
    'max_reviews_required' => 1,
    'max_review_requested_days' => 7,
    'core_of_professionals_tabs'=>[
        ['id'=>'dental','tabName'=>'Dentistry','tabContentHeading'=>'Dentistry','iconClass'=>'fa-tooth'],
        ['id'=>'pharmacy','tabName'=>'pharmacy','tabContentHeading'=>'Pharmacy','iconClass'=>'fa-pills'],
        ['id'=>'family','tabName'=>'family Medicine','tabContentHeading'=>'Family Medicine','iconClass'=>'fa-people-roof'],
        ['id'=>'ophthalmology','tabName'=>'Ophthalmology','tabContentHeading'=>'Ophthalmology','iconClass'=>'fa-eye'],
        ['id'=>'emergency','tabName'=>'Emergency Medicine','tabContentHeading'=>'Emergency Medicine','iconClass'=>'fa-truck-medical'],
        ['id'=>'radiology','tabName'=>'Radiology','tabContentHeading'=>'Radiology','iconClass'=>'fa-x-ray'],
        ['id'=>'toxicology','tabName'=>'Toxicology','tabContentHeading'=>'Toxicology','iconClass'=>'fa-prescription-bottle'],
    ]
];
