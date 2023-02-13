CREATE TABLE generated_passwords ( uuid VARCHAR(36), session_id VARCHAR(25), 
                                  created_at DATETIME DEFAULT '2000-01-01 00:00:00', 
                                  delete_by DATETIME,
                                  deleted TINYINT(1) DEFAULT '0')
