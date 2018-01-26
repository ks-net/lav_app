<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted'             => 'Το πεδίο (:attribute) πρέπει να είναι αποδεκτό.',
    'active_url'           => 'Το πεδίο (:attribute) δεν είναι έγκυρη URL.',
    'after'                => 'Το πεδίο (:attribute) πρέπει να είναι ημερομηνία μια ημέρα μετά από :date.',
    'after_or_equal'       => 'Το πεδίο (:attribute) πρέπει να είναι ημερομηνία μια ημέρα μετά ή ίση με  :date.',
    'alpha'                => 'Το πεδίο (:attribute) μπορεί να περιέχει μόνο γράμματα.',
    'alpha_dash'           => 'Το πεδίο (:attribute) μπορεί να περιέχει μόνο γράμματα, αριθμούς και παύλες.',
    'alpha_num'            => 'Το πεδίο (:attribute) μπορεί να περιέχει μόνο γράμματα και αριθμούς.',
    'array'                => 'Το πεδίο (:attribute) πρέπει να είναι  array.',
    'before'               => 'Το πεδίο (:attribute) πρέπει να είναι ημερομηνία μια ημέρα πριν από :date.',
    'before_or_equal'      => 'Το πεδίο (:attribute) πρέπει να είναι ημερομηνία μια ημέρα πριν ή ίση με  :date.',
    'between'              => [
        'numeric' => 'Το πεδίο (:attribute) πρέπει να είναι μεταξύ :min και :max.',
        'file'    => 'Το πεδίο (:attribute) πρέπει να είναι μεταξύ :min και :max kilobytes.',
        'string'  => 'Το πεδίο (:attribute) πρέπει να είναι μεταξύ :min και :max χαρακτήρες.',
        'array'   => 'Το πεδίο (:attribute) πρέπει να έχει μεταξύ :min και :max αντικείμενα.',
    ],
    'boolean'              => 'Το πεδίο (:attribute) field πρέπει να είναι true ή false.',
    'confirmed'            => 'Το πεδίο (:attribute) δεν ταιρίαζει.',
    'date'                 => 'Το πεδίο (:attribute) δεν είναι έγκυρη ημερομηνία.',
    'date_format'          => 'Το πεδίο (:attribute) δεν ταιρίαζει με το φορμάτ :format.',
    'different'            => 'Το πεδίο (:attribute) και :other πρέπει να είναι διαφορετικά.',
    'digits'               => 'Το πεδίο (:attribute) πρέπει να είναι :digits ψηφία.',
    'digits_between'       => 'Το πεδίο (:attribute) πρέπει να είναι μεταξύ :min and :max ψηφία.',
    'dimensions'           => 'Οι διαστάσεις για (:attribute) πρέπει να είναι ελάχιστο(:min_width πλάτος x :min_height ύψος) - μέγιστο(:max_widthx:max_height)',
    'distinct'             => 'Το πεδίο (:attribute) είναι διπλότυπο.',
    'email'                => 'Το πεδίο (:attribute) πρέπει να είναι εγκυρη  email διεύθυνση.',
    'exists'               => 'Το επιλεγμένο (:attribute) δεν είναι έγκυρο.',
    'file'                 => 'Το πεδίο (:attribute) πρέπει να είναι αρχείο.',
    'filled'               => 'Το πεδίο (:attribute) πρέπει να έχει μια τιμή.',
    'image'                => 'Το πεδίο (:attribute) πρέπει να είναι εικόνα.',
    'in'                   => 'Το επιλεγμένο (:attribute) δεν είναι έγκυρο.',
    'in_array'             => 'Το πεδίο (:attribute) δεν υπάρχει σε :other.',
    'integer'              => 'Το πεδίο (:attribute) πρέπει να είναι ακέραιος αριθμός.',
    'ip'                   => 'Το πεδίο (:attribute) πρέπει να είναι έγκυρη IP address.',
    'ipv4'                 => 'Το πεδίο (:attribute) πρέπει να είναι έγκυρη IPv4 address.',
    'ipv6'                 => 'Το πεδίο (:attribute) πρέπει να είναι έγκυρη IPv6 address.',
    'json'                 => 'Το πεδίο (:attribute) πρέπει να είναι έγκυρο JSON string.',
    'max'                  => [
        'numeric' => 'Το πεδίο (:attribute) δεν πρέπει να είναι μεγαλύτερο από :max.',
        'file'    => 'Το πεδίο (:attribute) δεν πρέπει να είναι μεγαλύτερο από :max kilobytes.',
        'string'  => 'Το πεδίο (:attribute) δεν πρέπει να είναι μεγαλύτερο από :max χαρακτήρες.',
        'array'   => 'Το πεδίο (:attribute) δεν πρέπει να έχει περισσότερα από :max αντικείμενα.',
    ],
    'mimes'                => 'Το πεδίο (:attribute) πρέπει να είναι αρχείο τύπου: :values.',
    'mimetypes'            => 'Το πεδίο (:attribute) πρέπει να είναι αρχείο τύπου: :values.',
    'min'                  => [
        'numeric' => 'Το πεδίο (:attribute) πρέπει να είναι τουλάχιστον :min.',
        'file'    => 'Το πεδίο (:attribute) πρέπει να είναι τουλάχιστον :min kilobytes.',
        'string'  => 'Το πεδίο (:attribute) πρέπει να έχει τουλάχιστον :min χαρακτήρες.',
        'array'   => 'Το πεδίο (:attribute) πρέπει να έχει τουλάχιστον :min αντικείμενα.',
    ],
    'not_in'               => 'Το επιλεγμένο (:attribute) δεν είναι έγκυρο.',
    'numeric'              => 'Το πεδίο (:attribute) πρέπει να είναι αριθμός.',
    'present'              => 'Το πεδίο (:attribute) πρέπει να είναι παρόν.',
    'regex'                => 'Το πεδίο (:attribute) δεν έχει έγκυρο φορμάτ.',
    'required'             => 'Το πεδίο (:attribute) είναι απαραίτητο.',
    'required_if'          => 'Το πεδίο (:attribute) είναι απαραίτητο όταν :other είναι :value.',
    'required_unless'      => 'Το πεδίο (:attribute) είναι απαραίτητο εκτός και :other είναι μεταξύ :values.',
    'required_with'        => 'Το πεδίο (:attribute) είναι απαραίτητο όταν :values είναι παρόν.',
    'required_with_all'    => 'Το πεδίο (:attribute) είναι απαραίτητο όταν :values είναι παρόν.',
    'required_without'     => 'Το πεδίο (:attribute) είναι απαραίτητο όταν :values δεν είναι παρόν.',
    'required_without_all' => 'Το πεδίο (:attribute) είναι απαραίτητο όταν κανένα από τα  :values δεν είναι παρόν.',
    'same'                 => 'Το πεδίο (:attribute) και :other πρέπει να ταιριάζουν.',
    'size'                 => [
        'numeric' => 'Το πεδίο (:attribute) πρέπει να είναι :size.',
        'file'    => 'Το πεδίο (:attribute) πρέπει να είναι :size kilobytes.',
        'string'  => 'Το πεδίο (:attribute) πρέπει να είναι :size χαρακτήρες.',
        'array'   => 'Το πεδίο (:attribute) πρέπι να περιέχει :size αντικείμενα.',
    ],
    'string'               => 'Το πεδίο (:attribute) πρέπει να είναι string.',
    'timezone'             => 'Το πεδίο (:attribute) πρέπει να είναι έγκυρη ζώνη.',
    'unique'               => 'Το πεδίο (:attribute) είναι ήδη δεσμευμένο.',
    'uploaded'             => 'Το περιεχόμενο του πεδίου (:attribute) απέτυχε να ανέβει.',
    'url'                  => 'Το πεδίο (:attribute) δεν έχει έγκυρο φορμάτ.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'title' => [
            //'rule-name' => 'custom-message',
            //'required' => 'Ο Τίτλος είναι υποχρεωτικός', // very rare case... default messages above is more than enough
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [

        'main_img' => 'Βασική Εικόνα',
        'name' => 'Όνομα',
        'seotitle' => 'Tίτλος SEO',
        'title' => 'Τίτλος',
        'sortdesc' => 'Σύντομη Περιγραφή',
        'postbody' => 'Κυρίως Κείμενο',
        'tags' => 'Ετικέτες',
        'metakeywords' => 'Meta Λέξεις Κλειδιά',
        'metatitle' => 'Meta Τίτλος',
        'metadesc' => 'Meta Περιγραφή',
        'order' => 'Κατάταξη',

    ],

];
