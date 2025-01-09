<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Document</title>
</head>

<body class="bg-pink-100 py-8 font-medium text-4x1">
    <div class="max-w-8xl mx-auto bg-white p-8 rounded-lg shadow-lg">
        <form action="" method="post">
            <div class="mb-10">
                <h2 class="text-3xl font-bold text-gray-800 bg-pink-300 p-4 rounded mb-6">Basic Information</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6">
                    <div>
                        <label for="number_of_pregnancies" class="text-lg font-medium text-gray-700">Number of
                            Pregnancies</label>
                        <input id="number_of_pregnancies" type="text" required name="number_of_pregnancies"
                            class="mt-2 w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500">
                    </div>
                    <div>
                        <label for="previous_birth_type" class="text-lg font-medium text-gray-700">Previous Birth
                            Type</label>
                        <input id="previous_birth_type" type="text" required name="previous_birth_type"
                            class="mt-2 w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500">
                    </div>
                    <div>
                        <label for="number_of_miscarriages" class="text-lg font-medium text-gray-700">Number of
                            Miscarriages</label>
                        <input id="number_of_miscarriages" type="text" required name="number_of_miscarriages"
                            class="mt-2 w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500">
                    </div>
                    <div>
                        <label for="expected_due_date" class="text-lg font-medium text-gray-700">Expected Due
                            Date</label>
                        <input id="expected_due_date" type="date" required name="expected_due_date"
                            class="mt-2 w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500">
                    </div>
                    <div>
                        <label for="last_menstrual_period" class="text-lg font-medium text-gray-700">Last Menstrual
                            Period</label>
                        <input id="last_menstrual_period" type="text" required name="last_menstrual_period"
                            class="mt-2 w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500">
                    </div>
                    <div>
                        <label for="previous_delivery_complications" class="text-lg font-medium text-gray-700">Previous
                            Delivery Complications</label>
                        <input id="previous_delivery_complications" type="text" required
                            name="previous_delivery_complications"
                            class="mt-2 w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500">
                    </div>
                    <div>
                        <label for="fetal_heart_rate" class="text-lg font-medium text-gray-700">Fetal Heart Rate</label>
                        <input id="fetal_heart_rate" type="text" required name="fetal_heart_rate"
                            class="mt-2 w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500">
                    </div>
                    <div>
                        <label for="fetal_anatomy_scan" class="text-lg font-medium text-gray-700">Fetal Anatomy
                            Scan</label>
                        <input id="fetal_anatomy_scan" type="text" required name="fetal_anatomy_scan"
                            class="mt-2 w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500">
                    </div>
                    <div>
                        <label for="hemoglobin" class="text-lg font-medium text-gray-700">Hemoglobin</label>
                        <input id="hemoglobin" type="text" required name="hemoglobin"
                            class="mt-2 w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500">
                    </div>
                </div>
            </div>
            <div class="mb-10">
                <h2 class="text-3xl font-bold text-gray-800 bg-pink-300 p-6 rounded mb-6 shadow-md">Life Status</h2>
                <div class="grid grid-cols-1 sm:grid-cols-3 lg:grid-cols-3 mb-5 gap-6">
                    <div>
                        <h4 class="text-lg font-medium text-gray-700">Are you under medical treatment now? If so,
                            what is the condition being treated?</h4>
                        <textarea name="medical-treatment-details" placeholder="If Yes, specify the condition..."
                            class="mt-4 w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500"></textarea>
                    </div>
                    <div>
                        <h4 class="text-lg font-medium text-gray-700">Have you ever had a serious illness or
                            surgical operation?</h4>
                        <textarea name="serious-illness-details"
                            placeholder="If Yes, specify the illness or operation..."
                            class="mt-4 w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500"></textarea>
                    </div>
                    <div>
                        <h4 class="text-lg font-medium text-gray-700">Have you ever been hospitalized? If so, when
                            and why?</h4>
                        <textarea name="hospitalization-details" placeholder="If Yes, specify when and why..."
                            class="mt-4 w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500"></textarea>
                    </div>
                    <div>
                        <h4 class="text-lg font-medium text-gray-700">Are you taking any medications? If so, please
                            specify.</h4>
                        <textarea name="medication-details" placeholder="Specify medications..."
                            class="mt-4 w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500"></textarea>
                    </div>
                    <div>
                        <h4 class="text-lg font-medium text-gray-700">Blood Type</h4>
                        <input type="text" name="blood-type" placeholder="Specify your blood type..."
                            class="mt-4 w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500">
                    </div>
                    <div>
                        <h4 class="text-lg font-medium text-gray-700">Latest Blood Pressure</h4>
                        <input type="text" name="blood-pressure" placeholder="Specify your latest blood pressure..."
                            class="mt-4 w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500">
                    </div>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-3 lg:grid-cols-3 mb-10 gap-6">
                    <div>
                        <h4 class="text-lg font-medium text-gray-700">Are you in good health?</h4>
                        <div class="mt-2 flex items-center space-x-6">
                            <label class="flex items-center">
                                <input type="radio" value="Yes" name="health-status"
                                    class="w-4 h-4 text-pink-600 border-gray-300 focus:ring-pink-500">
                                <span class="ml-2 text-gray-800">Yes</span>
                            </label>
                            <label class="flex items-center">
                                <input type="radio" value="No" name="health-status"
                                    class="w-4 h-4 text-pink-600 border-gray-300 focus:ring-pink-500">
                                <span class="ml-2 text-gray-800">No</span>
                            </label>
                        </div>
                    </div>
                    <div>
                        <h4 class="text-lg font-medium text-gray-700">Do you use tobacco products?</h4>
                        <div class="mt-2 flex items-center space-x-6">
                            <label class="flex items-center">
                                <input type="radio" value="Yes" name="tobacco"
                                    class="w-4 h-4 text-pink-600 border-gray-300 focus:ring-pink-500">
                                <span class="ml-2 text-gray-800">Yes</span>
                            </label>
                            <label class="flex items-center">
                                <input type="radio" value="No" name="tobacco"
                                    class="w-4 h-4 text-pink-600 border-gray-300 focus:ring-pink-500">
                                <span class="ml-2 text-gray-800">No</span>
                            </label>
                        </div>
                    </div>
                    <div>
                        <h4 class="text-lg font-medium text-gray-700">Do you use alcohol or other substances?</h4>
                        <div class="mt-2 flex items-center space-x-6">
                            <label class="flex items-center">
                                <input type="radio" value="Yes" name="substances"
                                    class="w-4 h-4 text-pink-600 border-gray-300 focus:ring-pink-500">
                                <span class="ml-2 text-gray-800">Yes</span>
                            </label>
                            <label class="flex items-center">
                                <input type="radio" value="No" name="substances"
                                    class="w-4 h-4 text-pink-600 border-gray-300 focus:ring-pink-500">
                                <span class="ml-2 text-gray-800">No</span>
                            </label>
                        </div>
                    </div>
                </div>

                <div>
                    <div>
                        <h4 class="text-lg font-medium text-gray-700">Are you allergic to any of the following?</h4>
                        <div class="grid grid-cols-1 mt-5 mb-5 sm:grid-cols-2 lg:grid-cols-3 gap-2">
                            <label class="flex items-center">
                                <input type="checkbox" value="Local Anesthetic" name="allergies"
                                    class="w-4 h-4 text-pink-600 border-gray-300 focus:ring-pink-500">
                                <span class="ml-2 text-gray-800">Local Anesthetic (e.g., Lidocaine)</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" value="Aspirin" name="allergies"
                                    class="w-4 h-4 text-pink-600 border-gray-300 focus:ring-pink-500">
                                <span class="ml-2 text-gray-800">Aspirin</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" value="Penicillin" name="allergies"
                                    class="w-4 h-4 text-pink-600 border-gray-300 focus:ring-pink-500">
                                <span class="ml-2 text-gray-800">Penicillin</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" value="Latex" name="allergies"
                                    class="w-4 h-4 text-pink-600 border-gray-300 focus:ring-pink-500">
                                <span class="ml-2 text-gray-800">Latex</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" value="Sulfa Drugs" name="allergies"
                                    class="w-4 h-4 text-pink-600 border-gray-300 focus:ring-pink-500">
                                <span class="ml-2 text-gray-800">Sulfa Drugs</span>
                            </label>
                            <div>
                                <textarea name="allergy-details" placeholder="If other, specify..."
                                    class="mt-4 w-full px-2 py-1 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500"></textarea>
                            </div>
                        </div>
                    </div>


                    <div>
                        <h4 class="text-lg font-medium text-gray-700">Do you have or have you had any of the following?
                            Check which apply</h4>
                        <div class="grid grid-cols-1 mt-5 gap-6 md:grid-cols-2 lg:grid-cols-4">
                            <label class="flex items-center">
                                <input type="checkbox" value="Respiratory Problems" name="conditions"
                                    class="w-4 h-4 text-pink-600 border-gray-300 focus:ring-pink-500">
                                <span class="ml-2 text-gray-800">Respiratory Problems</span>
                            </label>

                            <label class="flex items-center">
                                <input type="checkbox" value="Hepatitis/Jaundice " name="allergies"
                                    class="w-4 h-4 text-pink-600 border-gray-300 focus:ring-pink-500">
                                <span class="ml-2 text-gray-800">Hepatitis/Jaundice </span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" value="Tuberculosis " name="allergies"
                                    class="w-4 h-4 text-pink-600 border-gray-300 focus:ring-pink-500">
                                <span class="ml-2 text-gray-800">Tuberculosis </span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" value="Swollen ankles" name="allergies"
                                    class="w-4 h-4 text-pink-600 border-gray-300 focus:ring-pink-500">
                                <span class="ml-2 text-gray-800">Swollen ankles</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" value="Kidney disease" name="allergies"
                                    class="w-4 h-4 text-pink-600 border-gray-300 focus:ring-pink-500">
                                <span class="ml-2 text-gray-800">Kidney disease</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" value="Diabetes" name="allergies"
                                    class="w-4 h-4 text-pink-600 border-gray-300 focus:ring-pink-500">
                                <span class="ml-2 text-gray-800">Diabetes</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" value="Chest pain " name="allergies"
                                    class="w-4 h-4 text-pink-600 border-gray-300 focus:ring-pink-500">
                                <span class="ml-2 text-gray-800">Chest pain</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" value="Cancer/Tumors" name="allergies"
                                    class="w-4 h-4 text-pink-600 border-gray-300 focus:ring-pink-500">
                                <span class="ml-2 text-gray-800">Cancer/Tumors</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" value="Anemia" name="allergies"
                                    class="w-4 h-4 text-pink-600 border-gray-300 focus:ring-pink-500">
                                <span class="ml-2 text-gray-800">Anemia</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" value="Angina" name="allergies"
                                    class="w-4 h-4 text-pink-600 border-gray-300 focus:ring-pink-500">
                                <span class="ml-2 text-gray-800">Angina </span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" value="Asthma" name="allergies"
                                    class="w-4 h-4 text-pink-600 border-gray-300 focus:ring-pink-500">
                                <span class="ml-2 text-gray-800"> Asthma </span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" value="Chest pain " name="allergies"
                                    class="w-4 h-4 text-pink-600 border-gray-300 focus:ring-pink-500">
                                <span class="ml-2 text-gray-800">Emphysema</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" value="Bleeding Problems" name="allergies"
                                    class="w-4 h-4 text-pink-600 border-gray-300 focus:ring-pink-500">
                                <span class="ml-2 text-gray-800">Bleeding Problems</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" value="Blood Diseases" name="allergies"
                                    class="w-4 h-4 text-pink-600 border-gray-300 focus:ring-pink-500">
                                <span class="ml-2 text-gray-800">Blood Diseases</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" value="Head Injuries" name="allergies"
                                    class="w-4 h-4 text-pink-600 border-gray-300 focus:ring-pink-500">
                                <span class="ml-2 text-gray-800">Head Injuries</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" value="Chest pain " name="allergies"
                                    class="w-4 h-4 text-pink-600 border-gray-300 focus:ring-pink-500">
                                <span class="ml-2 text-gray-800">High Blood Pressure</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" value="Epilepsy/Convulsions" name="allergies"
                                    class="w-4 h-4 text-pink-600 border-gray-300 focus:ring-pink-500">
                                <span class="ml-2 text-gray-800">Epilepsy/Convulsions </span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" value="AIDS or HIV Infection " name="allergies"
                                    class="w-4 h-4 text-pink-600 border-gray-300 focus:ring-pink-500">
                                <span class="ml-2 text-gray-800">AIDS or HIV Infection </span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" value="Sexually Transmitted disease" name="allergies"
                                    class="w-4 h-4 text-pink-600 border-gray-300 focus:ring-pink-500">
                                <span class="ml-2 text-gray-800">Sexually Transmitted disease</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" value="Head Injuries" name="allergies"
                                    class="w-4 h-4 text-pink-600 border-gray-300 focus:ring-pink-500">
                                <span class="ml-2 text-gray-800">Stomach Troubles / Ulcers</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" value="Fainting Seizure" name="allergies"
                                    class="w-4 h-4 text-pink-600 border-gray-300 focus:ring-pink-500">
                                <span class="ml-2 text-gray-800">Fainting Seizure</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" value="Rapid Weight Loss" name="allergies"
                                    class="w-4 h-4 text-pink-600 border-gray-300 focus:ring-pink-500">
                                <span class="ml-2 text-gray-800">Rapid Weight Loss </span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" value="Radiation Therapy " name="allergies"
                                    class="w-4 h-4 text-pink-600 border-gray-300 focus:ring-pink-500">
                                <span class="ml-2 text-gray-800">Radiation Therapy </span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" value="Joint Replacement / Implant " name="allergies"
                                    class="w-4 h-4 text-pink-600 border-gray-300 focus:ring-pink-500">
                                <span class="ml-2 text-gray-800">Joint Replacement / Implant </span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" value="Heart Surgery " name="allergies"
                                    class="w-4 h-4 text-pink-600 border-gray-300 focus:ring-pink-500">
                                <span class="ml-2 text-gray-800">Heart Surgery </span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" value="Heart Attack" name="allergies"
                                    class="w-4 h-4 text-pink-600 border-gray-300 focus:ring-pink-500">
                                <span class="ml-2 text-gray-800">Heart Attack</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" value="Thyroid Problem" name="allergies"
                                    class="w-4 h-4 text-pink-600 border-gray-300 focus:ring-pink-500">
                                <span class="ml-2 text-gray-800">Thyroid Problem</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" value=" Heart Disease " name="allergies"
                                    class="w-4 h-4 text-pink-600 border-gray-300 focus:ring-pink-500">
                                <span class="ml-2 text-gray-800"> Heart Disease </span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" value="Heart Murmur " name="allergies"
                                    class="w-4 h-4 text-pink-600 border-gray-300 focus:ring-pink-500">
                                <span class="ml-2 text-gray-800">Heart Murmur </span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" value="Hepatitis/Liver Disease" name="allergies"
                                    class="w-4 h-4 text-pink-600 border-gray-300 focus:ring-pink-500">
                                <span class="ml-2 text-gray-800">Hepatitis/Liver Disease</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" value="Rheumatic Fever" name="allergies"
                                    class="w-4 h-4 text-pink-600 border-gray-300 focus:ring-pink-500">
                                <span class="ml-2 text-gray-800">Rheumatic Fever</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" value="Hay Fever/Allergies" name="allergies"
                                    class="w-4 h-4 text-pink-600 border-gray-300 focus:ring-pink-500">
                                <span class="ml-2 text-gray-800">Hay Fever/Allergies</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" value="Low Blood Pressure" name="allergies"
                                    class="w-4 h-4 text-pink-600 border-gray-300 focus:ring-pink-500">
                                <span class="ml-2 text-gray-800"> Low Blood Pressure</span>
                            </label>
                        </div>
                        <textarea name="other-conditions" placeholder="If other, specify..."
                            class="mt-4 w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500"></textarea>
                    </div>
                </div>
                <div>
                    <span class="ml-6 text-gray-800 flex items-center font-semibold">Upload Health Report Image</span>
                    <label class="flex items-center">
                        <div class="flex items-center justify-center w-full mt-4">
                            <label for="dropzone-file"
                                class="flex flex-col items-center justify-center w-full h-64 border-2 border-pink-200 border-dashed rounded-lg cursor-pointer bg-pink-100 hover:bg-pink-200 dark:bg-pink-100 dark:hover:bg-pink-200 dark:border-gray-600 dark:hover:border-gray-500 transition duration-200 ease-in-out">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                    <svg class="w-12 h-12 mb-4 text-gray-600 dark:text-gray-400 transition-colors"
                                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 20 16">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                    </svg>
                                    <p class="mb-2 text-sm text-gray-600 dark:text-gray-400"><span
                                            class="font-semibold">Click
                                            to upload</span> or drag and drop</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG, or GIF (MAX.
                                        800x400px)</p>
                                </div>
                                <input id="dropzone-file" type="file" class="hidden" />
                            </label>
                        </div>
                    </label>
                </div>

            </div>
            <button type="button"
                class="text-white bg-pink-700 hover:bg-pink-800 focus:ring-4 focus:ring-pink-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-pink-600 dark:hover:bg-pink-700 focus:outline-none dark:focus:ring-pink-800">Save</button>
    </div>
    </form>
    </div>


    <script src="../path/to/flowbite/dist/flowbite.min.js"></script>
</body>

</html>