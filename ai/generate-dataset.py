import pandas as pd
import random
import string

# وظيفة لتوليد أسماء عشوائية
def generate_random_name():
    first_name = ''.join(random.choices(string.ascii_uppercase, k=5))
    last_name = ''.join(random.choices(string.ascii_uppercase, k=7))
    return f"{first_name} {last_name}"

# وظيفة لتوليد بيانات الطلاب
def generate_student_data(num_students):
    data = []
    for _ in range(num_students):
        student_id = random.randint(1000, 9999)
        name = generate_random_name()
        quiz1 = random.randint(50, 100)
        quiz2 = random.randint(50, 100)
        midterm = random.randint(50, 100)
        final_score = random.randint(50, 100)

        data.append({
            'Student ID': student_id,
            'Name': name,
            'Quiz 1': quiz1,
            'Quiz 2': quiz2,
            'Midterm': midterm,
            'Final Score': final_score
        })
    return data

# توليد 100 طالب
students_data = generate_student_data(100)

# تحويل البيانات إلى DataFrame
df = pd.DataFrame(students_data)

# حفظ البيانات في ملف Excel
file_name = 'C:/Users/ADNAN/Desktop/students_data.xlsx'
df.to_excel(file_name, index=False)
print(f"Student data successfully saved to {file_name}")
