<input type="text" name="title" value="<?= isset($edit_movie) ? htmlspecialchars($edit_movie['Title']) : '' ?>" placeholder="Title" required><br>

<input type="number" step="0.1" name="rating" value="<?= isset($edit_movie) ? htmlspecialchars($edit_movie['Rating']) : '' ?>" placeholder="Rating" required><br>

<input type="text" name="year" value="<?= isset($edit_movie) ? htmlspecialchars($edit_movie['Year']) : '' ?>" placeholder="Year" required><br>

<input type="text" name="month" value="<?= isset($edit_movie) ? htmlspecialchars($edit_movie['Month']) : '' ?>" placeholder="Month" required><br>

<input type="text" name="certificate" value="<?= isset($edit_movie) ? htmlspecialchars($edit_movie['Certificate']) : '' ?>" placeholder="Certificate" required><br>

<input type="text" name="runtime" value="<?= isset($edit_movie) ? htmlspecialchars($edit_movie['Runtime']) : '' ?>" placeholder="Runtime" required><br>

<input type="text" name="directors" value="<?= isset($edit_movie) ? htmlspecialchars($edit_movie['Directors']) : '' ?>" placeholder="Directors" required><br>

<input type="text" name="stars" value="<?= isset($edit_movie) ? htmlspecialchars($edit_movie['Stars']) : '' ?>" placeholder="Stars" required><br>

<input type="text" name="genre" value="<?= isset($edit_movie) ? htmlspecialchars($edit_movie['Genre']) : '' ?>" placeholder="Genre" required><br>

<input type="text" name="image_path" value="<?= isset($edit_movie) ? htmlspecialchars($edit_movie['Image_path']) : '' ?>" placeholder="Image Path" required><br>

<textarea name="description" placeholder="Description" required><?= isset($edit_movie) ? htmlspecialchars($edit_movie['Description']) : '' ?></textarea><br>

<input type="text" name="language" value="<?= isset($edit_movie) ? htmlspecialchars($edit_movie['Language']) : '' ?>" placeholder="Language" required><br>

<input type="text" name="format" value="<?= isset($edit_movie) ? htmlspecialchars($edit_movie['Format']) : '' ?>" placeholder="Format" required><br>

<input type="text" name="url" value="<?= isset($edit_movie) ? htmlspecialchars($edit_movie['URL']) : '' ?>" placeholder="URL" required><br>
