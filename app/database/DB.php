<?php


namespace clinela\database;


use Exception;
use mysqli;

class DB
{
    public $mysqli;

    /**
     * DB constructor.
     */
    public function __construct()
    {
        $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE) or die("Cannot connect to " . DB_DATABASE . " at " . DB_HOST);
        $this->mysqli = $mysqli;
        return $mysqli;
    }

    /**
     *Auto generate database tables
     */
    public function generateDBTables()
    {

        //$this->mysqli->query("DROP TABLE ".DB_PREFIX."_services");
        //$this->mysqli->query("DROP TABLE ".DB_PREFIX."_prescriptions");
        //$this->mysqli->query("DROP TABLE " . DB_PREFIX . "_appointments");

        $this->mysqli->query("CREATE TABLE IF NOT EXISTS " . DB_PREFIX . "_permissions (
  ID int(11) NOT NULL auto_increment,
  Lft int(11) NOT NULL,
  Rght int(11) NOT NULL,
  Title char(64) NOT NULL,
  Description text NOT NULL,
  PRIMARY KEY  (ID),
  KEY Title (Title),
  KEY Lft (Lft),
  KEY Rght (Rght)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1;");
        $this->mysqli->query("CREATE TABLE IF NOT EXISTS " . DB_PREFIX . "_rolepermissions (
  RoleID int(11) NOT NULL,
  PermissionID int(11) NOT NULL,
  AssignmentDate int(11) NOT NULL,
  PRIMARY KEY  (RoleID,PermissionID)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;");
        $this->mysqli->query("CREATE TABLE IF NOT EXISTS " . DB_PREFIX . "_roles (
  ID int(11) NOT NULL auto_increment,
  Lft int(11) NOT NULL,
  Rght int(11) NOT NULL,
  Title varchar(128) NOT NULL,
  Description text NOT NULL,
  PRIMARY KEY  (ID),
  KEY Title (Title),
  KEY Lft (Lft),
  KEY Rght (Rght)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;");
        $this->mysqli->query("CREATE TABLE IF NOT EXISTS " . DB_PREFIX . "_userroles (
  UserID int(11) NOT NULL,
  RoleID int(11) NOT NULL,
  AssignmentDate int(11) NOT NULL,
  PRIMARY KEY  (UserID,RoleID)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
");
        $this->mysqli->query("INSERT INTO " . DB_PREFIX . "_permissions (ID, Lft, Rght, Title, Description)
VALUES (1, 0, 1, 'root', 'root');");
        $this->mysqli->query("INSERT INTO " . DB_PREFIX . "_rolepermissions (RoleID, PermissionID, AssignmentDate)
VALUES (1, 1, UNIX_TIMESTAMP());");
        $this->mysqli->query("INSERT INTO " . DB_PREFIX . "_roles (ID, Lft, Rght, Title, Description)
VALUES (1, 0, 1, 'root', 'root');");
        $this->mysqli->query("INSERT INTO " . DB_PREFIX . "_userroles (UserID, RoleID, AssignmentDate)
VALUES (1, 1, UNIX_TIMESTAMP());");

        $this->mysqli->query("CREATE TABLE IF NOT EXISTS " . DB_PREFIX . "_users(id INT(11) PRIMARY KEY AUTO_INCREMENT,
        unique_id VARCHAR(23) NOT NULL UNIQUE,username VARCHAR(100) NOT NULL UNIQUE,email VARCHAR(100) NOT NULL UNIQUE,
        encrypted_password VARCHAR(200) NOT NULL,salt VARCHAR(10) NOT NULL,created_at TIMESTAMP DEFAULT NOW(),
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        status INT(1) DEFAULT '0' DEFAULT 0 )ENGINE=" . DB_ENGINE . " DEFAULT CHARSET=" . DB_CHARSET);

        $this->mysqli->query("CREATE TABLE " . DB_PREFIX . "_password_temp (
									id INT(11) PRIMARY KEY AUTO_INCREMENT,
									email varchar(250) NOT NULL UNIQUE ,
  									pass_key varchar(250) NOT NULL,
  									expDate datetime NOT NULL)");

        $this->mysqli->query("CREATE TABLE IF NOT EXISTS " . DB_PREFIX . "_meta(id INT(11) PRIMARY KEY AUTO_INCREMENT,user_id INT(11) NOT NULL ,
		first_name VARCHAR(100) NOT NULL ,last_name VARCHAR(100) NOT NULL ,blood VARCHAR(100),bank_name VARCHAR(100),account_no VARCHAR(100),gender VARCHAR(100),
		phone VARCHAR(20),dob VARCHAR(100),city VARCHAR(100),state VARCHAR(100),country VARCHAR(100),
		address VARCHAR(200),photo VARCHAR(300),role INT(11) default 0,
		created_at TIMESTAMP DEFAULT NOW(),updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
		FOREIGN KEY (user_id) REFERENCES " . DB_PREFIX . "_users(id) ON DELETE CASCADE)
		ENGINE=" . DB_ENGINE . " DEFAULT CHARSET=" . DB_CHARSET);


        $this->mysqli->query("CREATE TABLE " . DB_PREFIX . "_logins (
  id INT(10) NOT NULL AUTO_INCREMENT,
  user_id INT(11) DEFAULT NULL,
  device VARCHAR(200) DEFAULT NULL,
  browser VARCHAR(200) DEFAULT NULL,
  ip_address VARCHAR(100) NOT NULL, 
  created_at TIMESTAMP DEFAULT NOW(),
  FOREIGN KEY (user_id) REFERENCES " . DB_PREFIX . "_users(id) ON DELETE CASCADE,
  PRIMARY KEY (id))ENGINE=" . DB_ENGINE . " DEFAULT CHARSET=" . DB_CHARSET);

        $this->mysqli->query("CREATE TABLE IF NOT EXISTS " . DB_PREFIX . "_options(id INT(11) NOT NULL AUTO_INCREMENT,
		setting VARCHAR(100) NOT NULL UNIQUE ,setting_value TEXT,PRIMARY KEY (id))
		ENGINE=" . DB_ENGINE . ' DEFAULT CHARSET=' . DB_CHARSET);

        $this->mysqli->query("CREATE TABLE IF NOT EXISTS " . DB_PREFIX . "_education(id INT(11) NOT NULL AUTO_INCREMENT,
        user_id INT(11) NOT NULL,
        degree VARCHAR(100),college VARCHAR(100),completion VARCHAR(100),created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
         ,FOREIGN KEY (user_id) REFERENCES " . DB_PREFIX . "_users(id) ON DELETE CASCADE,PRIMARY KEY (id))
         ENGINE=" . DB_ENGINE . ' DEFAULT CHARSET=' . DB_CHARSET);

        $this->mysqli->query("CREATE TABLE IF NOT EXISTS " . DB_PREFIX . "_experience(id INT(11) NOT NULL AUTO_INCREMENT,
        user_id INT(11) NOT NULL,
        hospital VARCHAR(100),date_from VARCHAR(100),date_to VARCHAR(100),designation VARCHAR(100),created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
         ,FOREIGN KEY (user_id) REFERENCES " . DB_PREFIX . "_users(id) ON DELETE CASCADE,PRIMARY KEY (id))
         ENGINE=" . DB_ENGINE . ' DEFAULT CHARSET=' . DB_CHARSET);

        $this->mysqli->query("CREATE TABLE IF NOT EXISTS " . DB_PREFIX . "_awards(id INT(11) NOT NULL AUTO_INCREMENT,
        user_id INT(11) NOT NULL,
        award VARCHAR(100),award_date VARCHAR(100),created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
         ,FOREIGN KEY (user_id) REFERENCES " . DB_PREFIX . "_users(id) ON DELETE CASCADE,PRIMARY KEY (id))
         ENGINE=" . DB_ENGINE . ' DEFAULT CHARSET=' . DB_CHARSET);

        $this->mysqli->query("CREATE TABLE IF NOT EXISTS " . DB_PREFIX . "_memberships(id INT(11) NOT NULL AUTO_INCREMENT,
        user_id INT(11) NOT NULL,
        membership VARCHAR(100),created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
         ,FOREIGN KEY (user_id) REFERENCES " . DB_PREFIX . "_users(id) ON DELETE CASCADE,PRIMARY KEY (id))
         ENGINE=" . DB_ENGINE . ' DEFAULT CHARSET=' . DB_CHARSET);

        $this->mysqli->query("CREATE TABLE IF NOT EXISTS " . DB_PREFIX . "_registrations(id INT(11) NOT NULL AUTO_INCREMENT,
        user_id INT(11) NOT NULL,
        registration VARCHAR(100),reg_date VARCHAR(100),created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
         ,FOREIGN KEY (user_id) REFERENCES " . DB_PREFIX . "_users(id) ON DELETE CASCADE,PRIMARY KEY (id))
         ENGINE=" . DB_ENGINE . ' DEFAULT CHARSET=' . DB_CHARSET);

        $this->mysqli->query("CREATE TABLE IF NOT EXISTS " . DB_PREFIX . "_specialities(id INT(11) NOT NULL AUTO_INCREMENT,
        speciality VARCHAR(100),speciality_image VARCHAR(200),created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,PRIMARY KEY (id))
         ENGINE=" . DB_ENGINE . ' DEFAULT CHARSET=' . DB_CHARSET);

        $this->mysqli->query("CREATE TABLE IF NOT EXISTS " . DB_PREFIX . "_services(id INT(11) NOT NULL AUTO_INCREMENT,
        user_id INT(11) NOT NULL,
        amount INT(11),services VARCHAR(200),created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
         ,FOREIGN KEY (user_id) REFERENCES " . DB_PREFIX . "_users(id) ON DELETE CASCADE,PRIMARY KEY (id))
         ENGINE=" . DB_ENGINE . ' DEFAULT CHARSET=' . DB_CHARSET);

        $this->mysqli->query("CREATE TABLE IF NOT EXISTS " . DB_PREFIX . "_user_speciality(id INT(11) NOT NULL AUTO_INCREMENT,
        user_id INT(11) NOT NULL UNIQUE ,
        speciality_id INT(11),created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
         ,FOREIGN KEY (user_id) REFERENCES " . DB_PREFIX . "_users(id) ON DELETE CASCADE,PRIMARY KEY (id))
         ENGINE=" . DB_ENGINE . ' DEFAULT CHARSET=' . DB_CHARSET);

        $this->mysqli->query("CREATE TABLE IF NOT EXISTS " . DB_PREFIX . "_post_categories(id INT(11) NOT NULL AUTO_INCREMENT,
        category VARCHAR(100),category_image VARCHAR(200),created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,PRIMARY KEY (id))
         ENGINE=" . DB_ENGINE . ' DEFAULT CHARSET=' . DB_CHARSET);

        $this->mysqli->query("CREATE TABLE IF NOT EXISTS " . DB_PREFIX . "_posts(id INT(11) NOT NULL AUTO_INCREMENT,
        user_id INT(11) NOT NULL DEFAULT 0,
        category_id INT(11),title VARCHAR(200),content VARCHAR(5000),post_image VARCHAR(200),tags VARCHAR(200),created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (user_id) REFERENCES " . DB_PREFIX . "_users(id) ON DELETE CASCADE,PRIMARY KEY (id))
         ENGINE=" . DB_ENGINE . ' DEFAULT CHARSET=' . DB_CHARSET);

        $this->mysqli->query("CREATE TABLE IF NOT EXISTS " . DB_PREFIX . "_post_comments(id INT(11) NOT NULL AUTO_INCREMENT,
        post_id INT(11),username VARCHAR(200),email VARCHAR(200),comment VARCHAR(1000),created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (post_id) REFERENCES " . DB_PREFIX . "_posts(id) ON DELETE CASCADE,PRIMARY KEY (id))
         ENGINE=" . DB_ENGINE . ' DEFAULT CHARSET=' . DB_CHARSET);

        $this->mysqli->query("CREATE TABLE IF NOT EXISTS " . DB_PREFIX . "_reviews(id INT(11) NOT NULL AUTO_INCREMENT,
        user_id INT(11),rating INT(11) DEFAULT 0,title VARCHAR(200),review VARCHAR(200),created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (user_id) REFERENCES " . DB_PREFIX . "_users(id) ON DELETE CASCADE,PRIMARY KEY (id))
         ENGINE=" . DB_ENGINE . ' DEFAULT CHARSET=' . DB_CHARSET);

        $this->mysqli->query("CREATE TABLE IF NOT EXISTS " . DB_PREFIX . "_features(id INT(11) NOT NULL AUTO_INCREMENT,
        feature VARCHAR(100),feature_image VARCHAR(200),created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,PRIMARY KEY (id))
         ENGINE=" . DB_ENGINE . ' DEFAULT CHARSET=' . DB_CHARSET);

        $this->mysqli->query("CREATE TABLE IF NOT EXISTS " . DB_PREFIX . "_favourites(id INT(11) NOT NULL AUTO_INCREMENT,
        user_id INT(11) NOT NULL ,doctor_id INT(11) NOT NULL,created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
         ,FOREIGN KEY (user_id) REFERENCES " . DB_PREFIX . "_users(id) ON DELETE CASCADE,
         FOREIGN KEY (doctor_id) REFERENCES " . DB_PREFIX . "_users(id) ON DELETE CASCADE,PRIMARY KEY (id))
         ENGINE=" . DB_ENGINE . ' DEFAULT CHARSET=' . DB_CHARSET);

        $this->mysqli->query("CREATE TABLE IF NOT EXISTS " . DB_PREFIX . "_slots(id INT(11) NOT NULL AUTO_INCREMENT,
        user_id INT(11) NOT NULL,
        week_day INT(11),start_time TIME,end_time TIME ,created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
         ,FOREIGN KEY (user_id) REFERENCES " . DB_PREFIX . "_users(id) ON DELETE CASCADE,PRIMARY KEY (id))
         ENGINE=" . DB_ENGINE . ' DEFAULT CHARSET=' . DB_CHARSET);

        $this->mysqli->query("CREATE TABLE IF NOT EXISTS " . DB_PREFIX . "_socials(id INT(11) NOT NULL AUTO_INCREMENT,
        user_id INT(11) NOT NULL DEFAULT 0,
        whatsapp VARCHAR(500),twitter VARCHAR(500),facebook VARCHAR(500),instagram VARCHAR(500),
        telegram VARCHAR(500),linkedin VARCHAR(500),skype VARCHAR(500),
        zoom VARCHAR(500),created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (user_id) REFERENCES " . DB_PREFIX . "_users(id) ON DELETE CASCADE,PRIMARY KEY (id))
         ENGINE=" . DB_ENGINE . ' DEFAULT CHARSET=' . DB_CHARSET);

        $this->mysqli->query("CREATE TABLE IF NOT EXISTS " . DB_PREFIX . "_clinics(id INT(11) NOT NULL AUTO_INCREMENT,
        user_id INT(11) NOT NULL,clinic VARCHAR(200),address VARCHAR(200),phone VARCHAR(100),details VARCHAR(1000),
        clinic_image VARCHAR(200),status INT(11) DEFAULT 0,created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,PRIMARY KEY (id))
         ENGINE=" . DB_ENGINE . ' DEFAULT CHARSET=' . DB_CHARSET);

        $this->mysqli->query("CREATE TABLE IF NOT EXISTS " . DB_PREFIX . "_appointments(id INT(11) NOT NULL AUTO_INCREMENT,
        user_id INT(11) NOT NULL,doctor_id INT(11) NOT NULL,book_date DATE,follow_date DATE,slot_id INT(11),service_id INT(11),
        tax INT(11),total INT(11),fee INT(11),amount INT(11),details VARCHAR(1000),pay_method INT(11),tx_id VARCHAR(200),
        status INT(11) DEFAULT 0,created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (user_id) REFERENCES " . DB_PREFIX . "_users(id) ON DELETE CASCADE,
        FOREIGN KEY (doctor_id) REFERENCES " . DB_PREFIX . "_users(id) ON DELETE CASCADE,PRIMARY KEY (id))
        ENGINE=" . DB_ENGINE . ' DEFAULT CHARSET=' . DB_CHARSET);

        $this->mysqli->query("CREATE TABLE IF NOT EXISTS " . DB_PREFIX . "_records(id INT(11) NOT NULL AUTO_INCREMENT,
        user_id INT(11) NOT NULL ,description VARCHAR(500),attachment VARCHAR(200),
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
         ,FOREIGN KEY (user_id) REFERENCES " . DB_PREFIX . "_users(id) ON DELETE CASCADE,
         PRIMARY KEY (id))ENGINE=" . DB_ENGINE . ' DEFAULT CHARSET=' . DB_CHARSET);

        $this->mysqli->query("CREATE TABLE IF NOT EXISTS " . DB_PREFIX . "_prescriptions(id INT(11) NOT NULL AUTO_INCREMENT,
        user_id INT(11) NOT NULL ,doctor_id INT(11) NOT NULL,drug_name VARCHAR(200) NOT NULL, frequency VARCHAR (200),days VARCHAR(200),
        advice VARCHAR(200),total VARCHAR(200),created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
         ,FOREIGN KEY (user_id) REFERENCES " . DB_PREFIX . "_users(id) ON DELETE CASCADE,
         FOREIGN KEY (doctor_id) REFERENCES " . DB_PREFIX . "_users(id) ON DELETE CASCADE,PRIMARY KEY (id))
         ENGINE=" . DB_ENGINE . ' DEFAULT CHARSET=' . DB_CHARSET);

        $this->mysqli->query("CREATE TABLE IF NOT EXISTS " . DB_PREFIX . "_chats(id INT(11) NOT NULL AUTO_INCREMENT,
        user_id INT(11) NOT NULL ,doctor_id INT(11) NOT NULL,content VARCHAR(500) NOT NULL, content_type INT(11) DEFAULT 0,created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
         ,FOREIGN KEY (user_id) REFERENCES " . DB_PREFIX . "_users(id) ON DELETE CASCADE,
         FOREIGN KEY (doctor_id) REFERENCES " . DB_PREFIX . "_users(id) ON DELETE CASCADE,PRIMARY KEY (id))
         ENGINE=" . DB_ENGINE . ' DEFAULT CHARSET=' . DB_CHARSET);

        $this->addOption('site_name', 'Clinela Doctors');
        $this->addOption('site_email', 'admin@clineladoctors.com');
        $this->addOption('site_copyright', 'ClinelaDoctors. All rights reserved.');
        $this->addOption('site_support_address', 'Ntinda, Uganda');
        $this->addOption('site_support_phone', '+256 786 166971');
        $this->addOption('site_support_email', 'admin@clineladoctors.com');
        $this->addOption('header_logo', '');
        $this->addOption('footer_text', '');
        $this->addOption('footer_logo', '');

        $this->addOption('section_1_title', '');
        $this->addOption('section_1_subtitle', '');
        $this->addOption('section_1_banner', '');
        $this->addOption('section_1_show', true);

        $this->addOption('section_2_title', '');
        $this->addOption('section_2_subtitle', '');
        $this->addOption('section_2_count', '5');
        $this->addOption('section_2_show', true);

        $this->addOption('section_3_title', '');
        $this->addOption('section_3_subtitle', '');
        $this->addOption('section_3_content', '');
        $this->addOption('section_3_count', '3');
        $this->addOption('section_3_show', true);

        $this->addOption('section_4_title', '');
        $this->addOption('section_4_subtitle', '');
        $this->addOption('section_4_banner', '');
        $this->addOption('section_4_count', '5');
        $this->addOption('section_4_show', true);

        $this->addOption('social_facebook', '#');
        $this->addOption('social_twitter', '#');
        $this->addOption('social_linkedin', '#');
        $this->addOption('social_instagram', '#');
        $this->addOption('social_telegram', '#');
        $this->addOption('social_whatsapp', '#');

        $this->addOption('booking_fee', 0);
        $this->addOption('tax', 0);
        $this->addOption('flutterwave_public_key', '');
        $this->addOption('flutterwave_secret_key', '');
        $this->addOption('flutterwave_encryption_key', '');

        $this->addOption( 'header_color', '#fff' );
        $this->addOption( 'footer_color', '#1b5a90' );
        $this->addOption( 'sidebar_color', '#fff' );
        $this->addOption( 'admin_sidebar_color', '#1b5a90' );
        $this->addOption( 'page_color', '#f9f9f9' );

        $this->addOption( 'section_1_color', '#fff' );
        $this->addOption( 'section_2_color', '#f9f9f9' );
        $this->addOption( 'section_3_color', '#fff' );
        $this->addOption( 'section_4_color', '#f9f9f9' );
        $this->addOption( 'section_5_color', '#fff' );

        $this->addOption( 'site_header_code', '' );
        $this->addOption( 'site_footer_code', '' );



        //$this->mysqli->query("ALTER TABLE ".DB_PREFIX."_posts CHANGE content content VARCHAR(5000)");
       //$this->mysqli->query("ALTER TABLE ".DB_PREFIX."_meta ADD approved INT(11) NOT NULL DEFAULT '0' AFTER role");
       //$this->mysqli->query("ALTER TABLE ".DB_PREFIX."_meta ADD account_no VARCHAR(100) AFTER blood");
       //$this->mysqli->query("ALTER TABLE ".DB_PREFIX."_meta ADD bank_name VARCHAR(100) AFTER blood");
    }

    /**
     * Storing new user
     * returns user details
     *
     * @param $username
     * @param $email
     * @param $password
     *
     * @return array|null
     * @throws Exception
     */
    public function storeUser($username, $email, $password)
    {
        $uuid = $this->getUUID();
        $hash = $this->hashSSHA($password);
        $encrypted_password = $hash["encrypted"]; // encrypted password
        $salt = $hash["salt"]; // salt

        $stmt = $this->mysqli->prepare("INSERT INTO " . DB_PREFIX . "_users(unique_id, username, email,encrypted_password, salt, created_at) VALUES(?, ?, ?,?, ?, NOW())");
        $stmt->bind_param("sssss", $uuid, $username, $email, $encrypted_password, $salt);
        $result = $stmt->execute();
        // check for successful store
        if ($result) {
            $results = $this->mysqli->query("SELECT * FROM " . DB_PREFIX . "_users WHERE email ='" . $email . "'");
            $user = $results->fetch_assoc();
            $stmt->close();
        }
        if (!empty($user)) {
            return $user;
        }
        return null;
    }

    /**
     * Get user by email and password
     *
     * @param $email
     * @param $password
     *
     * @return null
     */
    public function getUserByEmailAndPassword($email, $password)
    {
        $user = null;
        $results = $this->mysqli->query("SELECT * FROM " . DB_PREFIX . "_users WHERE email ='$email' OR username='$email'");
        $user = $results->fetch_assoc();
        if (!is_null($user)) {

            $results->close();
            $meta = $this->getUserMeta($user['id']);
            // verifying user password
            $salt = $user['salt'];
            $encrypted_password = $user['encrypted_password'];
            $hash = $this->checkHashSSHA($salt, $password);
            // check for password equality
            if ($encrypted_password == $hash) {
                // user authentication details are correct
                // Get the user-agent string of the user.
                $user_browser = $_SERVER['SERVER_ADDR'] . $_SERVER['SERVER_PORT'];
                // XSS protection as we might print this value

                if ($user['status'] != '1') {
                    header('Location:' . BASE_PATH . 'registered/');

                    return false;
                }
                $user_id = $user['unique_id'];
                $_SESSION['id'] = $user['id'];
                $_SESSION['user_id'] = $user_id;
                // XSS protection as we might print this value
                $username = preg_replace("/[^a-zA-Z0-9_\-]+/", " ", $user['username']);
                $_SESSION['timestamp'] = time();
                $_SESSION['username'] = $username;
                $_SESSION['role'] = $meta['role'];
                $_SESSION['login_string'] = hash('sha512',
                    $user['encrypted_password'] . $user_browser);
                $user['token'] = $_SESSION['login_string'];

                return $user;
            }
        } else {
            return null;
        }
        return null;
    }

    /**
     * Check if user is exists
     *
     * @param $email
     *
     * @return bool
     */
    public function isUserExisted($email)
    {
        $stmt = $this->mysqli->prepare("SELECT email FROM " . DB_PREFIX . "_users WHERE email = ?");

        $stmt->bind_param("s", $email);

        $stmt->execute();

        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            // user existed
            $stmt->close();

            return true;
        } else {
            // user not existed
            $stmt->close();

            return false;
        }
    }

    /**
     * Encrypting password
     * returns salt and encrypted password
     *
     * @param $password
     * @return array
     */
    public function hashSSHA($password)
    {

        $salt = sha1(rand());
        $salt = substr($salt, 0, 10);
        $encrypted = base64_encode(sha1($password . $salt, true) . $salt);
        return array("salt" => $salt, "encrypted" => $encrypted);
    }

    /**
     * Decrypting password
     *
     * @param $salt
     * @param $password
     *
     * @return string
     * @internal param $salt , password
     * returns hash string
     */
    public function checkHashSSHA($salt, $password)
    {

        return base64_encode(sha1($password . $salt, true) . $salt);
    }

    /**
     * Generate a unique user id
     *
     * @param int $length
     *
     * @return bool|string
     * @throws Exception
     * @throws Exception
     */
    function getUUID($length = 15)
    {
        // 15 digit Cryptographically Secure Pseudo-random Number
        if (function_exists("random_bytes")) {
            $bytes = random_bytes(ceil($length / 2));
        } elseif (function_exists("openssl_random_pseudo_bytes")) {
            $bytes = openssl_random_pseudo_bytes(ceil($length / 2));
        } else {
            $bytes = uniqid('', true);
        }

        return substr(bin2hex($bytes), 0, $length);
    }

    /**
     *Starts a php session
     */
    function start_session()
    {
        $session_name = 'omh_session_id';   // Set a custom session name
        /*Sets the session name.
         *This must come before session_set_cookie_params due to an undocumented bug/feature in PHP.
         */
        session_name($session_name);

        // This stops JavaScript being able to access the session id.
        // Forces sessions to only use cookies.
        if (ini_set('session.use_only_cookies', 1) === false) {
            header("Location: ../error.php?err=Could not initiate a safe session (ini_set)");
            exit();
        }
        // Gets current cookies params.
        session_get_cookie_params();
        /*session_set_cookie_params($cookieParams["lifetime"],
            $cookieParams["path"],
            $cookieParams["domain"],
            $secure,
            $httponly);*/

        session_start();            // Start the PHP session
        session_regenerate_id(true);    // regenerated the session, delete the old one.
    }

    /**
     * Check whether user is logged in
     *
     * @param $uid
     * @param $token
     * @param $browser
     *
     * @return bool
     */
    function login_check($uid, $token, $browser)
    {
        // Check if all session variables are set
        if (!empty($token)) {

            $user_id = $uid;
            $login_string = $token;
            // Get the user-agent string of the user.
            $user_browser = $browser;

            if ($stmt = $this->mysqli->prepare("SELECT encrypted_password 
                                      FROM " . DB_PREFIX . "_users 
                                      WHERE unique_id = ? LIMIT 1")) {
                // Bind "$user_id" to parameter.
                $stmt->bind_param('s', $user_id);
                $stmt->execute();   // Execute the prepared query.
                $stmt->store_result();

                if ($stmt->num_rows == 1) {
                    // If the user exists get variables from result.
                    $stmt->bind_result($password);
                    $stmt->fetch();
                    $login_check = hash('sha512', $password . $user_browser);


                    if (hash_equals($login_check, $login_string)) {
                        // Logged In!!!!
                        return true;
                    } else {
                        // Not logged in
                        return false;
                    }


                } else {
                    // Not logged in
                    return false;
                }
            } else {
                // Not logged in
                return false;
            }
        } else {
            // Not logged in
            return false;
        }
    }

    function logout()
    {
        session_destroy();
        header('Location:' . BASE_PATH . 'login/');
    }

    public function hasAccess($return = '', $level = 0)
    {
        $return = !empty($return) ? '?return=' . $return : '';
        if (isset($_SESSION['user_id'],
            $_SESSION['username'],
            $_SESSION['login_string'])) {
            if (!$this->login_check($_SESSION['user_id'], $_SESSION['login_string'], $_SERVER['SERVER_ADDR'] . $_SERVER['SERVER_PORT'])) {
                header('Location:' . BASE_PATH . 'login/' . $return);
            }
            if ($_SESSION['role'] < $level) {
                header('Location:' . BASE_PATH . 'logout/');
            }
        } else {
            header('Location:' . BASE_PATH . 'login/' . $return);
        }


    }

    public function getUserByUID($uid)
    {
        $user = $this->mysqli->query("SELECT * FROM " . DB_PREFIX . "_users WHERE unique_id = '$uid'")->fetch_assoc();

        return !empty($user) ? $user : null;
    }

    public function getUserByUsername($username)
    {
        $user = $this->mysqli->query("SELECT * FROM " . DB_PREFIX . "_users WHERE username = '$username'")->fetch_assoc();

        return !empty($user) ? $user : null;
    }

    public function getUserByEmail($email)
    {
        $user = $this->mysqli->query("SELECT * FROM " . DB_PREFIX . "_users WHERE email = '$email'")->fetch_assoc();

        return !empty($user) ? $user : null;
    }

    public function getUserByID($id)
    {
        $user = $this->mysqli->query("SELECT * FROM " . DB_PREFIX . "_users WHERE id = $id")->fetch_assoc();

        return !empty($user) ? $user : null;
    }

    public function getAllUsers()
    {
        $stmt = "SELECT * FROM " . DB_PREFIX . "_users";
        $results = $this->mysqli->query($stmt);

        $data = array();
        while ($user = $results->fetch_assoc()) {
            $data[] = $user;
        }

        return $data;
    }

    public function getUsersByRole($role, $limit = '', $location = '')
    {
        $to_limit = !empty($limit) ? ' LIMIT ' . $limit : '';
        $location = !empty($location) ? "AND b.city like'%" . $location . "%' " : "";
        $stmt = "SELECT a.id,a.username,a.email,b.first_name,b.last_name,b.phone,b.city,b.state,b.country,
        b.photo,b.role,b.approved,a.created_at FROM " . DB_PREFIX . "_users a," . DB_PREFIX . "_meta b  WHERE a.id=b.user_id " . $location . " 
        AND  b.role= $role ORDER BY a.id DESC" . $to_limit;
        $results = $this->mysqli->query($stmt);

        $data = array();
        while ($user = $results->fetch_assoc()) {
            $data[] = $user;
        }

        return $data;
    }

    public function getApprovedUsers($role, $limit = '', $location = '',$search='')
    {
        $to_limit = !empty($limit) ? ' LIMIT ' . $limit : '';
        $location = !empty($location) ? "AND b.city like'%" . $location . "%' " : "";
        $search = !empty($search) ? "AND (b.first_name like'%" . $search . "%' OR b.last_name like'%" . $search . "%') " : "";
        $stmt = "SELECT a.id,a.username,a.email,b.first_name,b.last_name,b.phone,b.city,b.state,b.country,
        b.photo,b.role,b.account_no,b.bank_name,a.created_at FROM " . DB_PREFIX . "_users a," . DB_PREFIX . "_meta b  WHERE a.id=b.user_id " . $location .$search. " 
        AND  b.role= $role AND b.approved=1 ORDER BY a.id DESC" . $to_limit;
        $results = $this->mysqli->query($stmt);

        $data = array();
        while ($user = $results->fetch_assoc()) {
            $data[] = $user;
        }

        return $data;
    }
    public function getUserMeta($id)
    {
        $stmt = "SELECT a.id,b.user_id,a.username,a.email,b.first_name,b.last_name,b.phone,b.city,b.state,b.country,b.address,
        b.photo,b.role,b.approved,b.dob,b.blood,b.gender,b.account_no,b.bank_name,a.created_at FROM " . DB_PREFIX . "_users a," . DB_PREFIX . "_meta b  WHERE a.id=b.user_id 
        AND  a.id= $id ORDER BY a.id DESC";
        $user = $this->mysqli->query($stmt)->fetch_assoc();
        return !empty($user) ? $user : null;
    }

    public function getAllUserMeta()
    {
        $stmt = "SELECT a.id,b.user_id,a.username,a.email,b.first_name,b.last_name,b.phone,b.city,b.state,b.country,b.address,
        b.photo,b.role,b.approved,b.dob,b.blood,b.gender,a.created_at FROM " . DB_PREFIX . "_users a," . DB_PREFIX . "_meta b  WHERE a.id=b.user_id 
        ORDER BY a.id DESC";
        $results = $this->mysqli->query($stmt);

        $data = array();
        while ($user = $results->fetch_assoc()) {
            $data[] = $user;
        }

        return $data;
    }

    function updateUserPassword($encrypted_password, $salt, $id)
    {
        $this->mysqli->query("UPDATE " . DB_PREFIX . "_users SET encrypted_password='$encrypted_password', salt='$salt', updated_at=CURRENT_TIMESTAMP WHERE id=$id");

        return true;
    }

    function deleteUserByID($id)
    {
        $stmt = $this->mysqli->prepare("DELETE FROM " . DB_PREFIX . "_users WHERE id = ?");
        $stmt->bind_param("i", $id);
        $result = $stmt->execute();
        $stmt->close();

        return $result;
    }

    public function addUserMeta($user)
    {
        $user_id = $user['user_id'];
        $first_name = $user['first_name'];
        $last_name = $user['last_name'];
        $phone = $user['phone'];
        $dob = $user['dob'];
        $country = $user['country'];
        $role = $user['role'];
        $stmt = $this->mysqli->prepare("INSERT INTO " . DB_PREFIX . "_meta (user_id, first_name,last_name,phone, dob, country,role) VALUES (?,?, ?, ?, ?, ?,?)");
        $stmt->bind_param("isssssi", $user_id, $first_name, $last_name, $phone, $dob, $country, $role);
        $result = $stmt->execute();
        $stmt->close();

        return $result;
    }

    function updateUserMeta($user)
    {
        $user_id = $user['user_id'];
        $first_name = $user['first_name'];
        $last_name = $user['last_name'];
        $phone = $user['phone'];
        $dob = $user['dob'];
        $blood = $user['blood'];
        $city = $user['city'];
        $state = $user['state'];
        $country = $user['country'];
        $gender = $user['gender'];
        $address = $user['address'];
        $photo = $user['photo'];
        $account_no = $user['account_no'];
        $bank_name = $user['bank_name'];
        if (is_null($this->getUserMeta($user_id))) {
            $this->addUserMeta($user);
        } else {
            $this->mysqli->query("UPDATE " . DB_PREFIX . "_meta SET first_name = '$first_name',last_name='$last_name',phone='$phone', dob='$dob',blood='$blood',city='$city',state='$state', country='$country', address='$address',gender='$gender', photo='$photo',account_no='$account_no',bank_name='$bank_name' WHERE user_id = '$user_id'");
        }

    }

    public function addEducation($user_id, $degree, $college = '', $completion = '')
    {

        $stmt = $this->mysqli->prepare("INSERT INTO " . DB_PREFIX . "_education (user_id, degree,college,completion) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("isss", $user_id, $degree, $college, $completion);
        $result = $stmt->execute();
        $stmt->close();

        return $result;
    }

    public function getEducation($id)
    {
        $stmt = "SELECT * FROM " . DB_PREFIX . "_education WHERE user_id = $id";
        $results = $this->mysqli->query($stmt);

        $data = array();
        while ($user = $results->fetch_assoc()) {
            $data[] = $user;
        }

        return $data;
    }

    function deleteEducation($id)
    {
        $stmt = $this->mysqli->prepare("DELETE FROM " . DB_PREFIX . "_education WHERE id = ?");
        $stmt->bind_param("i", $id);
        $result = $stmt->execute();
        $stmt->close();

        return $result;
    }

    public function addExperience($user_id, $hospital, $from = '', $to = '', $designation = '')
    {

        $stmt = $this->mysqli->prepare("INSERT INTO " . DB_PREFIX . "_experience (user_id, hospital,date_from,date_to,designation) VALUES (?, ?, ?, ?,?)");
        $stmt->bind_param("issss", $user_id, $hospital, $from, $to, $designation);
        $result = $stmt->execute();
        $stmt->close();

        return $result;
    }

    function getExperience($id)
    {
        $stmt = "SELECT * FROM " . DB_PREFIX . "_experience WHERE user_id = $id";
        $results = $this->mysqli->query($stmt);

        $data = array();
        while ($user = $results->fetch_assoc()) {
            $data[] = $user;
        }

        return $data;
    }

    function deleteExperience($id)
    {
        $stmt = $this->mysqli->prepare("DELETE FROM " . DB_PREFIX . "_experience WHERE id = ?");
        $stmt->bind_param("i", $id);
        $result = $stmt->execute();
        $stmt->close();

        return $result;
    }

    public function addAward($user_id, $award, $award_date = '')
    {

        $stmt = $this->mysqli->prepare("INSERT INTO " . DB_PREFIX . "_awards (user_id, award,award_date) VALUES (?, ?, ?)");
        $stmt->bind_param("iss", $user_id, $award, $award_date);
        $result = $stmt->execute();
        $stmt->close();

        return $result;
    }

    function getAwards($id)
    {
        $stmt = "SELECT * FROM " . DB_PREFIX . "_awards WHERE user_id = $id";
        $results = $this->mysqli->query($stmt);

        $data = array();
        while ($user = $results->fetch_assoc()) {
            $data[] = $user;
        }

        return $data;
    }

    function deleteAward($id)
    {
        $stmt = $this->mysqli->prepare("DELETE FROM " . DB_PREFIX . "_awards WHERE id = ?");
        $stmt->bind_param("i", $id);
        $result = $stmt->execute();
        $stmt->close();

        return $result;
    }

    public function addMembership($user_id, $membership)
    {

        $stmt = $this->mysqli->prepare("INSERT INTO " . DB_PREFIX . "_memberships (user_id, membership) VALUES (?, ?)");
        $stmt->bind_param("is", $user_id, $membership);
        $result = $stmt->execute();
        $stmt->close();

        return $result;
    }

    function getMembership($id)
    {
        $stmt = "SELECT * FROM " . DB_PREFIX . "_memberships WHERE user_id = $id";
        $results = $this->mysqli->query($stmt);

        $data = array();
        while ($user = $results->fetch_assoc()) {
            $data[] = $user;
        }

        return $data;
    }

    function deleteMembership($id)
    {
        $stmt = $this->mysqli->prepare("DELETE FROM " . DB_PREFIX . "_memberships WHERE id = ?");
        $stmt->bind_param("i", $id);
        $result = $stmt->execute();
        $stmt->close();

        return $result;
    }

    public function addRegistration($user_id, $registration, $reg_date = '')
    {

        $stmt = $this->mysqli->prepare("INSERT INTO " . DB_PREFIX . "_registrations (user_id, registration,reg_date) VALUES (?, ?, ?)");
        $stmt->bind_param("iss", $user_id, $registration, $reg_date);
        $result = $stmt->execute();
        $stmt->close();

        return $result;
    }

    function getRegistration($id)
    {
        $stmt = "SELECT * FROM " . DB_PREFIX . "_registrations WHERE user_id = $id";
        $results = $this->mysqli->query($stmt);

        $data = array();
        while ($user = $results->fetch_assoc()) {
            $data[] = $user;
        }

        return $data;
    }

    function deleteRegistration($id)
    {
        $stmt = $this->mysqli->prepare("DELETE FROM " . DB_PREFIX . "_registrations WHERE id = ?");
        $stmt->bind_param("i", $id);
        $result = $stmt->execute();
        $stmt->close();

        return $result;
    }

    public function addSpecialities($speciality, $speciality_image = '')
    {

        $stmt = $this->mysqli->prepare("INSERT INTO " . DB_PREFIX . "_specialities (speciality,speciality_image) VALUES (?, ?)");
        $stmt->bind_param("ss", $speciality, $speciality_image);
        $result = $stmt->execute();
        $stmt->close();

        return $result;
    }

    public function getSpecialities($limit = '')
    {
        $to_limit = !empty($limit) ? ' LIMIT ' . $limit : '';
        $stmt = "SELECT * FROM " . DB_PREFIX . "_specialities" . $to_limit;
        $results = $this->mysqli->query($stmt);

        $data = array();
        while ($user = $results->fetch_assoc()) {
            $data[] = $user;
        }

        return $data;
    }

    public function getSpecialitiesByID($id)
    {
        $stmt = "SELECT * FROM " . DB_PREFIX . "_specialities WHERE id = $id";
        $result = $this->mysqli->query($stmt)->fetch_assoc();

        return !empty($result) ? $result : null;
    }

    function deleteSpeciality($id)
    {
        $stmt = $this->mysqli->prepare("DELETE FROM " . DB_PREFIX . "_specialities WHERE id = ?");
        $stmt->bind_param("i", $id);
        $result = $stmt->execute();
        $stmt->close();

        return $result;
    }

    public function addFeatures($feature, $feature_image = '')
    {

        $stmt = $this->mysqli->prepare("INSERT INTO " . DB_PREFIX . "_features (feature,feature_image) VALUES (?, ?)");
        $stmt->bind_param("ss", $feature, $feature_image);
        $result = $stmt->execute();
        $stmt->close();

        return $result;
    }

    public function getFeatures($limit = '')
    {
        $to_limit = !empty($limit) ? ' LIMIT ' . $limit : '';
        $stmt = "SELECT * FROM " . DB_PREFIX . "_features" . $to_limit;
        $results = $this->mysqli->query($stmt);

        $data = array();
        while ($user = $results->fetch_assoc()) {
            $data[] = $user;
        }

        return $data;
    }

    public function getFeatureByID($id)
    {
        $stmt = "SELECT * FROM " . DB_PREFIX . "_features WHERE id = $id";
        $result = $this->mysqli->query($stmt)->fetch_assoc();

        return !empty($result) ? $result : null;
    }

    function deleteFeature($id)
    {
        $stmt = $this->mysqli->prepare("DELETE FROM " . DB_PREFIX . "_features WHERE id = ?");
        $stmt->bind_param("i", $id);
        $result = $stmt->execute();
        $stmt->close();

        return $result;
    }

    public function addUserSpeciality($user_id, $speciality_id)
    {

        $stmt = $this->mysqli->prepare("INSERT INTO " . DB_PREFIX . "_user_speciality (user_id,speciality_id) VALUES (?, ?)");
        $stmt->bind_param("ii", $user_id, $speciality_id);
        $result = $stmt->execute();
        $stmt->close();

        return $result;
    }

    public function addServices($user_id, $services, $amount = 0)
    {

        $stmt = $this->mysqli->prepare("INSERT INTO " . DB_PREFIX . "_services (user_id,services,amount) VALUES (?, ?,?)");
        $stmt->bind_param("isi", $user_id, $services, $amount);
        $result = $stmt->execute();
        $stmt->close();

        return $result;
    }

    public function getServices($id)
    {
        $stmt = "SELECT * FROM " . DB_PREFIX . "_services WHERE user_id = $id";
        $results = $this->mysqli->query($stmt);

        $data = array();
        while ($user = $results->fetch_assoc()) {
            $data[] = $user;
        }

        return $data;
    }

    public function getServiceByID($id)
    {
        $stmt = "SELECT * FROM " . DB_PREFIX . "_services WHERE id = $id";
        $result = $this->mysqli->query($stmt)->fetch_assoc();

        return !empty($result) ? $result : null;
    }

    public function getUserSpeciality($id)
    {
        $stmt = "SELECT a.id,b.id as speciality_id,b.speciality,b.speciality_image FROM " . DB_PREFIX . "_user_speciality a, " . DB_PREFIX . "_specialities b WHERE b.id=a.speciality_id AND a.user_id = $id";
        $result = $this->mysqli->query($stmt)->fetch_assoc();

        return !empty($result) ? $result : null;
    }

    public function deleteServices($id)
    {
        $stmt = $this->mysqli->prepare("DELETE FROM " . DB_PREFIX . "_services WHERE id = ?");
        $stmt->bind_param("i", $id);
        $result = $stmt->execute();
        $stmt->close();

        return $result;
    }

    function deleteUserSpeciality($id)
    {
        $stmt = $this->mysqli->prepare("DELETE FROM " . DB_PREFIX . "_user_speciality WHERE user_id = ?");
        $stmt->bind_param("i", $id);
        $result = $stmt->execute();
        $stmt->close();

        return $result;
    }

    function updateServices($user_id, $services, $amount)
    {
        $stmt = $this->mysqli->prepare("UPDATE " . DB_PREFIX . "_services SET services=?,amount=? WHERE user_id=?");
        $stmt->bind_param("sii", $services, $amount, $user_id);
        $result = $stmt->execute();
        $stmt->close();

        return $result;
    }

    function updateUserSpeciality($user_id, $speciality_id)
    {
        $stmt = $this->mysqli->prepare("UPDATE " . DB_PREFIX . "_user_speciality SET speciality_id=? WHERE user_id=?");
        $stmt->bind_param("ii", $speciality_id, $user_id);
        $result = $stmt->execute();
        $stmt->close();

        return $result;
    }

    public function addPost($user_id, $category = 0, $title, $content, $tags = '', $post_image = '')
    {

        $stmt = $this->mysqli->prepare("INSERT INTO " . DB_PREFIX . "_posts (user_id, category_id,title,content,tags,post_image) VALUES (?, ?, ?, ?,?,?)");
        $stmt->bind_param("iissss", $user_id, $category, $title, $content, $tags, $post_image);
        $result = $stmt->execute();
        $stmt->close();

        return $result;
    }

    public function getPosts($search='',$limit = '')
    {
        $to_limit = !empty($limit) ? ' LIMIT ' . $limit : ' ';
        $search = !empty($search) ? " WHERE title LIKE '%" . $search."%' " : " ";
        $stmt = "SELECT * FROM " . DB_PREFIX . "_posts".$search."ORDER BY id DESC" . $to_limit;
        $results = $this->mysqli->query($stmt);

        $data = array();
        while ($user = $results->fetch_assoc()) {
            $data[] = $user;
        }

        return $data;
    }

    function getPostByID($id)
    {
        $stmt = "SELECT * FROM " . DB_PREFIX . "_posts WHERE id = $id";
        $result = $this->mysqli->query($stmt)->fetch_assoc();

        return !empty($result) ? $result : null;
    }

    public function updatePost($post_id, $category, $title, $content, $tags, $post_image)
    {

        $stmt = $this->mysqli->prepare("UPDATE " . DB_PREFIX . "_posts SET category_id=?,title=?,content=?,tags=?,post_image=? WHERE id=$post_id");
        $stmt->bind_param("issss", $category, $title, $content, $tags, $post_image);
        $result = $stmt->execute();
        $stmt->close();

        return $result;
    }

    function deletePost($id)
    {
        $stmt = $this->mysqli->prepare("DELETE FROM " . DB_PREFIX . "_posts WHERE id = ?");
        $stmt->bind_param("i", $id);
        $result = $stmt->execute();
        $stmt->close();

        return $result;
    }

    public function addPostCategory($category, $category_image = '')
    {

        $stmt = $this->mysqli->prepare("INSERT INTO " . DB_PREFIX . "_post_categories (category,category_image) VALUES (?, ?)");
        $stmt->bind_param("ss", $category, $category_image);
        $result = $stmt->execute();
        $stmt->close();

        return $result;
    }

    public function getPostCategories($limit = '')
    {
        $to_limit = !empty($limit) ? ' LIMIT ' . $limit : '';
        $stmt = "SELECT * FROM " . DB_PREFIX . "_post_categories" . $to_limit;
        $results = $this->mysqli->query($stmt);

        $data = array();
        while ($user = $results->fetch_assoc()) {
            $data[] = $user;
        }

        return $data;
    }

    function getPostCategoryByID($id)
    {
        $stmt = "SELECT * FROM " . DB_PREFIX . "_post_categories WHERE id = $id";
        $result = $this->mysqli->query($stmt)->fetch_assoc();

        return !empty($result) ? $result : null;
    }

    function deletePostCategory($id)
    {
        $stmt = $this->mysqli->prepare("DELETE FROM " . DB_PREFIX . "_post_categories WHERE id = ?");
        $stmt->bind_param("i", $id);
        $result = $stmt->execute();
        $stmt->close();

        return $result;
    }

    public function addPostComment($post_id, $username, $email, $comment)
    {

        $stmt = $this->mysqli->prepare("INSERT INTO " . DB_PREFIX . "_post_comments (post_id, username,email,comment) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("isss", $post_id, $username, $email, $comment);
        $result = $stmt->execute();
        $stmt->close();

        return $result;
    }

    public function getAllPostComments($limit = '')
    {
        $to_limit = !empty($limit) ? ' LIMIT ' . $limit : '';
        $stmt = "SELECT * FROM " . DB_PREFIX . "_post_comments " . $to_limit;
        $results = $this->mysqli->query($stmt);

        $data = array();
        while ($user = $results->fetch_assoc()) {
            $data[] = $user;
        }

        return $data;
    }


    public function getPostComments($post_id, $limit = '')
    {
        $to_limit = !empty($limit) ? ' LIMIT ' . $limit : '';
        $stmt = "SELECT * FROM " . DB_PREFIX . "_post_comments WHERE post_id=$post_id" . $to_limit;
        $results = $this->mysqli->query($stmt);

        $data = array();
        while ($user = $results->fetch_assoc()) {
            $data[] = $user;
        }

        return $data;
    }

    function deletePostComment($id)
    {
        $stmt = $this->mysqli->prepare("DELETE FROM " . DB_PREFIX . "_post_comments WHERE id = ?");
        $stmt->bind_param("i", $id);
        $result = $stmt->execute();
        $stmt->close();

        return $result;
    }

    public function addReview($user_id, $rating, $title, $review)
    {
        $stmt = $this->mysqli->prepare("INSERT INTO " . DB_PREFIX . "_reviews (user_id, rating,title,review) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("iiss", $user_id, $rating, $title, $review);
        $result = $stmt->execute();
        $stmt->close();

        return $result;
    }

    public function getReviews($user_id, $limit = '')
    {
        $to_limit = !empty($limit) ? ' LIMIT ' . $limit : '';
        $stmt = "SELECT * FROM " . DB_PREFIX . "_reviews WHERE user_id=$user_id" . $to_limit;
        $results = $this->mysqli->query($stmt);

        $data = array();
        while ($user = $results->fetch_assoc()) {
            $data[] = $user;
        }

        return $data;
    }

    function deleteReview($id)
    {
        $stmt = $this->mysqli->prepare("DELETE FROM " . DB_PREFIX . "_reviews WHERE id = ?");
        $stmt->bind_param("i", $id);
        $result = $stmt->execute();
        $stmt->close();

        return $result;
    }

    public function addFavourite($user_id, $doctor_id)
    {
        $stmt = $this->mysqli->prepare("INSERT INTO " . DB_PREFIX . "_favourites (user_id, doctor_id) VALUES (?, ?)");
        $stmt->bind_param("ii", $user_id, $doctor_id);
        $result = $stmt->execute();
        $stmt->close();

        return $result;
    }

    public function getFavourites($user_id, $limit = '')
    {
        $to_limit = !empty($limit) ? ' LIMIT ' . $limit : '';
        $stmt = "SELECT * FROM " . DB_PREFIX . "_favourites WHERE user_id=$user_id" . $to_limit;
        $results = $this->mysqli->query($stmt);

        $data = array();
        while ($user = $results->fetch_assoc()) {
            $data[] = $user;
        }

        return $data;
    }

    function deleteFavourite($id)
    {
        $stmt = $this->mysqli->prepare("DELETE FROM " . DB_PREFIX . "_favourites WHERE id = ?");
        $stmt->bind_param("i", $id);
        $result = $stmt->execute();
        $stmt->close();

        return $result;
    }

    public function addClinic($user_id, $clinic, $address = '', $phone = '', $details = '', $clinic_image = '')
    {
        $stmt = $this->mysqli->prepare("INSERT INTO " . DB_PREFIX . "_clinics (user_id, 
        clinic,address,phone,details,clinic_image) VALUES (?, ?, ?, ?,?,?)");
        $stmt->bind_param("isssss", $user_id, $clinic, $address, $phone, $details, $clinic_image);
        $result = $stmt->execute();
        $stmt->close();

        return $result;
    }

    public function updateClinic($clinic_id, $clinic, $address, $phone, $details, $clinic_image)
    {

        $stmt = $this->mysqli->prepare("UPDATE " . DB_PREFIX . "_clinics SET clinic=?,address=?,phone=?,details=?,clinic_image=? WHERE id=$clinic_id");
        $stmt->bind_param("sssss", $clinic, $address, $phone, $details, $clinic_image);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    public function approveClinic($clinic_id, $status = 1)
    {
        $stmt = $this->mysqli->prepare("UPDATE " . DB_PREFIX . "_clinics SET status=? WHERE id=$clinic_id");
        $stmt->bind_param("i", $status);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    public function getAllClinics($api = false,$search='', $limit = '')
    {
        $to_limit = !empty($limit) ? ' LIMIT ' . $limit : '';
        $search = !empty($search) ? " WHERE clinic LIKE '%" . $search."%' " : " ";
        $stmt = "SELECT * FROM " . DB_PREFIX . "_clinics" .$search. $to_limit;
        if ($api) {
            $stmt = "SELECT id,clinic as text FROM " . DB_PREFIX . "_clinics" .$search. $to_limit;
        }
        $results = $this->mysqli->query($stmt);

        $data = array();
        while ($user = $results->fetch_assoc()) {
            $data[] = $user;
        }

        return $data;
    }

    public function getPagedClinics($limit = 5, $offset = 0, $search = '', $location = '', $sort = '')
    {
        $status = !empty($sort) ? " AND status =" . $sort : '';
        $address = !empty($location) ? " AND address LIKE '%" . $location . "%'" : '';
        $stmt = "SELECT* FROM " . DB_PREFIX . "_clinics 
        WHERE clinic like '%$search%'" . $status . $address . " ORDER BY id DESC LIMIT $offset, $limit";
        $results = $this->mysqli->query($stmt);
        $trXs = array();
        while ($trX = $results->fetch_assoc()) {
            $trXs[] = $trX;
        }

        return $trXs;
    }

    function getClinicsCount($sort = '', $search = '', $location = '')
    {
        $status = !empty($sort) ? " AND status =" . $sort : '';
        $address = !empty($location) ? " AND address LIKE '%" . $location . "%'" : '';
        $total_pages_sql = "SELECT* FROM " . DB_PREFIX . "_clinics WHERE clinic LIKE '%$search%'" . $status . $address . " ORDER BY id DESC";
        $stmt = $this->mysqli->prepare($total_pages_sql);
        $stmt->execute();
        $stmt->store_result();
        return $stmt->num_rows;
    }


    public function getApprovedClinics($limit = '')
    {
        $to_limit = !empty($limit) ? ' LIMIT ' . $limit : '';
        $stmt = "SELECT * FROM " . DB_PREFIX . "_clinics WHERE status=1" . $to_limit;
        $results = $this->mysqli->query($stmt);

        $data = array();
        while ($user = $results->fetch_assoc()) {
            $data[] = $user;
        }

        return $data;
    }

    function getClinicByID($id)
    {
        $stmt = "SELECT * FROM " . DB_PREFIX . "_clinics WHERE id = $id";
        $result = $this->mysqli->query($stmt)->fetch_assoc();

        return !empty($result) ? $result : null;
    }

    function deleteClinic($id)
    {
        $stmt = $this->mysqli->prepare("DELETE FROM " . DB_PREFIX . "_clinics WHERE id = ?");
        $stmt->bind_param("i", $id);
        $result = $stmt->execute();
        $stmt->close();

        return $result;
    }

    public function addSlot($user_id, $hospital_id, $week_day, $start_time, $end_time)
    {
        $stmt = $this->mysqli->prepare("INSERT INTO " . DB_PREFIX . "_slots (user_id, hospital_id,week_day,start_time,end_time) VALUES (?,?, ?, ?, ?)");
        $stmt->bind_param("iiiss", $user_id, $hospital_id, $week_day, $start_time, $end_time);
        $result = $stmt->execute();
        $stmt->close();

        return $result;
    }

    public function getUserSlotsByDay($user_id, $week_day)
    {
        $stmt = "SELECT * FROM " . DB_PREFIX . "_slots WHERE user_id=$user_id AND week_day=$week_day";
        $results = $this->mysqli->query($stmt);

        $data = array();
        while ($user = $results->fetch_assoc()) {
            $data[] = $user;
        }

        return $data;
    }

    public function getSlotByID($id)
    {
        $stmt = "SELECT * FROM " . DB_PREFIX . "_slots WHERE id = $id";
        $result = $this->mysqli->query($stmt)->fetch_assoc();

        return !empty($result) ? $result : null;
    }

    public function getUserSlots($user_id)
    {
        $stmt = "SELECT * FROM " . DB_PREFIX . "_slots WHERE user_id=$user_id";
        $results = $this->mysqli->query($stmt);

        $data = array();
        while ($user = $results->fetch_assoc()) {
            $data[] = $user;
        }

        return $data;
    }


    public function deleteSlotsByUserID($id)
    {
        $stmt = $this->mysqli->prepare("DELETE FROM " . DB_PREFIX . "_favourites WHERE user_id = ?");
        $stmt->bind_param("i", $id);
        $result = $stmt->execute();
        $stmt->close();

        return $result;
    }

    public function deleteSlot($id)
    {
        $stmt = $this->mysqli->prepare("DELETE FROM " . DB_PREFIX . "_slots WHERE id = ?");
        $stmt->bind_param("i", $id);
        $result = $stmt->execute();
        $stmt->close();

        return $result;
    }

    public function addSocialLinks($user_id, $links)
    {
        $whatsapp = $links['whatsapp'];
        $twitter = $links['twitter'];
        $facebook = $links['facebook'];
        $instagram = $links['instagram'];
        $telegram = $links['telegram'];
        $linkedin = $links['linkedin'];
        $skype = $links['skype'];
        $zoom = $links['zoom'];

        $stmt = $this->mysqli->prepare("INSERT INTO " . DB_PREFIX . "_socials (user_id, whatsapp,twitter,facebook,
        instagram,telegram,linkedin,skype,zoom) VALUES (?, ?, ?, ?,?,?,?,?,?)");
        $stmt->bind_param("issssssss", $user_id, $whatsapp, $twitter, $facebook, $instagram, $telegram,
            $linkedin, $skype, $zoom);
        $result = $stmt->execute();
        $stmt->close();

        return $result;

    }

    public function updateSocialLinks($user_id, $links)
    {

        $whatsapp = $links['whatsapp'];
        $twitter = $links['twitter'];
        $facebook = $links['facebook'];
        $instagram = $links['instagram'];
        $telegram = $links['telegram'];
        $linkedin = $links['linkedin'];
        $skype = $links['skype'];
        $zoom = $links['zoom'];
        $stmt = $this->mysqli->prepare("UPDATE " . DB_PREFIX . "_socials SET whatsapp=?,twitter=?,facebook=?,instagram=?,
        telegram=?,linkedin=?,skype=?,zoom=? WHERE user_id=$user_id");
        $stmt->bind_param("ssssssss", $whatsapp, $twitter, $facebook, $instagram, $telegram,
            $linkedin, $skype, $zoom);
        $result = $stmt->execute();
        $stmt->close();

        return $result;
    }

    public function getSocialLinks($user_id)
    {
        $stmt = "SELECT * FROM " . DB_PREFIX . "_socials WHERE user_id=$user_id";
        $result = $this->mysqli->query($stmt)->fetch_assoc();

        return !empty($result) ? $result : null;
    }

    function deleteSocialLinks($id)
    {
        $stmt = $this->mysqli->prepare("DELETE FROM " . DB_PREFIX . "_socials WHERE id = ?");
        $stmt->bind_param("i", $id);
        $result = $stmt->execute();
        $stmt->close();

        return $result;
    }


    public function addAppointment($user_id, $data)
    {
        $doctor_id = $data['doctor_id'];
        $service_id = $data['service_id'];
        $book_date = $data['book_date'];
        $slot_id = $data['slot_id'];
        $amount = $data['amount'];
        $fee = $data['fee'];
        $tax = $data['tax'];
        $total = $data['total'];
        $pay_method = $data['pay_method'];
        $tx_id = $data['tx_id'];
        $status = $data['status'];

        $stmt = $this->mysqli->prepare("INSERT INTO " . DB_PREFIX . "_appointments (user_id, doctor_id,service_id,book_date,slot_id,
        amount,fee,tax,total,pay_method,tx_id,status) VALUES (?, ?, ?, ?,?,?,?,?,?,?,?,?)");
        $stmt->bind_param("iiisiiiiiisi", $user_id, $doctor_id, $service_id, $book_date, $slot_id, $amount, $fee, $tax, $total, $pay_method,
            $tx_id, $status);

        $result = $stmt->execute();
        $stmt->close();

        return $result;

    }

    function getDoctorAppointments($doctor_id, $status = '')
    {
        $status = !empty($status) ? ' AND status=' . $status : '';
        $stmt = "SELECT * FROM " . DB_PREFIX . "_appointments WHERE doctor_id = $doctor_id" . $status;
        $results = $this->mysqli->query($stmt);

        $data = array();
        while ($user = $results->fetch_assoc()) {
            $data[] = $user;
        }

        return $data;
    }

    public function getDistinctAppointments($doctor_id, $status = '')
    {
        $status = !empty($status) ? ' AND status=' . $status : '';
        $stmt = "SELECT DISTINCT user_id FROM " . DB_PREFIX . "_appointments WHERE doctor_id = $doctor_id" . $status;
        $results = $this->mysqli->query($stmt);
        $data = array();
        while ($user = $results->fetch_assoc()) {
            $data[] = $user;
        }

        return $data;
    }

    function getTodayAppointments($doctor_id, $status = '')
    {
        $status = !empty($status) ? ' AND status=' . $status : '';
        $stmt = "SELECT * FROM " . DB_PREFIX . "_appointments WHERE  DATE(book_date) = CURDATE() AND doctor_id = $doctor_id" . $status . " ORDER BY id DESC";
        $results = $this->mysqli->query($stmt);

        $data = array();
        while ($user = $results->fetch_assoc()) {
            $data[] = $user;
        }

        return $data;
    }


    function getUpcomingAppointments($doctor_id, $status = '')
    {
        $status = !empty($status) ? ' AND status=' . $status : '';
        $stmt = "SELECT * FROM " . DB_PREFIX . "_appointments WHERE  DATE(book_date) > CURDATE() AND doctor_id = $doctor_id" . $status . " ORDER BY id DESC";
        $results = $this->mysqli->query($stmt);

        $data = array();
        while ($user = $results->fetch_assoc()) {
            $data[] = $user;
        }

        return $data;
    }

    function getPatientAppointments($user_id, $status = '')
    {
        $status = !empty($status) ? ' AND status=' . $status : '';
        $stmt = "SELECT * FROM " . DB_PREFIX . "_appointments WHERE user_id = $user_id" . $status . " ORDER BY id DESC";
        $results = $this->mysqli->query($stmt);

        $data = array();
        while ($user = $results->fetch_assoc()) {
            $data[] = $user;
        }

        return $data;
    }

    public function getAppointmentByTID($id)
    {
        $stmt = "SELECT * FROM " . DB_PREFIX . "_appointments WHERE tx_id = $id";
        $result = $this->mysqli->query($stmt)->fetch_assoc();

        return !empty($result) ? $result : null;
    }

    public function getAppointmentByID($id)
    {
        $stmt = "SELECT * FROM " . DB_PREFIX . "_appointments WHERE id = $id";
        $result = $this->mysqli->query($stmt)->fetch_assoc();

        return !empty($result) ? $result : null;
    }

    public function getTotalAmount()
    {
        $stmt = "SELECT SUM(total) as total_amount FROM " . DB_PREFIX . "_appointments";
        $result = $this->mysqli->query($stmt)->fetch_assoc();

        return !empty($result) ? $result : null;
    }
    public function getTotalAmountDoctor($doctor_id)
    {
        $stmt = "SELECT SUM(total) as total_amount FROM " . DB_PREFIX . "_appointments WHERE doctor_id=$doctor_id";
        $result = $this->mysqli->query($stmt)->fetch_assoc();

        return !empty($result) ? $result : null;
    }
    function getOptions($setting_value)
    {

        $dbOption = $this->mysqli->query("SELECT * FROM " . DB_PREFIX . "_options WHERE setting='$setting_value' LIMIT 1")->fetch_assoc();
        return !empty($dbOption) ? $dbOption['setting_value'] : null;
    }

    function getAllAppointments($limit = 10, $status = '')
    {
        $to_limit = !empty($limit) ? ' LIMIT ' . $limit : '';
        $status = !empty($status) ? ' WHERE status=' . $status : '';
        $stmt = "SELECT * FROM " . DB_PREFIX . "_appointments" . $status . $to_limit;
        $results = $this->mysqli->query($stmt);

        $data = array();
        while ($user = $results->fetch_assoc()) {
            $data[] = $user;
        }

        return $data;
    }

    function addOption($setting, $setting_value)
    {
        $stmt = $this->mysqli->prepare("INSERT INTO " . DB_PREFIX . "_options (setting, setting_value) VALUES (?, ?)");
        $stmt->bind_param("ss", $setting, $setting_value);
        $result = $stmt->execute();
        $stmt->close();

        return $result;
    }

    function getAllOptions()
    {
        $stmt = "SELECT setting,setting_value  FROM " . DB_PREFIX . "_options";
        $results = $this->mysqli->query($stmt);

        $data = array();
        while ($user = $results->fetch_assoc()) {
            $data[] = $user;
        }

        return $data;
    }

    public function approveAppointment($id, $status)
    {
        $stmt = $this->mysqli->prepare("UPDATE " . DB_PREFIX . "_appointments SET status=? WHERE id=?");
        $stmt->bind_param("ii", $status, $id);
        $result = $stmt->execute();
        $stmt->close();

        return $result;
    }

    function updateOptions($setting, $setting_value)
    {
        $stmt = $this->mysqli->prepare("UPDATE " . DB_PREFIX . "_options SET setting_value=? WHERE setting=?");
        $stmt->bind_param("ss", $setting_value, $setting);
        $result = $stmt->execute();
        $stmt->close();

        return $result;
    }

    public function updateStatus($uid, $status)
    {
        $stmt = $this->mysqli->prepare("UPDATE " . DB_PREFIX . "_users SET status=? WHERE unique_id=?");
        $stmt->bind_param("ss", $status, $uid);
        $result = $stmt->execute();
        $stmt->close();

        return $result;
    }

    public function upgradeUser($uid, $role)
    {
        $stmt = $this->mysqli->prepare("UPDATE " . DB_PREFIX . "_meta SET role=? WHERE user_id=?");
        $stmt->bind_param("ii", $role, $uid);
        $result = $stmt->execute();
        $stmt->close();

        return $result;
    }

    public function approveDoctor($uid, $role)
    {
        $stmt = $this->mysqli->prepare("UPDATE " . DB_PREFIX . "_meta SET approved=? WHERE user_id=?");
        $stmt->bind_param("ii", $role, $uid);
        $result = $stmt->execute();
        $stmt->close();

        return $result;
    }

    function addUserLoginActivity($user_id, $device, $browser, $ip)
    {

        $stmt = $this->mysqli->prepare("INSERT INTO " . DB_PREFIX . "_logins (user_id, device, browser, ip_address) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("isss", $user_id, $device, $browser, $ip);
        $result = $stmt->execute();
        $stmt->close();

        return $result;
    }

    public function addRecords($user_id, $description, $attachment)
    {

        $stmt = $this->mysqli->prepare("INSERT INTO " . DB_PREFIX . "_records (user_id,description,attachment) VALUES (?, ?,?)");
        $stmt->bind_param("iss", $user_id, $description, $attachment);
        $result = $stmt->execute();
        $stmt->close();

        return $result;
    }

    public function getMedicalRecords($id)
    {
        $stmt = "SELECT * FROM " . DB_PREFIX . "_records WHERE user_id = $id";
        $results = $this->mysqli->query($stmt);

        $data = array();
        while ($user = $results->fetch_assoc()) {
            $data[] = $user;
        }

        return $data;
    }

    public function getRecordByID($id)
    {
        $stmt = "SELECT * FROM " . DB_PREFIX . "_records WHERE id = $id";
        $result = $this->mysqli->query($stmt)->fetch_assoc();

        return !empty($result) ? $result : null;
    }

    public function deleteMedicalRecord($id)
    {
        $stmt = $this->mysqli->prepare("DELETE FROM " . DB_PREFIX . "_records WHERE id = ?");
        $stmt->bind_param("i", $id);
        $result = $stmt->execute();
        $stmt->close();

        return $result;
    }

    public function addPrescription($user_id, $doctor_id, $drug_name, $frequency, $days, $advice, $total)
    {
        $stmt = $this->mysqli->prepare("INSERT INTO " . DB_PREFIX . "_prescriptions (user_id,doctor_id,drug_name,frequency,days,advice,total) VALUES (?, ?,?,?,?,?,?)");
        $stmt->bind_param("iisssss", $user_id, $doctor_id, $drug_name, $frequency, $days, $advice, $total);
        $result = $stmt->execute();
        $stmt->close();

        return $result;
    }

    public function getPrescriptions($id)
    {
        $stmt = "SELECT * FROM " . DB_PREFIX . "_prescriptions WHERE user_id = $id";
        $results = $this->mysqli->query($stmt);

        $data = array();
        while ($user = $results->fetch_assoc()) {
            $data[] = $user;
        }
        return $data;
    }

    public function deletePrescription($id)
    {
        $stmt = $this->mysqli->prepare("DELETE FROM " . DB_PREFIX . "_prescriptions WHERE id = ?");
        $stmt->bind_param("i", $id);
        $result = $stmt->execute();
        $stmt->close();

        return $result;
    }

    public function addChat($user_id, $doctor_id, $content,$content_type)
    {
        $stmt = $this->mysqli->prepare("INSERT INTO " . DB_PREFIX ."_chats (user_id,doctor_id,content,content_type) VALUES (?, ?,?,?)");
        $stmt->bind_param("iisi", $user_id, $doctor_id, $content, $content_type);
        $result = $stmt->execute();
        $stmt->close();

        return $result;
    }

    public function getChatUsers($id)
    {
        $stmt = "SELECT DISTINCT doctor_id as doc_id FROM " . DB_PREFIX . "_chats WHERE user_id = $id UNION SELECT DISTINCT user_id as doc_id FROM " . DB_PREFIX . "_chats WHERE  doctor_id=$id";
        $results = $this->mysqli->query($stmt);

        $data = array();
        while ($user = $results->fetch_assoc()) {
            $data[] = $user;
        }
        return $data;
    }
    public function getChatDetails($id,$doctor_id)
    {
        $stmt = "SELECT * FROM " . DB_PREFIX . "_chats WHERE user_id = $id AND doctor_id=$doctor_id UNION SELECT * FROM " . DB_PREFIX . "_chats WHERE user_id=$doctor_id AND doctor_id=$id ORDER BY id";
        $results = $this->mysqli->query($stmt);

        $data = array();
        while ($user = $results->fetch_assoc()) {
            $data[] = $user;
        }
        return $data;
    }

    public function getLastChat($id,$doctor_id)
    {
        $stmt = "SELECT * FROM " . DB_PREFIX . "_chats WHERE user_id = $id AND doctor_id=$doctor_id UNION SELECT * FROM " . DB_PREFIX . "_chats WHERE user_id=$doctor_id AND doctor_id=$id ORDER BY id DESC";
        $result = $this->mysqli->query($stmt)->fetch_assoc();

        return !empty($result) ? $result : null;
    }
    public function countChats($id,$doctor_id)
    {
        $stmt = "SELECT COUNT(*) as chat_count FROM " . DB_PREFIX . "_chats WHERE user_id = $id AND doctor_id=$doctor_id";
        $result = $this->mysqli->query($stmt)->fetch_assoc();

        return !empty($result) ? $result : null;
    }
    function resetDB()
    {
        $this->mysqli->query("DROP TABLE IF EXISTS " . DB_PREFIX . "_users");
        $this->mysqli->query("DROP TABLE IF EXISTS " . DB_PREFIX . "_meta");
        $this->mysqli->query("DROP TABLE IF EXISTS " . DB_PREFIX . "_logins");
        return true;
    }


    public function limit($value, $limit = 100, $end = ' ...')
    {
        if (mb_strwidth($value, 'UTF-8') <= $limit) {
            return $value;
        }

        return rtrim(mb_strimwidth($value, 0, $limit, '', 'UTF-8')) . $end;
    }

    public function is_filled($level, $current)
    {
        $filled = '';
        if ($current >= $level) {
            $filled = 'filled';
        }
        return $filled;
    }

    //encodes safer html string
    public static function htmlXSpecialChars( $string, $ent = ENT_COMPAT, $charset = 'ISO-8859-1' ) {
        return htmlspecialchars( $string, $ent, $charset );
    }

    //returns safer html string

    /**
     * @param $string
     * @param int $ent
     * @param string $charset
     *returns safer html string
     *
     * @return string
     */
    public static function htmlDecode( $string, $ent = ENT_COMPAT, $charset = 'ISO-8859-1' ) {
        return html_entity_decode( $string, $ent, $charset );
    }

}