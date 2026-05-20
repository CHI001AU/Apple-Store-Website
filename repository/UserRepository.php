<?php
// 

// Make sure DatabaseSingleton and User Model are available
// Load the User business model, as the Repository must instantiate and return User objects.
require_once __DIR__ . '/../model/User.php';

// Load the DatabaseSingleton, as the Repository needs its generic query execution methods.
require_once __DIR__ . '/../database/DatabaseSingleton.php';


class UserRepository {

    private DatabaseSingleton $db;

    public function __construct(DatabaseSingleton $db) {
        // Database connection is passed in from controllwer
        $this->db = $db;
    }

    /** 
     * Helper function to convert database row to User object ---
     * 
     * */
    private function createModelFromRow(array $row): User {
        $user = new User(
            (int)$row['userId'],
            $row['username'],
            $row['password'],
            $row['firstName'],
            $row['lastName'],
            $row['street'] ?? null,
            $row['town'] ?? null,
            $row['state'] ?? null,
            $row['postcode'] ?? null,
            $row['phone'] ?? null,
            $row['email'] ?? null
            );
        return $user;
    }

    // --- READ OPERATIONS ---

    /** 
     * Finds a user by username (used for login)
     * */ 
    public function findByUsername(string $username): ?User {
        // Build the SQL for finding is User exists
        $sql = "SELECT * FROM `Users` WHERE `username` = :username";
        $result = $this->db->query($sql, ['username' => $username]);

        if (empty($result)) {
            return null;
        }
        return $this->createModelFromRow($result[0]);
    }

    // Checks if a username already exists (used during registration)
    public function existsByUsername(string $username): bool {
        $sql = "SELECT COUNT(*) FROM `Users` WHERE `username` = :username";
        $result = $this->db->query($sql, ['username' => $username]);
        return (int)($result[0]['COUNT(*)'] ?? 0) > 0;
    }

    // --- CREATE OPERATION (INSERT) ---

    /**
     * Inserts a new User record into the database.
     * Updates the User object with the new userId upon success.
     */
    public function insert(User $user): bool {
        // [Inference] The Controller should perform the check, but we can double-check here.
        if ($this->existsByUsername($user->getUsername())) {
            // [Inference] An exception or specific error handling would be better practice.
            return false;
        }

        $sql = "INSERT INTO `Users` (username, password, firstName, lastName, street, town, state, postcode, phone, email)
                VALUES (:u, :p, :f, :l, :s, :t, :st, :pc, :ph, :e)";

        $params = [
            'u' => $user->getUsername(),
            'p' => $user->getPassword(),
            'f' => $user->getFirstName(),
            'l' => $user->getLastName(),
            's' => $user->getStreet(),
            't' => $user->getTown(),
            'st' => $user->getState(),
            'pc' => $user->getPostcode(),
            'ph' => $user->getPhone(),
            'e' => $user->getEmail()
        ];

        // Execute the insertion
        if ($this->db->execute($sql, $params) > 0) {
            // Update the User object with the newly generated ID
            $user->setUserId((int)$this->db->lastInsertId());
            return true;
        }

        return false;
    }

    // --- UPDATE OPERATIONS ---

    // Updates general user profile information
    public function update(User $user): bool {
    if ($user->getUserId() === null) {
        return false;
    }

    $sql = "UPDATE `Users` SET
        `username` = :u,
        `password` = :p,
        `firstName` = :f,
        `lastName` = :l,
        `street` = :s,
        `town` = :t,
        `state` = :st,
        `postcode` = :pc,
        `phone` = :ph,
        `email` = :e
        WHERE `userId` = :id";

    $params = [
        'u' => $user->getUsername(),
        'p' => $user->getPassword(),
        'f' => $user->getFirstName(),
        'l' => $user->getLastName(),
        's' => $user->getStreet(),
        't' => $user->getTown(),
        'st' => $user->getState(),
        'pc' => $user->getPostcode(),
        'ph' => $user->getPhone(),
        'e' => $user->getEmail(),
        'id' => $user->getUserId()
    ];

    return $this->db->execute($sql, $params) > 0;
}

    // --- DELETE OPERATION ---

    /**
     * Deletes a user record based on their ID.
     */
    public function delete(int $userId): bool {
        $sql = "DELETE FROM `Users` WHERE `userId` = :id";
        echo("about to delete ".$userId);
        return $this->db->execute($sql, ['id' => $userId]) > 0;
    }

    // --- General Save/Persist Method (Encapsulates Insert/Update) ---

    /**
     * Handles both insertion (new user) and updating (existing user).
     * This method can update all user fields, including the password.
     */
    public function save(User $user): bool {
        if (!isset($user->userId) || $user->getUserId() === null) {
            return $this->insert($user);
        }
        return $this->update($user);
    }

}

?>