import pandas as pd
import numpy as np
from sklearn.model_selection import train_test_split
from sklearn.ensemble import RandomForestRegressor
from sklearn.metrics import mean_squared_error

# قراءة البيانات من ملف Excel
file_path = 'C:/xampp/htdocs/educational_institute/dataset/students_data.xlsx'

df = pd.read_excel(file_path)

# عرض البيانات للتأكد من تحميلها بشكل صحيح
print(df.head())

# التأكد من أن العمود 'final_score' موجود في البيانات
if 'final_score' not in df.columns:
    raise ValueError("The 'final_score' column is missing from the data.")

# فصل الميزات (المذاكرات والفصل الأول) عن الهدف (النتيجة النهائية)
X = df[['quiz1', 'quiz2', 'midterm']]
y = df['final_score']

# تقسيم البيانات إلى مجموعة تدريب واختبار
X_train, X_test, y_train, y_test = train_test_split(X, y, test_size=0.2, random_state=42)

# تهيئة نموذج Random Forest
model = RandomForestRegressor(n_estimators=100, random_state=42)

# تدريب النموذج
model.fit(X_train, y_train)

# التنبؤ بالنتائج باستخدام البيانات الاختبارية
y_pred = model.predict(X_test)

# حساب الخطأ المتوسط التربيعي (Mean Squared Error)
mse = mean_squared_error(y_test, y_pred)
rmse = np.sqrt(mse)

print(f"Root Mean Squared Error: {rmse}")

# بيانات طالب جديد
new_student = pd.DataFrame({
    'quiz1': [80],
    'quiz2': [85],
    'midterm': [90]
})

# التنبؤ بعلامة الطالب الجديد
predicted_score = model.predict(new_student)
print(f"The predicted final score for the new student is: {predicted_score[0]}")
