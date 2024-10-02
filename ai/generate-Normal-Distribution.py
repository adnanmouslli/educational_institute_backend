import pandas as pd
import numpy as np

# توليد بيانات عشوائية باستخدام التوزيع الطبيعي
np.random.seed(42)  # لضمان ثبات النتائج

# عدد الطلاب
num_students = 100

# توليد بيانات المذاكرات وامتحانات الفصل الأول باستخدام التوزيع الطبيعي
quiz1 = np.random.normal(75, 10, num_students)  # وسط 75 وانحراف معياري 10
quiz2 = np.random.normal(70, 15, num_students)  # وسط 70 وانحراف معياري 15
midterm = np.random.normal(80, 12, num_students)  # وسط 80 وانحراف معياري 12

# توليد النتيجة النهائية بناءً على المتوسط المرجح لدرجات المذاكرات والامتحانات مع إضافة بعض العشوائية
final_score = 0.3 * quiz1 + 0.3 * quiz2 + 0.4 * midterm + np.random.normal(0, 5, num_students)

# وضع الدرجات في DataFrame
data = {
    'student_id': np.arange(1, num_students + 1),
    'quiz1': quiz1,
    'quiz2': quiz2,
    'midterm': midterm,
    'final_score': final_score
}

df = pd.DataFrame(data)

# حفظ البيانات في ملف Excel
df.to_excel("C:/Users/ADNAN/Desktop/students_data_nd.xlsx", index=False)

print("تم حفظ البيانات في ملف students_data.xlsx")
