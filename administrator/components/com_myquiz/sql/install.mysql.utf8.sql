DROP TABLE IF EXISTS `#__myQuiz_quizUserSummary`;
DROP TABLE IF EXISTS `#__myQuiz_userAnswers`;
DROP TABLE IF EXISTS `#__myQuiz_answer`;
DROP TABLE IF EXISTS `#__myQuiz_question`;
DROP TABLE IF EXISTS `#__myQuiz_quiz`;



CREATE TABLE IF NOT EXISTS `#__myQuiz_quiz` (
  `id` SERIAL NOT NULL,
  `imageId` bigint(20) UNSIGNED NOT NULL,
  `title` VARCHAR(60)  NOT NULL,
  `description` VARCHAR(200)  NOT NULL,
  `attemptsAllowed` INT DEFAULT '1',
  `isHidden` BOOLEAN NOT NULL DEFAULT 0,
  UNIQUE (`title`),
  PRIMARY KEY (`id`),
  FOREIGN KEY (`imageId`) REFERENCES `#__myImageViewer_image` (`id`)
) ENGINE = InnoDB; 

CREATE TABLE IF NOT EXISTS `#__myQuiz_question` (
  `id` SERIAL NOT NULL,
  `quizId` bigint(20) UNSIGNED NOT NULL,
  `description` VARCHAR(200),
  `feedback` VARCHAR(200),
  `markValue` INT DEFAULT '1',
  PRIMARY KEY (`id`),
  FOREIGN KEY (`quizId`) REFERENCES `#__myQuiz_quiz` (`id`)
) ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `#__myQuiz_answer` (
  `id` SERIAL NOT NULL,
  `questionId` bigint(20) UNSIGNED NOT NULL,
  `description` VARCHAR(200),
  `isCorrect` BOOLEAN,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`questionId`) REFERENCES `#__myQuiz_question` (`id`)
) ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `#__myQuiz_userAnswers` (
  `userId` int(11) NOT NULL,
  `answerId` bigint(20) UNSIGNED NOT NULL,
  `attemptNumber` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`userId`, `answerId`, `attemptNumber`),
  FOREIGN KEY (`userId`) REFERENCES `#__users` (`id`),
  FOREIGN KEY (`answerId`) REFERENCES `#__myQuiz_answer` (`id`)
) ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `#__myQuiz_quizUserSummary` (
  `userId` int(11) NOT NULL,
  `quizId` bigint(20) UNSIGNED NOT NULL,
  `attemptNumber` INT NOT NULL,
  `score` INT NOT NULL DEFAULT '0',
  `maxScore` INT NOT NULL,
  `startTime` DATETIME,
  `finishTime` DATETIME,
  PRIMARY KEY (`userId`, `quizId`, `attemptNumber`),
  FOREIGN KEY (`userId`) REFERENCES `#__users` (`id`),
  FOREIGN KEY (`quizId`) REFERENCES `#__myQuiz_quiz` (`id`)
) ENGINE = InnoDB;



INSERT INTO `#__myQuiz_quiz` (`imageId`, `title`, `description`, `attemptsAllowed`) VALUES
	(1, 'Quiz Number 1', 'A series of questions about this image', 5),
	(2, 'Quiz Multiple Answers Score Test', 'Multiple answers have been selected as correct. Is the score correct? The whole selection and scoring process might break if multiples are allowed', 5);

INSERT INTO `#__myQuiz_question` (`quizId`, `description`, `feedback`, `markValue`) VALUES
	(1, 'What is going on in this image?', 'The correct choice for this answer is c as there are reasons', 4),
	(1, 'How many things are in this image?', 'The correct choice for this answer is a for reasons described', 8),
	(2, 'Where are the bits in this image?', 'The correct choice for this answer is b. You should know this', 5),
	(2, 'Where would everyone be in this image?', 'The correct choice for this answer is d. I cant say why', 5);
	
INSERT INTO `#__myQuiz_answer` (`questionId`, `description`, `isCorrect`) VALUES
	(1, 'It has a face', 0),
	(1, 'There are too many bones', 1),
	(2, 'There is a sophisticated answer', 1),
	(2, 'It is an alien', 0),
	(1, 'It has a library card', 1),
	(1, 'medical reasons', 1),
	(2, 'There is too much blood', 1),
	(2, 'The answer is elusive', 1);
